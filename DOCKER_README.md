# 🐳 Docker Setup — Makeup World

## Prerequisites
Install **Docker Desktop**: https://www.docker.com/products/docker-desktop/

---

## ▶️ Run the Project (3 commands only)

```bash
# 1. Go into project folder
cd Makeup_world-main

# 2. Build and start everything
docker-compose up --build

# 3. Open in browser
# Website:    http://localhost:8080
# phpMyAdmin: http://localhost:8081
```

---

## 🔐 Login Credentials
| | |
|---|---|
| Admin Username | Maryam |
| Admin Password | 1234 |
| DB Root Password | makeup123 |

---

## 🛑 Stop the Project
```bash
docker-compose down
```

## 🗑️ Stop + Delete Database (full reset)
```bash
docker-compose down -v
```

---

## 📦 What's Running

| Container | What it does | Port |
|---|---|---|
| `makeup_app` | PHP + Apache (your website) | http://localhost:8080 |
| `makeup_db` | MySQL database | localhost:3307 |
| `makeup_phpmyadmin` | Visual DB manager | http://localhost:8081 |

---

## 💡 Live Editing
Your files are mounted as a volume — edit any `.php` file and **refresh the browser**, changes appear instantly. No rebuild needed!
