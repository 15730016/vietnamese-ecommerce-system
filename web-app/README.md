# Web Frontend - React + TailwindCSS

Frontend web application cho hệ thống thương mại điện tử, được xây dựng bằng React và TailwindCSS.

## Tính Năng

- Giao diện người dùng hiện đại với TailwindCSS
- SEO động với react-helmet
- Thanh toán không cần đăng nhập
- Tích hợp VNPay
- Flash sale với đếm ngược thời gian
- Quản lý giỏ hàng
- Giao diện quản trị (CMS)
- Blog với WYSIWYG editor

## Cài Đặt

1. Clone repository:
```bash
git clone <repository-url>
cd web-app
```

2. Cài đặt dependencies:
```bash
npm install
# hoặc
yarn
```

3. Tạo file môi trường:
```bash
cp .env.example .env
```

4. Cấu hình API endpoint trong .env:
```
REACT_APP_API_URL=http://localhost:8000/api
```

5. Chạy ứng dụng ở môi trường development:
```bash
npm start
# hoặc
yarn start
```

## Cấu Trúc Thư Mục

```
src/
├── components/     # React components
├── pages/         # Page components
├── admin/         # Admin CMS components
├── hooks/         # Custom React hooks
├── context/       # React context providers
├── services/      # API services
├── utils/         # Utility functions
└── assets/        # Static assets
```

## Pages

### Public Pages
- Trang chủ (/)
- Chi tiết sản phẩm (/product/:id)
- Danh mục (/category/:id)
- Thương hiệu (/brand/:id)
- Blog (/blog)
- Giỏ hàng (/cart)
- Thanh toán (/checkout)
- Flash Sale (/flash-sale)

### Admin Pages
- Dashboard (/admin)
- Quản lý sản phẩm (/admin/products)
- Quản lý danh mục (/admin/categories)
- Quản lý đơn hàng (/admin/orders)
- Quản lý blog (/admin/posts)
- Quản lý flash sale (/admin/flash-sales)
- Quản lý voucher (/admin/vouchers)

## Components

### Common Components
- Header
- Footer
- ProductCard
- CategoryCard
- CartItem
- Alert
- Modal
- Button
- Input
- Select

### Admin Components
- AdminLayout
- Sidebar
- DataTable
- Editor (WYSIWYG)
- FileUpload
- Stats

## API Integration

Sử dụng Axios để gọi API:

```javascript
import axios from 'axios';

const api = axios.create({
  baseURL: process.env.REACT_APP_API_URL,
  headers: {
    'Content-Type': 'application/json',
  },
});

// Thêm interceptor cho authentication
api.interceptors.request.use((config) => {
  const token = localStorage.getItem('token');
  if (token) {
    config.headers.Authorization = `Bearer ${token}`;
  }
  return config;
});
```

## State Management

Sử dụng React Context và hooks cho state management:

```javascript
// Cart Context
export const CartContext = createContext();

export const CartProvider = ({ children }) => {
  const [cart, setCart] = useState([]);
  
  const addToCart = (product) => {
    // Logic thêm vào giỏ hàng
  };
  
  return (
    <CartContext.Provider value={{ cart, addToCart }}>
      {children}
    </CartContext.Provider>
  );
};
```

## Error Handling

Xử lý lỗi với try-catch và hiển thị thông báo bằng tiếng Việt:

```javascript
try {
  await api.post('/orders', orderData);
} catch (error) {
  if (error.response) {
    showError('Đã có lỗi xảy ra: ' + error.response.data.message);
  } else {
    showError('Không thể kết nối đến server');
  }
}
```

## Build

Để build ứng dụng cho production:

```bash
npm run build
# hoặc
yarn build
```

## Testing

Chạy unit tests:

```bash
npm test
# hoặc
yarn test
```

## Best Practices

- Sử dụng TypeScript cho type safety
- Tối ưu SEO với react-helmet
- Lazy loading cho các components lớn
- Responsive design với TailwindCSS
- Error boundaries để xử lý lỗi React
- Progressive image loading
- Code splitting

## License

MIT License
