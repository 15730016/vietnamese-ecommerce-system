<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Banner;
use App\Models\Post;
use App\Models\FlashSale;
use App\Models\Voucher;
use App\Models\Menu;
use App\Models\Service;
use App\Models\DynamicPage;
use App\Models\Team;
use App\Models\Ticket;
use App\Models\FrontendSetting;
use Illuminate\Support\Facades\Hash;

class DemoDataSeeder extends Seeder
{
    public function run()
    {
        // Create admin user
        User::firstOrCreate(
            ['email' => 'admin@haxuvina.com'],
            [
                'name' => 'Người Quản Trị',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // Create categories (from haxuvina.com)
        $categories = [
            ['name' => 'Điện thoại', 'slug' => 'dien-thoai'],
            ['name' => 'Máy tính bảng', 'slug' => 'may-tinh-bang'],
            ['name' => 'Phụ kiện', 'slug' => 'phu-kien'],
            ['name' => 'Laptop', 'slug' => 'laptop'],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(['slug' => $category['slug']], $category);
        }

        // Create brands (from haxuvina.com)
        $brands = [
            ['name' => 'Apple', 'slug' => 'apple'],
            ['name' => 'Samsung', 'slug' => 'samsung'],
            ['name' => 'Xiaomi', 'slug' => 'xiaomi'],
            ['name' => 'Huawei', 'slug' => 'huawei'],
        ];

        foreach ($brands as $brand) {
            Brand::firstOrCreate(['slug' => $brand['slug']], $brand);
        }

        // Create products (from haxuvina.com)
        $products = [
            [
                'name' => 'iPhone 14 Pro Max',
                'slug' => 'iphone-14-pro-max',
                'description' => 'Điện thoại iPhone 14 Pro Max chính hãng, cấu hình mạnh mẽ, camera sắc nét.',
                'price' => 32990000,
                'category_id' => 1,
                'brand_id' => 1,
                'image' => 'images/logo-haxu-tron.png',
            ],
            [
                'name' => 'Samsung Galaxy S23 Ultra',
                'slug' => 'samsung-galaxy-s23-ultra',
                'description' => 'Điện thoại Samsung Galaxy S23 Ultra với màn hình lớn, camera ấn tượng.',
                'price' => 29990000,
                'category_id' => 1,
                'brand_id' => 2,
                'image' => 'images/logo-haxu-tron.png',
            ],
            [
                'name' => 'Xiaomi Pad 5',
                'slug' => 'xiaomi-pad-5',
                'description' => 'Máy tính bảng Xiaomi Pad 5 hiệu năng cao, pin lâu.',
                'price' => 8990000,
                'category_id' => 2,
                'brand_id' => 3,
                'image' => 'images/logo-haxu-tron.png',
            ],
        ];

        foreach ($products as $product) {
            Product::firstOrCreate(['slug' => $product['slug']], $product);
        }

        // Create product images (example)
        $productImages = [
            ['product_id' => 1, 'image_path' => 'images/logo-haxu-tron.png'],
            ['product_id' => 2, 'image_path' => 'images/logo-haxu-tron.png'],
            ['product_id' => 3, 'image_path' => 'images/logo-haxu-tron.png'],
        ];

        foreach ($productImages as $image) {
            ProductImage::create($image);
        }

        // Create banners (example)
        $banners = [
            [
                'title' => 'Khuyến mãi iPhone 14',
                'image_path' => 'images/logo-haxu-tron.png',
                'link' => '/san-pham/iphone-14-pro-max',
                'position' => 'home_top',
                'status' => true,
            ],
            [
                'title' => 'Samsung Galaxy S23 Ultra',
                'image_path' => 'images/logo-haxu-tron.png',
                'link' => '/san-pham/samsung-galaxy-s23-ultra',
                'position' => 'home_top',
                'status' => true,
            ],
        ];
        foreach ($banners as $banner) {
            Banner::create($banner);
        }

        // Create posts (example)
        $posts = [
            [
                'title' => 'Hướng dẫn mua iPhone 14 Pro Max',
                'slug' => 'huong-dan-mua-iphone-14-pro-max',
                'content' => 'Hướng dẫn chi tiết cách mua iPhone 14 Pro Max chính hãng.',
                'user_id' => 1,
            ],
            [
                'title' => 'Đánh giá Samsung Galaxy S23 Ultra',
                'slug' => 'danh-gia-samsung-galaxy-s23-ultra',
                'content' => 'Đánh giá chi tiết về Samsung Galaxy S23 Ultra.',
                'user_id' => 1,
            ],
        ];
        foreach ($posts as $post) {
            Post::firstOrCreate(['slug' => $post['slug']], $post);
        }

        // Create flash sales (example)
        FlashSale::create([
            'name' => 'Khuyến mãi cuối tuần',
            'start_date' => now(),
            'end_date' => now()->addDays(2),
            'discount_percentage' => 15,
            'status' => 'active',
        ]);

        // Create vouchers (example)
        Voucher::create([
            'code' => 'CHAO2024',
            'type' => 'percentage',
            'value' => 10,
            'start_date' => now(),
            'end_date' => now()->addMonths(1),
            'min_purchase' => 1000000,
            'max_discount' => 500000,
            'usage_limit' => 100,
            'status' => 'active',
        ]);

        // Create menus (example)
        $menus = [
            ['title' => 'Trang chủ', 'url' => '/', 'order' => 1],
            ['title' => 'Cửa hàng', 'url' => '/cua-hang', 'order' => 2],
            ['title' => 'Giới thiệu', 'url' => '/gioi-thieu', 'order' => 3],
            ['title' => 'Liên hệ', 'url' => '/lien-he', 'order' => 4],
        ];
        foreach ($menus as $menu) {
            Menu::create($menu);
        }

        // Create services (example)
        $services = [
            ['title' => 'Miễn phí vận chuyển', 'slug' => 'mien-phi-van-chuyen', 'description' => 'Miễn phí vận chuyển cho đơn hàng trên 1 triệu', 'icon' => 'truck', 'order' => 1],
            ['title' => 'Hỗ trợ 24/7', 'slug' => 'ho-tro-24-7', 'description' => 'Hỗ trợ khách hàng 24/7', 'icon' => 'headphones', 'order' => 2],
            ['title' => 'Hoàn tiền trong 30 ngày', 'slug' => 'hoan-tien-30-ngay', 'description' => 'Hoàn tiền trong vòng 30 ngày', 'icon' => 'refresh-ccw', 'order' => 3],
        ];
        foreach ($services as $service) {
            Service::create($service);
        }

        // Create dynamic pages (example)
        $pages = [
            ['title' => 'Giới thiệu', 'slug' => 'gioi-thieu', 'content' => 'Nội dung giới thiệu về công ty...', 'status' => 'published', 'created_by' => 1],
            ['title' => 'Chính sách bảo mật', 'slug' => 'chinh-sach-bao-mat', 'content' => 'Nội dung chính sách bảo mật...', 'status' => 'published', 'created_by' => 1],
            ['title' => 'Điều khoản dịch vụ', 'slug' => 'dieu-khoan-dich-vu', 'content' => 'Nội dung điều khoản dịch vụ...', 'status' => 'published', 'created_by' => 1],
        ];
        foreach ($pages as $page) {
            DynamicPage::create($page);
        }

        // Create team members (example)
        $teams = [
            [
                'name' => 'Nguyễn Văn A',
                'position' => 'Giám đốc',
                'description' => 'Người sáng lập và giám đốc',
                'email' => 'nguyenvana@haxuvina.com',
                'social_links' => [
                    'linkedin' => 'https://linkedin.com/nguyenvana',
                    'twitter' => 'https://twitter.com/nguyenvana'
                ],
                'order' => 1
            ],
            [
                'name' => 'Trần Thị B',
                'position' => 'Trưởng phòng kỹ thuật',
                'description' => 'Trưởng phòng kỹ thuật',
                'email' => 'tranthib@haxuvina.com',
                'social_links' => [
                    'linkedin' => 'https://linkedin.com/tranthib',
                    'twitter' => 'https://twitter.com/tranthib'
                ],
                'order' => 2
            ]
        ];
        foreach ($teams as $team) {
            Team::create($team);
        }

        // Create tickets (example)
        $tickets = [
            [
                'ticket_number' => 'TKT-001',
                'subject' => 'Vấn đề thanh toán',
                'description' => 'Không thể hoàn tất thanh toán',
                'status' => 'open',
                'priority' => 'high',
                'user_id' => 1
            ],
            [
                'ticket_number' => 'TKT-002',
                'subject' => 'Hỏi về sản phẩm',
                'description' => 'Câu hỏi về thông số sản phẩm',
                'status' => 'in_progress',
                'priority' => 'medium',
                'user_id' => 1
            ]
        ];
        foreach ($tickets as $ticket) {
            Ticket::create($ticket);
        }
    }
}
