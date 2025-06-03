# Mobile App - React Native

Ứng dụng di động cho hệ thống thương mại điện tử, được xây dựng bằng React Native.

## Tính Năng

- Bottom tab navigation
- Yêu cầu đăng nhập để thanh toán
- Giỏ hàng lưu cục bộ với AsyncStorage
- Tích hợp thanh toán VNPay
- Flash sale với đếm ngược thời gian
- Theo dõi đơn hàng
- Giao diện tiếng Việt

## Cài Đặt

1. Clone repository:
```bash
git clone <repository-url>
cd mobile-app
```

2. Cài đặt dependencies:
```bash
npm install
# hoặc
yarn
```

3. Cấu hình môi trường:
```bash
cp .env.example .env
```

4. Cài đặt pods (iOS):
```bash
cd ios && pod install && cd ..
```

5. Chạy ứng dụng:

iOS:
```bash
npm run ios
# hoặc
yarn ios
```

Android:
```bash
npm run android
# hoặc
yarn android
```

## Cấu Trúc Thư Mục

```
src/
├── screens/        # Màn hình ứng dụng
├── components/     # React Native components
├── navigation/     # Navigation configuration
├── services/      # API services
├── hooks/         # Custom hooks
├── context/       # React context providers
├── utils/         # Utility functions
└── assets/        # Static assets
```

## Screens

### Main Screens
- Home
- Categories
- Product Detail
- Cart
- Flash Sale
- Order History
- Profile

### Authentication Screens
- Login
- Register
- Forgot Password

## Navigation

Sử dụng React Navigation với bottom tabs:

```javascript
import { createBottomTabNavigator } from '@react-navigation/bottom-tabs';

const Tab = createBottomTabNavigator();

function AppNavigator() {
  return (
    <Tab.Navigator>
      <Tab.Screen name="Home" component={HomeScreen} />
      <Tab.Screen name="Categories" component={CategoriesScreen} />
      <Tab.Screen name="Cart" component={CartScreen} />
      <Tab.Screen name="Profile" component={ProfileScreen} />
    </Tab.Navigator>
  );
}
```

## Local Storage

Sử dụng AsyncStorage để lưu giỏ hàng và thông tin người dùng:

```javascript
import AsyncStorage from '@react-native-async-storage/async-storage';

// Lưu giỏ hàng
const saveCart = async (cartItems) => {
  try {
    await AsyncStorage.setItem('cart', JSON.stringify(cartItems));
  } catch (error) {
    console.error('Lỗi khi lưu giỏ hàng:', error);
  }
};

// Đọc giỏ hàng
const loadCart = async () => {
  try {
    const cart = await AsyncStorage.getItem('cart');
    return cart ? JSON.parse(cart) : [];
  } catch (error) {
    console.error('Lỗi khi đọc giỏ hàng:', error);
    return [];
  }
};
```

## API Integration

Sử dụng Axios để gọi API:

```javascript
import axios from 'axios';

const api = axios.create({
  baseURL: process.env.API_URL,
  headers: {
    'Content-Type': 'application/json',
  },
});

// Thêm interceptor cho authentication
api.interceptors.request.use((config) => {
  const token = await AsyncStorage.getItem('token');
  if (token) {
    config.headers.Authorization = `Bearer ${token}`;
  }
  return config;
});
```

## Error Handling

Xử lý lỗi với try-catch và hiển thị thông báo bằng tiếng Việt:

```javascript
try {
  await api.post('/orders', orderData);
} catch (error) {
  if (error.response) {
    Alert.alert('Lỗi', error.response.data.message);
  } else {
    Alert.alert('Lỗi', 'Không thể kết nối đến server');
  }
}
```

## State Management

Sử dụng React Context cho state management:

```javascript
// Cart Context
export const CartContext = createContext();

export const CartProvider = ({ children }) => {
  const [cart, setCart] = useState([]);
  
  const addToCart = async (product) => {
    const newCart = [...cart, product];
    setCart(newCart);
    await saveCart(newCart);
  };
  
  return (
    <CartContext.Provider value={{ cart, addToCart }}>
      {children}
    </CartContext.Provider>
  );
};
```

## Building for Production

### Android

1. Tạo keystore:
```bash
keytool -genkey -v -keystore android/app/release.keystore -alias my-key-alias -keyalg RSA -keysize 2048 -validity 10000
```

2. Cấu hình trong `android/gradle.properties`:
```
MYAPP_RELEASE_STORE_FILE=release.keystore
MYAPP_RELEASE_KEY_ALIAS=my-key-alias
MYAPP_RELEASE_STORE_PASSWORD=*****
MYAPP_RELEASE_KEY_PASSWORD=*****
```

3. Build APK:
```bash
cd android
./gradlew assembleRelease
```

### iOS

1. Cấu hình trong Xcode:
   - Signing & Capabilities
   - Provisioning Profile
   - App Icon

2. Archive và upload lên App Store Connect

## Testing

```bash
npm test
# hoặc
yarn test
```

## Best Practices

- Sử dụng TypeScript
- Tối ưu performance với React Native
- Xử lý offline mode
- Deep linking
- Push notifications
- Error boundaries
- Code splitting

## Troubleshooting

### Android

1. Gradle build fails:
```bash
cd android
./gradlew clean
```

2. Metro bundler issues:
```bash
npm start -- --reset-cache
```

### iOS

1. Pod issues:
```bash
cd ios
pod deintegrate
pod install
```

## License

MIT License
