# 🌸 Lueur Beauty — E-Commerce Website

A full-stack cosmetics e-commerce website built with **PHP, MySQL, and Docker**.

🌐 **Live Demo:** https://lueur-beauty.rf.gd

---

## 📸 Screenshots

<img width="947" height="439" alt="image" src="https://github.com/user-attachments/assets/27f0904f-8748-47bb-bbf4-318ee213ce64" />

<img width="938" height="434" alt="image" src="https://github.com/user-attachments/assets/267ac3eb-c1ac-4847-9717-21f872941431" />

<img width="941" height="435" alt="image" src="https://github.com/user-attachments/assets/4005d5d1-8693-4987-b087-b27e7c43d1fd" />

<img width="948" height="359" alt="image" src="https://github.com/user-attachments/assets/29c9490a-4fd8-4c55-810b-3d3ac7d3da70" />

---

## ✨ Features

### 🛍️ Customer Side
- Beautiful homepage with product showcase
- Shop by category — Lips, Eyes, Face, Skin, Cheeks
- Add to cart with live quantity control
- Guest checkout — no login required
- Order confirmation with order number

<img width="937" height="432" alt="image" src="https://github.com/user-attachments/assets/5e42c2a5-525f-41ef-876a-f36071f9c147" />
<img width="548" height="438" alt="image" src="https://github.com/user-attachments/assets/0509dc09-ccf4-403e-97df-bf95c73b2cb3" />
<img width="844" height="420" alt="image" src="https://github.com/user-attachments/assets/9fd83849-27aa-4e60-bf0b-fc19346dd168" />
<img width="959" height="349" alt="image" src="https://github.com/user-attachments/assets/9f964ced-cf91-4a51-ac21-ecc0a3fff47d" />

### ⚙️ Admin Panel
- Secure admin login
- Dashboard with live stats (products, orders, revenue)
- Add / Edit / Delete products
- Image upload (file or URL)
- Order management with status updates

<img width="389" height="413" alt="image" src="https://github.com/user-attachments/assets/07479a84-fa7e-4740-a28d-fb16a31c3c73" />
<img width="935" height="428" alt="image" src="https://github.com/user-attachments/assets/d2d71315-60df-4b2c-a8c7-aa944db83120" />
<img width="913" height="435" alt="image" src="https://github.com/user-attachments/assets/a195905f-935e-4bd1-ada0-0fba817ef5cc" />
<img width="937" height="429" alt="image" src="https://github.com/user-attachments/assets/6156fe04-d9cc-4fb2-9ace-db685b49295d" />

---

## 🖥️ Tech Stack

| Layer | Technology |
|-------|-----------|
| Frontend | HTML, CSS, Vanilla JavaScript |
| Backend | PHP 8.1 |
| Database | MySQL 8.0 |
| Server | Nginx + PHP-FPM |
| DevOps | Docker & Docker Compose |

---

## 🚀 Quick Start (Local)

### Prerequisites
- [Docker Desktop](https://www.docker.com/products/docker-desktop/) installed

### Run the project

```bash
# Clone the repo
git clone https://github.com/rrameeza196/lueur-beauty.git
cd lueur-beauty

# Start everything
docker compose up --build
```

Open browser → **http://localhost:8080**

### First time / fresh start
```bash
docker compose down -v
docker compose up --build
```

---

## 🔐 Admin Access

| | |
|--|--|
| 🌐 Live site | https://lueur-beauty.rf.gd |
| 💻 Local | http://localhost:8080 |
| 👤 Username | Contact developer |
| 🔒 Password | Contact developer |

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

## 🔮 Future Improvements

- [ ] Product search & filters
- [ ] User accounts & order history
- [ ] Coupon / discount codes
- [ ] Email confirmation on order
- [ ] Payment gateway integration

---

## 👩‍💻 Developer

**Rameeza** — Full Stack Developer
GitHub: [rrameeza196](https://github.com/rrameeza196)

---

## 📄 License

MIT License — feel free to use this project!
