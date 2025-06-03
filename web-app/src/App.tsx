import React from 'react';
import { Routes, Route } from 'react-router-dom';
import { Toaster } from 'react-hot-toast';

// Layouts
const MainLayout = React.lazy(() => import('./layouts/MainLayout'));
const AdminLayout = React.lazy(() => import('./layouts/AdminLayout'));

// Public Pages
const HomePage = React.lazy(() => import('./pages/HomePage'));
const ProductDetailPage = React.lazy(() => import('./pages/ProductDetailPage'));
const CategoryPage = React.lazy(() => import('./pages/CategoryPage'));
const BrandPage = React.lazy(() => import('./pages/BrandPage'));
const BlogPage = React.lazy(() => import('./pages/BlogPage'));
const CartPage = React.lazy(() => import('./pages/CartPage'));
const CheckoutPage = React.lazy(() => import('./pages/CheckoutPage'));
const OrderSuccessPage = React.lazy(() => import('./pages/OrderSuccessPage'));
const FlashSalePage = React.lazy(() => import('./pages/FlashSalePage'));

// Admin Pages
const AdminDashboard = React.lazy(() => import('./admin/pages/Dashboard'));
const AdminProducts = React.lazy(() => import('./admin/pages/Products'));
const AdminCategories = React.lazy(() => import('./admin/pages/Categories'));
const AdminOrders = React.lazy(() => import('./admin/pages/Orders'));
const AdminBlog = React.lazy(() => import('./admin/pages/Blog'));
const AdminFlashSale = React.lazy(() => import('./admin/pages/FlashSale'));
const AdminVouchers = React.lazy(() => import('./admin/pages/Vouchers'));

function App() {
  return (
    <React.Suspense fallback={<div>Loading...</div>}>
      <Routes>
        {/* Public Routes */}
        <Route path="/" element={<MainLayout />}>
          <Route index element={<HomePage />} />
          <Route path="product/:id" element={<ProductDetailPage />} />
          <Route path="category/:id" element={<CategoryPage />} />
          <Route path="brand/:id" element={<BrandPage />} />
          <Route path="blog" element={<BlogPage />} />
          <Route path="cart" element={<CartPage />} />
          <Route path="checkout" element={<CheckoutPage />} />
          <Route path="order-success" element={<OrderSuccessPage />} />
          <Route path="flash-sale" element={<FlashSalePage />} />
        </Route>

        {/* Admin Routes */}
        <Route path="/admin" element={<AdminLayout />}>
          <Route index element={<AdminDashboard />} />
          <Route path="products" element={<AdminProducts />} />
          <Route path="categories" element={<AdminCategories />} />
          <Route path="orders" element={<AdminOrders />} />
          <Route path="blog" element={<AdminBlog />} />
          <Route path="flash-sale" element={<AdminFlashSale />} />
          <Route path="vouchers" element={<AdminVouchers />} />
        </Route>
      </Routes>
      
      <Toaster 
        position="top-right"
        toastOptions={{
          duration: 3000,
          style: {
            background: '#333',
            color: '#fff',
          },
        }}
      />
    </React.Suspense>
  );
}

export default App;
