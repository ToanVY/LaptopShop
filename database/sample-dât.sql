-- Sample data for LaptopStore
INSERT INTO categories (name) VALUES
('Gaming'),
('Ultrabook'),
('Đồ họa'),
('Văn phòng');

INSERT INTO products (name, price, category_id, cpu, ram, ssd, gpu, screen, description, image, badge, badgeColor, stock) VALUES
('ASUS ROG Strix G16', 34990000, 1, 'Intel Core i7-13650HX', '32GB', '1TB SSD', 'RTX 4060', '16 inch', 'Laptop gaming mạnh mẽ cho trải nghiệm chơi game và đồ họa.', 'assets/images/laptops/asus-rog-g16.png', 'Mới', 'danger', 8),
('Dell XPS 13 Plus', 28990000, 2, 'Intel Core i7-13700H', '16GB', '512GB SSD', 'Intel Iris Xe', '13.4 inch', 'Ultrabook mỏng nhẹ, hiệu năng ổn định cho công việc.', 'assets/images/laptops/dell-xps.png', 'Bán chạy', 'success', 5),
('MacBook Air M2', 32990000, 2, 'Apple M2', '16GB', '512GB SSD', 'Apple GPU 10-core', '13.6 inch', 'Laptop mỏng nhẹ, tiết kiệm pin và hiệu năng vượt trội.', 'assets/images/laptops/macbook-air.png', 'Hot', 'info', 6);
