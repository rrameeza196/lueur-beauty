CREATE DATABASE IF NOT EXISTS makeup_db;
USE makeup_db;

DROP TABLE IF EXISTS order_items;
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS products;
DROP TABLE IF EXISTS admin_users;

CREATE TABLE products (
    id             INT AUTO_INCREMENT PRIMARY KEY,
    name           VARCHAR(255)  NOT NULL,
    kind           VARCHAR(100)  NOT NULL DEFAULT '',
    category       VARCHAR(100)  NOT NULL DEFAULT 'Lips',
    description    TEXT,
    price          DECIMAL(10,2) NOT NULL DEFAULT 0,
    original_price DECIMAL(10,2) NOT NULL DEFAULT 0,
    stock          INT           NOT NULL DEFAULT 0,
    shade_hex      VARCHAR(10)   NOT NULL DEFAULT '#C17A57',
    image_url      VARCHAR(500)  NOT NULL DEFAULT '',
    reviews        INT           NOT NULL DEFAULT 0,
    created_at     TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE admin_users (
    id       INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE orders (
    id           INT AUTO_INCREMENT PRIMARY KEY,
    user_name    VARCHAR(255) NOT NULL,
    user_email   VARCHAR(255) NOT NULL,
    user_phone   VARCHAR(50)  NOT NULL DEFAULT '',
    address      TEXT         NOT NULL,
    city         VARCHAR(100) NOT NULL DEFAULT '',
    total        DECIMAL(10,2) NOT NULL DEFAULT 0,
    status       ENUM('pending','processing','shipped','delivered','cancelled') DEFAULT 'pending',
    payment      VARCHAR(50)  NOT NULL DEFAULT 'cod',
    notes        TEXT,
    created_at   TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE order_items (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    order_id   INT NOT NULL,
    product_id INT NOT NULL,
    name       VARCHAR(255) NOT NULL,
    price      DECIMAL(10,2) NOT NULL,
    qty        INT NOT NULL DEFAULT 1,
    shade      VARCHAR(50) DEFAULT '',
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE
);

-- Admin: Maryam / 1234 (plain text, api.php checks both plain and bcrypt)
INSERT INTO admin_users (username, password) VALUES ('Rameeza', '1234');

-- Sample products
INSERT INTO products (name,kind,category,description,price,original_price,stock,shade_hex,image_url,reviews) VALUES
('Petal Glow Lip Oil',       'Lip oil',      'Lips',   'A sheer glossy oil that conditions and adds the prettiest flush.',        24.00, 30.00, 80, '#D98C7A', 'https://images.unsplash.com/photo-1586495777744-4413f21062fa?auto=format&fit=crop&w=600&q=80', 412),
('Sun-Washed Cheek Tint',    'Cream blush',  'Cheeks', 'Buildable cream blush in a warm terracotta that suits every skin tone.', 28.00, 34.00, 55, '#C97A5E', 'https://images.unsplash.com/photo-1631214524020-7e18db9a8f92?auto=format&fit=crop&w=600&q=80', 287),
('Second-Skin Tint SPF',     'Skin tint',    'Skin',   'A feather-light tint that blurs, evens, and protects with SPF 30.',      38.00, 44.00, 40, '#C99877', 'https://images.unsplash.com/photo-1620916566398-39f1143ab7be?auto=format&fit=crop&w=600&q=80', 531),
('Soft Lash Conditioning',   'Mascara',      'Eyes',   'Lengthening mascara with a conditioning serum. Natural, never spidery.', 26.00, 32.00, 90, '#5A4030', 'https://images.unsplash.com/photo-1512496015851-a90fb38ba796?auto=format&fit=crop&w=600&q=80', 198),
('Velvet Matte Lipstick',    'Lip',          'Lips',   'Rich pigment, velvety finish, lasting all day without drying.',           25.00, 31.00, 65, '#A85C3C', 'https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?auto=format&fit=crop&w=600&q=80', 356),
('Warm Haze Eyeshadow Quad', 'Eye',          'Eyes',   'Four buttery blendable shades from sheer nude to deep sienna.',          34.00, 40.00, 45, '#8C6A4E', 'https://images.unsplash.com/photo-1596462502278-27bfdc403348?auto=format&fit=crop&w=600&q=80', 221),
('Soft-Focus Pressed Powder','Complexion',   'Face',   'Finely-milled powder that diffuses light and sets makeup all day.',      30.00, 36.00, 70, '#D2A988', 'https://images.unsplash.com/photo-1571781926291-c477ebfd024b?auto=format&fit=crop&w=600&q=80', 164),
('Luminous Cream Highlighter','Complexion',  'Face',   'A light-reflecting cream that gives cheekbones a sun-kissed glow.',      27.00, 33.00, 50, '#E2B59C', 'https://images.unsplash.com/photo-1599733589046-75e0e6d5e8d0?auto=format&fit=crop&w=600&q=80', 189);
