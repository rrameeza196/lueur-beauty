<?php
// api.php — Lueur Beauty REST API
ini_set('session.cookie_samesite', 'Lax');
session_start();
header('Content-Type: application/json');
header('X-Content-Type-Options: nosniff');
require_once 'db.php';

$method = $_SERVER['REQUEST_METHOD'];
$action = $_GET['action'] ?? '';

function send($data, $code = 200) {
    http_response_code($code);
    echo json_encode($data);
    exit;
}
function body() {
    static $b = null;
    if ($b === null) $b = json_decode(file_get_contents('php://input'), true) ?? [];
    return $b;
}
function requireAdmin() {
    if (empty($_SESSION['admin_logged_in'])) send(['error' => 'Unauthorised'], 401);
}
function clean($v) {
    return htmlspecialchars(strip_tags(trim((string)$v)));
}

// ── PRODUCTS ─────────────────────────────────────────────

if ($method === 'GET' && $action === 'products') {
    $where = ['1=1']; $params = []; $types = '';
    if (!empty($_GET['category'])) {
        $where[] = 'category = ?'; $params[] = clean($_GET['category']); $types .= 's';
    }
    if (!empty($_GET['search'])) {
        $where[] = '(name LIKE ? OR kind LIKE ? OR category LIKE ?)';
        $q = '%'.clean($_GET['search']).'%';
        $params = array_merge($params,[$q,$q,$q]); $types .= 'sss';
    }
    $sql = 'SELECT id,name,kind,category,description,price,original_price,stock,shade_hex,image_url,reviews,created_at
            FROM products WHERE '.implode(' AND ',$where).' ORDER BY id DESC';
    $stmt = $conn->prepare($sql);
    if ($params) $stmt->bind_param($types,...$params);
    $stmt->execute();
    $rows = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    foreach ($rows as &$r) {
        $r['price']          = (float)$r['price'];
        $r['original_price'] = (float)$r['original_price'];
        $r['stock']          = (int)$r['stock'];
        $r['reviews']        = (int)$r['reviews'];
        $r['on_sale']        = $r['price'] < $r['original_price'];
    }
    send($rows);
}

if ($method === 'GET' && $action === 'product') {
    $id = (int)($_GET['id'] ?? 0);
    $stmt = $conn->prepare('SELECT * FROM products WHERE id = ?');
    $stmt->bind_param('i',$id); $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();
    if (!$row) send(['error'=>'Not found'],404);
    $row['price']          = (float)$row['price'];
    $row['original_price'] = (float)$row['original_price'];
    $row['on_sale']        = $row['price'] < $row['original_price'];
    send($row);
}

if ($method === 'POST' && $action === 'product') {
    requireAdmin();
    $b        = body();
    $name     = clean($b['name']          ?? '');
    $kind     = clean($b['kind']          ?? '');
    $category = clean($b['category']      ?? 'Lips');
    $desc     = clean($b['description']   ?? '');
    $price    = (float)($b['price']       ?? 0);
    $original = (float)($b['original_price'] ?? $price);
    $stock    = (int)($b['stock']         ?? 0);
    $shade    = clean($b['shade_hex']     ?? '#C17A57');
    $img      = clean($b['image_url']     ?? '');
    if (!$name || $price <= 0) send(['error'=>'Name and valid price required'],422);
    $stmt = $conn->prepare(
        'INSERT INTO products (name,kind,category,description,price,original_price,stock,shade_hex,image_url)
         VALUES (?,?,?,?,?,?,?,?,?)'
    );
    $stmt->bind_param('ssssddiss',$name,$kind,$category,$desc,$price,$original,$stock,$shade,$img);
    if (!$stmt->execute()) send(['error'=>$stmt->error],500);
    send(['id'=>$conn->insert_id,'message'=>'Product created'],201);
}

if ($method === 'PUT' && $action === 'product') {
    requireAdmin();
    $id = (int)($_GET['id'] ?? 0);
    $b  = body();
    $name     = clean($b['name']          ?? '');
    $kind     = clean($b['kind']          ?? '');
    $category = clean($b['category']      ?? 'Lips');
    $desc     = clean($b['description']   ?? '');
    $price    = (float)($b['price']       ?? 0);
    $original = (float)($b['original_price'] ?? $price);
    $stock    = (int)($b['stock']         ?? 0);
    $shade    = clean($b['shade_hex']     ?? '#C17A57');
    $img      = clean($b['image_url']     ?? '');
    if (!$id || !$name) send(['error'=>'ID and name required'],422);
    $stmt = $conn->prepare(
        'UPDATE products SET name=?,kind=?,category=?,description=?,price=?,original_price=?,stock=?,shade_hex=?,image_url=? WHERE id=?'
    );
    $stmt->bind_param('ssssddissi',$name,$kind,$category,$desc,$price,$original,$stock,$shade,$img,$id);
    if (!$stmt->execute()) send(['error'=>$stmt->error],500);
    send(['message'=>'Product updated']);
}

if ($method === 'DELETE' && $action === 'product') {
    requireAdmin();
    $id = (int)($_GET['id'] ?? 0);
    if (!$id) send(['error'=>'ID required'],422);
    $stmt = $conn->prepare('DELETE FROM products WHERE id = ?');
    $stmt->bind_param('i',$id);
    if (!$stmt->execute()) send(['error'=>$stmt->error],500);
    send(['message'=>'Product deleted']);
}

// ── IMAGE UPLOAD ─────────────────────────────────────────

if ($method === 'POST' && $action === 'upload') {
    requireAdmin();
    if (empty($_FILES['image'])) send(['error'=>'No file'],422);
    $f   = $_FILES['image'];
    $ext = strtolower(pathinfo($f['name'], PATHINFO_EXTENSION));
    if (!in_array($ext,['jpg','jpeg','png','webp','gif'])) send(['error'=>'Only jpg/png/webp/gif'],422);
    if ($f['size'] > 5*1024*1024) send(['error'=>'Max 5MB'],422);
    $dir = __DIR__.'/uploads/';
    if (!is_dir($dir)) mkdir($dir,0755,true);
    $filename = uniqid('img_',true).'.'.$ext;
    if (!move_uploaded_file($f['tmp_name'],$dir.$filename)) send(['error'=>'Upload failed'],500);
    send(['url'=>'/uploads/'.$filename]);
}

// ── ORDERS ───────────────────────────────────────────────

if ($method === 'POST' && $action === 'order') {
    $b       = body();
    $name    = clean($b['name']    ?? '');
    $email   = clean($b['email']   ?? '');
    $phone   = clean($b['phone']   ?? '');
    $address = clean($b['address'] ?? '');
    $city    = clean($b['city']    ?? '');
    $payment = clean($b['payment'] ?? 'cod');
    $notes   = clean($b['notes']   ?? '');
    $items   = $b['items']  ?? [];
    $total   = (float)($b['total'] ?? 0);

    if (!$name || !$email || !$address || empty($items))
        send(['error'=>'Name, email, address and items required'],422);

    $stmt = $conn->prepare(
        'INSERT INTO orders (user_name,user_email,user_phone,address,city,total,payment,notes)
         VALUES (?,?,?,?,?,?,?,?)'
    );
    $stmt->bind_param('sssssdss',$name,$email,$phone,$address,$city,$total,$payment,$notes);
    if (!$stmt->execute()) send(['error'=>$stmt->error],500);
    $orderId = $conn->insert_id;

    $si = $conn->prepare(
        'INSERT INTO order_items (order_id,product_id,name,price,qty,shade) VALUES (?,?,?,?,?,?)'
    );
    foreach ($items as $item) {
        $pid    = (int)($item['id']    ?? 0);
        $iname  = clean($item['name']  ?? '');
        $iprice = (float)($item['price'] ?? 0);
        $qty    = (int)($item['qty']   ?? 1);
        $shade  = clean($item['shade'] ?? '');
        $si->bind_param('iisdis',$orderId,$pid,$iname,$iprice,$qty,$shade);
        $si->execute();
        if ($pid > 0)
            $conn->query("UPDATE products SET stock = GREATEST(0, stock - $qty) WHERE id = $pid");
    }
    send(['order_id'=>$orderId,'message'=>'Order placed'],201);
}

if ($method === 'GET' && $action === 'orders') {
    requireAdmin();
    $rows = $conn->query(
        'SELECT o.*,
                COALESCE(GROUP_CONCAT(oi.name SEPARATOR ", "),"") as product_names,
                COALESCE(SUM(oi.qty),0) as item_count
         FROM orders o
         LEFT JOIN order_items oi ON oi.order_id = o.id
         GROUP BY o.id ORDER BY o.created_at DESC'
    )->fetch_all(MYSQLI_ASSOC);
    foreach ($rows as &$r) {
        $r['total']      = (float)$r['total'];
        $r['item_count'] = (int)$r['item_count'];
    }
    send($rows);
}

if ($method === 'PUT' && $action === 'order_status') {
    requireAdmin();
    $id     = (int)($_GET['id'] ?? 0);
    $status = clean(body()['status'] ?? '');
    $allowed = ['pending','processing','shipped','delivered','cancelled'];
    if (!in_array($status,$allowed)) send(['error'=>'Invalid status'],422);
    $stmt = $conn->prepare('UPDATE orders SET status=? WHERE id=?');
    $stmt->bind_param('si',$status,$id);
    if (!$stmt->execute()) send(['error'=>$stmt->error],500);
    send(['message'=>'Status updated']);
}

// ── AUTH — ADMIN ─────────────────────────────────────────

if ($method === 'POST' && $action === 'admin_login') {
    $b        = body();
    $username = clean($b['username'] ?? '');
    $password = $b['password'] ?? '';
    $stmt = $conn->prepare('SELECT id,username,password FROM admin_users WHERE username=?');
    $stmt->bind_param('s',$username); $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();
    $ok  = $row && (
        $row['password'] === $password ||
        password_verify($password,$row['password'])
    );
    if (!$ok) send(['error'=>'Invalid username or password'],401);
    session_regenerate_id(true);
    $_SESSION['admin_logged_in'] = true;
    $_SESSION['admin_id']        = $row['id'];
    $_SESSION['admin_name']      = $row['username'];
    send(['message'=>'Logged in','name'=>$row['username'],'session_id'=>session_id()]);
}

if ($method === 'POST' && $action === 'admin_logout') {
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $p = session_get_cookie_params();
        setcookie(session_name(),'',time()-42000,$p['path'],$p['domain'],$p['secure'],$p['httponly']);
    }
    session_destroy();
    send(['message'=>'Logged out']);
}

if ($method === 'GET' && $action === 'admin_me') {
    if (!empty($_SESSION['admin_logged_in']))
        send(['logged_in'=>true,'name'=>$_SESSION['admin_name'],'role'=>'admin']);
    send(['logged_in'=>false]);
}

// ── STATS ────────────────────────────────────────────────

if ($method === 'GET' && $action === 'stats') {
    requireAdmin();
    $total   = (int)$conn->query('SELECT COUNT(*) c FROM products')->fetch_assoc()['c'];
    $low     = (int)$conn->query('SELECT COUNT(*) c FROM products WHERE stock < 10')->fetch_assoc()['c'];
    $revenue = (float)$conn->query("SELECT COALESCE(SUM(total),0) s FROM orders WHERE status != 'cancelled'")->fetch_assoc()['s'];
    $orders  = (int)$conn->query('SELECT COUNT(*) c FROM orders')->fetch_assoc()['c'];
    $pending = (int)$conn->query("SELECT COUNT(*) c FROM orders WHERE status='pending'")->fetch_assoc()['c'];
    $cats    = $conn->query('SELECT category, COUNT(*) c FROM products GROUP BY category')->fetch_all(MYSQLI_ASSOC);
    send(compact('total','low','revenue','orders','pending','cats'));
}

send(['error'=>"Unknown action: $action"],404);
