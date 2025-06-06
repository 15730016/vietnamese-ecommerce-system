# Hướng dẫn kiểm tra và xử lý lỗi duplicate column "role" trong bảng users

1. Kết nối vào database MySQL/PostgreSQL của bạn.

2. Kiểm tra xem cột "role" đã tồn tại trong bảng users chưa bằng câu lệnh SQL:

```sql
SHOW COLUMNS FROM users LIKE 'role';
```

hoặc với PostgreSQL:

```sql
SELECT column_name FROM information_schema.columns WHERE table_name='users' AND column_name='role';
```

3. Nếu kết quả trả về có cột "role" nghĩa là cột đã tồn tại, bạn không cần chạy migration thêm cột "role" nữa.

4. Nếu bạn muốn rollback migration thêm cột "role", bạn có thể rollback batch 1 migration (cẩn thận vì có nhiều migration khác trong batch 1):

```bash
php artisan migrate:rollback --step=1
```

hoặc rollback toàn bộ batch 1:

```bash
php artisan migrate:reset
```

5. Nếu bạn không muốn migration thêm cột "role" chạy nữa, bạn có thể xóa hoặc đổi tên file migration `2024_06_04_000000_add_role_to_users_table.php`.

6. Sau khi xử lý xong, chạy lại migration:

```bash
php artisan migrate
```

Nếu cần hỗ trợ thêm, vui lòng liên hệ.
