# 🌸 Lueur Beauty — E-Commerce Website

A full-stack cosmetics e-commerce website built with **PHP, MySQL, and Docker**.

![Lueur Beauty](https://images.unsplash.com/photo-1457972729786-0411a3b2b626?auto=format&fit=crop&w=1200&q=80)

---

## ✨ Features

### 🛍️ Customer Side
- Beautiful homepage with product showcase
- Shop by category — Lips, Eyes, Face, Skin, Cheeks
- Add to cart with live quantity control
- Guest checkout — no login required
- Order confirmation with order number

### ⚙️ Admin Panel
- Secure admin login
- Dashboard with live stats (products, orders, revenue)
- Add / Edit / Delete products
- Image upload (file or URL)
- Order management with status updates

---

## 🖥️ Tech Stack

| Layer | Technology |
|-------|-----------|
| Frontend | HTML, CSS, Vanilla JavaScript |
| Backend | PHP 8.1 |
| Database | MySQL 8.0 |
| Server | Apache |
| DevOps | Docker & Docker Compose |

---

## 🚀 Quick Start

### Prerequisites
- [Docker Desktop](https://www.docker.com/products/docker-desktop/) installed

### Run the project

```bash
# Clone the repo
git clone https://github.com/YOUR_USERNAME/lueur-beauty.git
cd lueur-beauty

# Start everything
docker compose up --build
```

Open browser → **http://localhost:8080**

### First time setup
```bash
# If you have old data, clear it first
docker compose down -v
docker compose up --build
```

---

## 🔐 Admin Access

| Field | Value |
|-------|-------|
| URL | http://localhost:8080 → Footer → "Admin login" |
| Username | `Rameeza` |
| Password | `rameeza123` |

---

## 📁 Project Structure

```
lueur-beauty/
├── index.php          → Main frontend (SPA - all pages)
├── api.php            → REST API (all backend routes)
├── db.php             → Database connection
├── init.sql           → Database schema + seed data
├── uploads/           → Product images
├── Dockerfile
├── docker-compose.yml
└── README.md
```

---

## 🌐 API Endpoints

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `api.php?action=products` | Get all products |
| GET | `api.php?action=products&category=Lips` | Filter by category |
| POST | `api.php?action=product` | Add product (admin) |
| PUT | `api.php?action=product&id=1` | Update product (admin) |
| DELETE | `api.php?action=product&id=1` | Delete product (admin) |
| POST | `api.php?action=order` | Place order |
| GET | `api.php?action=orders` | Get all orders (admin) |
| PUT | `api.php?action=order_status&id=1` | Update order status (admin) |
| POST | `api.php?action=admin_login` | Admin login |
| GET | `api.php?action=stats` | Dashboard stats (admin) |

---

## 🗄️ Database Schema

```sql
products     (id, name, kind, category, description, price, 
              original_price, stock, shade_hex, image_url, reviews)

admin_users  (id, username, password)

orders       (id, user_name, user_email, user_phone, 
              address, city, total, status, payment, notes)

order_items  (id, order_id, product_id, name, price, qty, shade)
```

---

## 📸 Screenshots

> Add your screenshots here after taking them!
> 
> Suggested: Home, Shop, Cart, Checkout, Admin Dashboard, Orders

---

## 🔮 Future Improvements

- [ ] Product search
- [ ] User accounts & order history
- [ ] Coupon/discount codes
- [ ] Email confirmation on order
- [ ] Payment gateway integration
- [ ] Deploy on AWS EC2

---

## 👩‍💻 Developer

**Rameeza** — Full Stack Developer  
GitHub: [@YOUR_USERNAME](https://github.com/YOUR_USERNAME)

---

## 📄 License

MIT License — feel free to use this project!
