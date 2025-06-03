# Vietnamese E-commerce System

Hệ thống thương mại điện tử toàn diện được xây dựng với Laravel, React và React Native.

## Cấu Trúc Dự Án

```
/
├── laravel-api/    # Backend API với Laravel + Sanctum
├── web-app/        # Frontend với React + TailwindCSS
└── mobile-app/     # Ứng dụng di động với React Native
```

## Modules

### 1. Laravel API (Backend)
- RESTful API với Laravel và Sanctum
- Xử lý thanh toán qua VNPay
- Quản lý sản phẩm, đơn hàng, flash sale, và voucher
- Chi tiết: Xem [laravel-api/README.md](laravel-api/README.md)

### 2. Web Frontend
- React + TailwindCSS
- SEO động với react-helmet
- Thanh toán không cần đăng nhập
- Giao diện quản trị
- Chi tiết: Xem [web-app/README.md](web-app/README.md)

### 3. Mobile App
- React Native
- Thanh toán yêu cầu đăng nhập
- Giỏ hàng lưu cục bộ
- Chi tiết: Xem [mobile-app/README.md](mobile-app/README.md)

## Cài Đặt

Mỗi module có hướng dẫn cài đặt riêng. Vui lòng tham khảo file README.md trong từng thư mục tương ứng.

## Yêu Cầu Hệ Thống

- PHP >= 8.1
- Node.js >= 16
- MySQL >= 8.0
- Composer
- npm hoặc yarn
