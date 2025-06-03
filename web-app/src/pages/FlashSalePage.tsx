import React from 'react';
import { Helmet } from 'react-helmet-async';
import { Link } from 'react-router-dom';

interface FlashSaleProduct {
  id: number;
  name: string;
  price: number;
  originalPrice: number;
  image: string;
  stock: number;
  soldCount: number;
  endTime: string;
}

const FlashSalePage: React.FC = () => {
  // Placeholder flash sale data
  const flashSaleProducts: FlashSaleProduct[] = [
    {
      id: 1,
      name: 'Sản phẩm flash sale 1',
      price: 199000,
      originalPrice: 399000,
      image: 'https://images.pexels.com/photos/4464821/pexels-photo-4464821.jpeg',
      stock: 100,
      soldCount: 75,
      endTime: '2023-12-31T23:59:59',
    },
    {
      id: 2,
      name: 'Sản phẩm flash sale 2',
      price: 299000,
      originalPrice: 599000,
      image: 'https://images.pexels.com/photos/4464821/pexels-photo-4464821.jpeg',
      stock: 50,
      soldCount: 30,
      endTime: '2023-12-31T23:59:59',
    },
    // Add more products as needed
  ];

  const calculateTimeLeft = (endTime: string) => {
    const difference = +new Date(endTime) - +new Date();
    let timeLeft = {
      hours: '00',
      minutes: '00',
      seconds: '00',
    };

    if (difference > 0) {
      timeLeft = {
        hours: Math.floor((difference / (1000 * 60 * 60)) % 24).toString().padStart(2, '0'),
        minutes: Math.floor((difference / 1000 / 60) % 60).toString().padStart(2, '0'),
        seconds: Math.floor((difference / 1000) % 60).toString().padStart(2, '0'),
      };
    }

    return timeLeft;
  };

  const calculateProgress = (soldCount: number, stock: number) => {
    const total = soldCount + stock;
    return (soldCount / total) * 100;
  };

  return (
    <>
      <Helmet>
        <title>Flash Sale | Vietnamese E-commerce</title>
        <meta name="description" content="Khuyến mãi giảm giá sốc - Số lượng có hạn" />
      </Helmet>

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {/* Flash Sale Header */}
        <div className="bg-red-600 rounded-lg p-6 mb-8">
          <div className="text-center">
            <h1 className="text-3xl font-bold text-white mb-4">
              ⚡ Flash Sale Đang Diễn Ra
            </h1>
            <div className="flex justify-center space-x-4">
              <div className="bg-white rounded-lg px-4 py-2">
                <span className="text-2xl font-bold text-red-600">12</span>
                <span className="text-sm text-gray-600 ml-1">Giờ</span>
              </div>
              <div className="bg-white rounded-lg px-4 py-2">
                <span className="text-2xl font-bold text-red-600">30</span>
                <span className="text-sm text-gray-600 ml-1">Phút</span>
              </div>
              <div className="bg-white rounded-lg px-4 py-2">
                <span className="text-2xl font-bold text-red-600">00</span>
                <span className="text-sm text-gray-600 ml-1">Giây</span>
              </div>
            </div>
          </div>
        </div>

        {/* Products Grid */}
        <div className="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
          {flashSaleProducts.map((product) => {
            const timeLeft = calculateTimeLeft(product.endTime);
            const progress = calculateProgress(product.soldCount, product.stock);

            return (
              <div key={product.id} className="bg-white rounded-lg shadow-sm overflow-hidden">
                <Link to={`/product/${product.id}`}>
                  <div className="relative">
                    <img
                      src={product.image}
                      alt={product.name}
                      className="w-full h-48 object-cover"
                    />
                    <div className="absolute top-2 right-2 bg-red-600 text-white px-2 py-1 rounded-md text-sm font-medium">
                      -{Math.round(((product.originalPrice - product.price) / product.originalPrice) * 100)}%
                    </div>
                  </div>

                  <div className="p-4">
                    <h3 className="text-sm font-medium text-gray-900 truncate">
                      {product.name}
                    </h3>
                    
                    <div className="mt-2 flex items-center justify-between">
                      <div>
                        <p className="text-lg font-bold text-red-600">
                          {product.price.toLocaleString('vi-VN')}₫
                        </p>
                        <p className="text-sm text-gray-500 line-through">
                          {product.originalPrice.toLocaleString('vi-VN')}₫
                        </p>
                      </div>
                    </div>

                    {/* Progress bar */}
                    <div className="mt-3">
                      <div className="relative pt-1">
                        <div className="overflow-hidden h-2 text-xs flex rounded bg-red-200">
                          <div
                            style={{ width: `${progress}%` }}
                            className="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-red-600"
                          />
                        </div>
                        <div className="text-xs text-red-600 mt-1">
                          Đã bán {product.soldCount}
                        </div>
                      </div>
                    </div>

                    <button
                      className="mt-4 w-full bg-red-600 text-white py-2 px-4 rounded-md hover:bg-red-700 transition-colors"
                    >
                      Mua ngay
                    </button>
                  </div>
                </Link>
              </div>
            );
          })}
        </div>

        {/* Empty state */}
        {flashSaleProducts.length === 0 && (
          <div className="text-center py-12">
            <h2 className="text-xl text-gray-600 mb-4">
              Hiện không có sản phẩm Flash Sale nào
            </h2>
            <Link
              to="/"
              className="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700"
            >
              Quay lại trang chủ
            </Link>
          </div>
        )}
      </div>
    </>
  );
};

export default FlashSalePage;
