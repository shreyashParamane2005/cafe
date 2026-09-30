CREATE DATABASE IF NOT EXISTS cafe_db CHARACTER SET utf8mb4;
USE cafe_db;

CREATE TABLE IF NOT EXISTS admins (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS menu_items (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  category VARCHAR(30) NOT NULL,
  description VARCHAR(255) NOT NULL,
  price DECIMAL(7,2) NOT NULL,
  emoji VARCHAR(8) DEFAULT '☕',
  featured TINYINT(1) DEFAULT 0
);

CREATE TABLE IF NOT EXISTS reservations (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL,
  phone VARCHAR(20) NOT NULL,
  res_date DATE NOT NULL,
  res_time VARCHAR(5) NOT NULL,
  guests TINYINT NOT NULL,
  note VARCHAR(255) DEFAULT NULL,
  status ENUM('pending','confirmed') DEFAULT 'pending',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS messages (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL,
  message TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO menu_items (name, category, description, price, emoji, featured) VALUES
('Cappuccino', 'Coffee', 'Espresso with silky steamed milk and foam.', 160, '☕', 1),
('Cold Brew', 'Coffee', 'Slow-steeped for 18 hours, smooth and bold.', 190, '🧊', 0),
('Hazelnut Latte', 'Coffee', 'Creamy latte with roasted hazelnut syrup.', 200, '☕', 0),
('Butter Croissant', 'Food', 'Flaky, golden and baked fresh every morning.', 120, '🥐', 1),
('Paneer Sandwich', 'Food', 'Grilled sourdough with spiced paneer and greens.', 180, '🥪', 0),
('Pasta Alfredo', 'Food', 'Creamy white sauce pasta with herbs.', 260, '🍝', 0),
('Chocolate Brownie', 'Dessert', 'Warm fudgy brownie with a scoop of ice cream.', 150, '🍫', 1),
('Blueberry Cheesecake', 'Dessert', 'Baked cheesecake with blueberry compote.', 220, '🍰', 0);
