# Laravel API - Backend Service

Backend API cho hệ thống thương mại điện tử, được xây dựng bằng Laravel và Sanctum.

## Tính Năng

- RESTful API với xác thực qua Sanctum
- Quản lý sản phẩm, danh mục, thương hiệu
- Flash sale với đếm ngược thời gian
- Voucher với nhiều loại giảm giá
- Tích hợp thanh toán VNPay
- Đánh giá sản phẩm
- Theo dõi đơn hàng
- Phân quyền admin

## Cài Đặt

1. Clone repository:
```bash
git clone <repository-url>
cd laravel-api
```

2. Cài đặt dependencies:
```bash
composer install
```

3. Cấu hình môi trường:
```bash
cp .env.example .env
php artisan key:generate
```

4. Cấu hình database trong file .env:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

5. Chạy migration và seeder:
```bash
php artisan migrate --seed
```

6. Khởi chạy server:
```bash
php artisan serve
```

## API Documentation

### Authentication

#### Đăng Ký
```
POST /api/register
Content-Type: application/json

{
    "name": "Người Dùng",
    "email": "user@example.com",
    "password": "password",
    "password_confirmation": "password"
}
```

#### Đăng Nhập
```
POST /api/login
Content-Type: application/json

{
    "email": "user@example.com",
    "password": "password"
}
```

### Products

#### Lấy Danh Sách Sản Phẩm
```
GET /api/products
```

#### Chi Tiết Sản Phẩm
```
GET /api/products/{id}
```

### Orders

#### Tạo Đơn Hàng
```
POST /api/orders
Authorization: Bearer {token}
Content-Type: application/json

{
    "items": [
        {
            "product_id": 1,
            "quantity": 2
        }
    ],
    "shipping_address": "123 Đường ABC, Quận 1, TP.HCM",
    "payment_method": "vnpay"
}
```

## Cấu Trúc Database

### Products
- id
- name
- slug
- description
- price
- sale_price
- stock
- category_id
- brand_id
- created_at
- updated_at

### Categories
- id
- name
- slug
- parent_id
- created_at
- updated_at

### Orders
- id
- user_id (nullable for guest checkout)
- status
- total_amount
- payment_method
- payment_status
- shipping_address
- created_at
- updated_at

## Error Handling

Tất cả các lỗi được trả về dưới dạng JSON với mã HTTP tương ứng:

```json
{
    "message": "Thông báo lỗi",
    "errors": {
        "field": ["Lỗi chi tiết"]
    }
}
```

## Security

- Sử dụng Laravel Sanctum cho API authentication
- CORS được cấu hình cho web và mobile app
- Rate limiting cho các endpoint quan trọng
- Validation cho tất cả input

## Testing

Chạy unit tests:
```bash
php artisan test
```

## License

MIT License
