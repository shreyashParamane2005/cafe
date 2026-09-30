# Brew & Bite Café Website

HTML, CSS, JavaScript frontend + PHP/MySQL backend (menu, table reservations, contact form, admin dashboard).

## Run on XAMPP
1. Copy this folder to `C:\xampp\htdocs\cafe-website`.
2. Start Apache and MySQL in XAMPP.
3. Open http://localhost/phpmyadmin -> SQL tab -> paste `database.sql` -> Go.
4. Open http://localhost/cafe-website/
5. Admin: http://localhost/cafe-website/admin/login.php  (admin / admin123)

## GitHub
git init && git add . && git commit -m "Initial commit"
git branch -M main
git remote add origin https://github.com/YOUR-USERNAME/cafe-website.git
git push -u origin main

## Deploy from GitHub to XAMPP
cd C:\xampp\htdocs
git clone https://github.com/YOUR-USERNAME/cafe-website.git
(update later with git pull)
