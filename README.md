# 💻 LaptopShop

Website bán laptop được xây dựng bằng **PHP + MySQL (XAMPP)** với giao diện Responsive sử dụng **Bootstrap 5**. Hệ thống hỗ trợ khách hàng xem sản phẩm, đặt hàng và cung cấp trang quản trị (Admin) để quản lý toàn bộ cửa hàng.

---

## 🚀 Công nghệ sử dụng

### Frontend
- HTML5
- CSS3
- Bootstrap 5
- Bootstrap Icons
- JavaScript (ES6)

### Backend
- PHP 8.x
- MySQL
- XAMPP

### Thư viện
- Chart.js (Dashboard thống kê)
- Font Awesome / Bootstrap Icons

---

# 📂 Cấu trúc thư mục

```
LaptopStore1/
│
├── admin/                 # Trang quản trị
│   ├── dashboard.php
│   ├── categories/
│   ├── products/
│   ├── orders/
│   ├── users/
│   └── reports/
│
├── api/                   # API xử lý Ajax
│   ├── checkout.php
│   ├── filter.php
│   └── search.php
│
├── assets/
│   ├── css/
│   ├── js/
│   └── images/
│
├── config/
│   └── database.php
│
├── includes/
│   ├── header.php
│   ├── footer.php
│   ├── navbar.php
│   ├── functions.php
│   └── product-card.php
│
├── uploads/
│
├── index.php
├── products.php
├── detail.php
├── cart.php
├── checkout.php
├── login.php
└── register.php
```

---

# 👤 Phân quyền

## Khách vãng lai (Guest)

- Xem danh sách sản phẩm
- Xem chi tiết sản phẩm
- Tìm kiếm sản phẩm
- Lọc theo danh mục
- Lọc theo giá
- Thêm sản phẩm vào giỏ hàng
- Cập nhật số lượng
- Xóa khỏi giỏ hàng
- Đặt hàng

---

## Quản trị viên (Admin)

### Dashboard

- Thống kê tổng sản phẩm
- Thống kê đơn hàng
- Thống kê doanh thu
- Thống kê khách hàng
- Biểu đồ doanh thu
- Biểu đồ đơn hàng
- Biểu đồ tồn kho

### Quản lý danh mục

- Thêm danh mục
- Sửa danh mục
- Xóa danh mục

### Quản lý sản phẩm

- Thêm sản phẩm
- Sửa sản phẩm
- Xóa sản phẩm
- Quản lý tồn kho

### Quản lý đơn hàng

- Xem danh sách đơn
- Cập nhật trạng thái
- Xóa đơn hàng

### Quản lý người dùng

- Danh sách tài khoản
- Phân quyền

---

# 🗄️ Cơ sở dữ liệu

Hệ thống sử dụng MySQL gồm 5 bảng chính.

```
categories
│
└── Danh mục sản phẩm

products
│
└── Thông tin laptop

orders
│
└── Thông tin đơn hàng

order_details
│
└── Chi tiết từng sản phẩm trong đơn

users
│
└── Quản trị viên
```

---

# 📦 Chức năng chính

## Sản phẩm

- Hiển thị sản phẩm
- Chi tiết sản phẩm
- Tìm kiếm
- Lọc
- Phân trang

---

## Giỏ hàng

- Thêm sản phẩm
- Cập nhật số lượng
- Xóa sản phẩm
- Tính tổng tiền

---

## Thanh toán

- Nhập thông tin khách hàng
- Lưu đơn hàng
- Lưu chi tiết đơn hàng
- Cập nhật tồn kho

---

## Dashboard

Dashboard sử dụng **Chart.js** để hiển thị:

- Doanh thu
- Đơn hàng
- Tồn kho
- Trạng thái đơn hàng

---

# ⚙️ Hướng dẫn cài đặt

## 1. Clone project

```bash
git clone https://github.com/ToanVY/LaptopShop.git
```

---

## 2. Copy project

Đưa project vào thư mục:

```
xampp/htdocs/
```

---

## 3. Tạo Database

Tạo database:

```
laptopshop
```

Import file SQL.

---

## 4. Cấu hình Database

Mở:

```
config/database.php
```

Sửa:

```php
$host="localhost";
$user="root";
$password="";
$database="laptopshop";
```

---

## 5. Chạy Website

```
http://localhost/LaptopStore1
```

---

## 6. Đăng nhập Admin

```
Username

admin

Password

admin
```

---

# 📈 Một số giao diện

- Trang chủ
- Danh sách sản phẩm
- Chi tiết sản phẩm
- Giỏ hàng
- Thanh toán
- Dashboard Admin
- Quản lý sản phẩm
- Quản lý danh mục
- Quản lý đơn hàng

---

# 📌 Điểm nổi bật

- Responsive trên Desktop, Tablet và Mobile
- Bootstrap 5
- PHP thuần
- MySQL
- Quản lý sản phẩm
- Dashboard thống kê
- Chart.js
- CRUD đầy đủ
- Giỏ hàng Session
- Thanh toán
- Quản lý tồn kho

---

# 🔮 Hướng phát triển

- Đăng nhập khách hàng
- Phân quyền nhiều cấp
- Thanh toán VNPay
- Thanh toán MoMo
- Upload ảnh sản phẩm
- Đánh giá sản phẩm
- Yêu thích sản phẩm
- Quản lý khuyến mãi
- Email xác nhận đơn hàng
- Quản lý mã giảm giá
- REST API
- JWT Authentication

---
