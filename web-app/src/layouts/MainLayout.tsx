import React from 'react';
import { Outlet } from 'react-router-dom';
import { Helmet } from 'react-helmet-async';

const MainLayout: React.FC = () => {
  return (
    <>
      <Helmet>
        <title>Vietnamese E-commerce</title>
        <meta name="description" content="Hệ thống thương mại điện tử Việt Nam" />
      </Helmet>

      <div className="min-h-screen bg-gray-50">
        {/* Header will go here */}
        <header className="bg-white shadow-sm">
          <nav className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div className="flex items-center">
              <a href="/" className="text-2xl font-bold text-gray-900">
                Logo
              </a>
            </div>
            
            <div className="flex items-center space-x-4">
              <a href="/flash-sale" className="text-red-600 font-medium">
                Flash Sale
              </a>
              <a href="/cart" className="text-gray-600">
                Giỏ hàng
              </a>
            </div>
          </nav>
        </header>

        {/* Main content */}
        <main className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
          <Outlet />
        </main>

        {/* Footer */}
        <footer className="bg-white border-t">
          <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div className="grid grid-cols-1 md:grid-cols-4 gap-8">
              <div>
                <h3 className="text-lg font-semibold mb-4">Về chúng tôi</h3>
                <ul className="space-y-2">
                  <li><a href="#" className="text-gray-600 hover:text-gray-900">Giới thiệu</a></li>
                  <li><a href="#" className="text-gray-600 hover:text-gray-900">Liên hệ</a></li>
                  <li><a href="#" className="text-gray-600 hover:text-gray-900">Tuyển dụng</a></li>
                </ul>
              </div>
              
              <div>
                <h3 className="text-lg font-semibold mb-4">Hỗ trợ khách hàng</h3>
                <ul className="space-y-2">
                  <li><a href="#" className="text-gray-600 hover:text-gray-900">Trung tâm trợ giúp</a></li>
                  <li><a href="#" className="text-gray-600 hover:text-gray-900">Hướng dẫn mua hàng</a></li>
                  <li><a href="#" className="text-gray-600 hover:text-gray-900">Chính sách đổi trả</a></li>
                </ul>
              </div>

              <div>
                <h3 className="text-lg font-semibold mb-4">Phương thức thanh toán</h3>
                <ul className="space-y-2">
                  <li><a href="#" className="text-gray-600 hover:text-gray-900">VNPay</a></li>
                  <li><a href="#" className="text-gray-600 hover:text-gray-900">COD</a></li>
                  <li><a href="#" className="text-gray-600 hover:text-gray-900">Chuyển khoản</a></li>
                </ul>
              </div>

              <div>
                <h3 className="text-lg font-semibold mb-4">Kết nối với chúng tôi</h3>
                <ul className="space-y-2">
                  <li><a href="#" className="text-gray-600 hover:text-gray-900">Facebook</a></li>
                  <li><a href="#" className="text-gray-600 hover:text-gray-900">Instagram</a></li>
                  <li><a href="#" className="text-gray-600 hover:text-gray-900">YouTube</a></li>
                </ul>
              </div>
            </div>

            <div className="mt-8 pt-8 border-t text-center text-gray-600">
              <p>&copy; 2023 Vietnamese E-commerce. All rights reserved.</p>
            </div>
          </div>
        </footer>
      </div>
    </>
  );
};

export default MainLayout;
