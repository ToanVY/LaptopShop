CREATE DATABASE IF NOT EXISTS LaptopStore CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE LaptopStore;

CREATE TABLE IF NOT EXISTS categories (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  price INT NOT NULL DEFAULT 0,
  category_id INT NOT NULL DEFAULT 0,
  cpu VARCHAR(100) DEFAULT '',
  ram VARCHAR(50) DEFAULT '',
  ssd VARCHAR(50) DEFAULT '',
  gpu VARCHAR(100) DEFAULT '',
  screen VARCHAR(100) DEFAULT '',
  description TEXT DEFAULT NULL,
  image VARCHAR(255) DEFAULT '',
  badge VARCHAR(50) DEFAULT '',
  badgeColor VARCHAR(30) DEFAULT 'primary',
  stock INT NOT NULL DEFAULT 10,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS orders (
  id INT AUTO_INCREMENT PRIMARY KEY,
  customer_name VARCHAR(100) NOT NULL,
  phone VARCHAR(20) NOT NULL,
  address TEXT NOT NULL,
  note TEXT DEFAULT NULL,
  total_amount INT NOT NULL DEFAULT 0,
  order_status VARCHAR(50) NOT NULL DEFAULT 'Đang xử lý',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS order_details (
  id INT AUTO_INCREMENT PRIMARY KEY,
  order_id INT NOT NULL,
  product_id INT NOT NULL,
  price INT NOT NULL DEFAULT 0,
  quantity INT NOT NULL DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO categories (name) VALUES
('Gaming'),
('Ultrabook'),
('Đồ họa'),
('Văn phòng')
ON DUPLICATE KEY UPDATE name = VALUES(name);

INSERT INTO products (name, price, category_id, cpu, ram, ssd, gpu, screen, description, image, badge, badgeColor, stock) VALUES
('ASUS ROG Strix G16', 34990000, 1, 'Intel Core i7-13650HX', '32GB', '1TB SSD', 'RTX 4060', '16 inch', 'Laptop gaming mạnh mẽ cho trải nghiệm chơi game và đồ họa.', 'assets/images/laptops/asus-rog-g16.png', 'Mới', 'danger', 8),
('Dell XPS 13 Plus', 28990000, 2, 'Intel Core i7-13700H', '16GB', '512GB SSD', 'Intel Iris Xe', '13.4 inch', 'Ultrabook mỏng nhẹ, hiệu năng ổn định cho công việc.', 'assets/images/laptops/dell-xps.png', 'Bán chạy', 'success', 5),
('MacBook Air M2', 32990000, 2, 'Apple M2', '16GB', '512GB SSD', 'Apple GPU 10-core', '13.6 inch', 'Laptop mỏng nhẹ, tiết kiệm pin và hiệu năng vượt trội.', 'assets/images/laptops/macbook-air.png', 'Hot', 'info', 6),
('Lenovo Legion 5', 24990000, 1, 'AMD Ryzen 7 6800H', '16GB', '512GB SSD', 'RTX 3060', '15.6 inch', 'Laptop gaming giá tốt, bền bỉ và tản nhiệt tốt.', 'assets/images/laptops/lenovo-legion.png', 'Giảm giá', 'warning', 4)
ON DUPLICATE KEY UPDATE name = VALUES(name);
