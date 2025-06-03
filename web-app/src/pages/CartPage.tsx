import React, { useState } from 'react';
import { Link } from 'react-router-dom';
import { Helmet } from 'react-helmet-async';

interface CartItem {
  id: number;
  name: string;
  price: number;
  quantity: number;
  image: string;
}

const CartPage: React.FC = () => {
  // Placeholder cart data
  const [cartItems, setCartItems] = useState<CartItem[]>([
    {
      id: 1,
      name: 'Sản phẩm mẫu 1',
      price: 299000,
      quantity: 2,
      image: 'https://images.pexels.com/photos/4464821/pexels-photo-4464821.jpeg',
    },
    {
      id: 2,
      name: 'Sản phẩm mẫu 2',
      price: 199000,
      quantity: 1,
      image: 'https://images.pexels.com/photos/4464821/pexels-photo-4464821.jpeg',
    },
  ]);

  const updateQuantity = (id: number, newQuantity: number) => {
    if (newQuantity < 1) return;
    setCartItems(
      cartItems.map((item) =>
        item.id === id ? { ...item, quantity: newQuantity } : item
      )
    );
  };

  const removeItem = (id: number) => {
    setCartItems(cartItems.filter((item) => item.id !== id));
  };

  const subtotal = cartItems.reduce(
    (sum, item) => sum + item.price * item.quantity,
    0
  );
  const shippingFee = 30000; // Phí vận chuyển cố định
  const total = subtotal + shippingFee;

  return (
    <>
      <Helmet>
        <title>Giỏ hàng | Vietnamese E-commerce</title>
      </Helmet>

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 className="text-3xl font-bold text-gray-900 mb-8">Giỏ hàng</h1>

        {cartItems.length === 0 ? (
          <div className="text-center py-12">
            <h2 className="text-xl text-gray-600 mb-4">
              Giỏ hàng của bạn đang trống
            </h2>
            <Link
              to="/"
              className="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700"
            >
              Tiếp tục mua sắm
            </Link>
          </div>
        ) : (
          <div className="lg:grid lg:grid-cols-12 lg:gap-x-12 lg:items-start">
            <div className="lg:col-span-7">
              {/* Cart items */}
              <div className="border-t border-gray-200 divide-y divide-gray-200">
                {cartItems.map((item) => (
                  <div key={item.id} className="py-6 flex">
                    <div className="flex-shrink-0 w-24 h-24 border border-gray-200 rounded-md overflow-hidden">
                      <img
                        src={item.image}
                        alt={item.name}
                        className="w-full h-full object-cover"
                      />
                    </div>

                    <div className="ml-4 flex-1 flex flex-col">
                      <div>
                        <div className="flex justify-between text-base font-medium text-gray-900">
                          <h3>
                            <Link to={`/product/${item.id}`}>{item.name}</Link>
                          </h3>
                          <p className="ml-4">
                            {item.price.toLocaleString('vi-VN')}₫
                          </p>
                        </div>
                      </div>
                      <div className="flex-1 flex items-end justify-between text-sm">
                        <div className="flex items-center">
                          <button
                            type="button"
                            className="rounded-l border border-gray-300 px-3 py-1"
                            onClick={() =>
                              updateQuantity(item.id, item.quantity - 1)
                            }
                          >
                            -
                          </button>
                          <input
                            type="number"
                            className="w-16 border-t border-b border-gray-300 px-3 py-1 text-center"
                            value={item.quantity}
                            onChange={(e) =>
                              updateQuantity(item.id, parseInt(e.target.value) || 1)
                            }
                            min="1"
                          />
                          <button
                            type="button"
                            className="rounded-r border border-gray-300 px-3 py-1"
                            onClick={() =>
                              updateQuantity(item.id, item.quantity + 1)
                            }
                          >
                            +
                          </button>
                        </div>

                        <div className="flex">
                          <button
                            type="button"
                            onClick={() => removeItem(item.id)}
                            className="font-medium text-red-600 hover:text-red-500"
                          >
                            Xóa
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                ))}
              </div>
            </div>

            {/* Order summary */}
            <div className="mt-16 lg:mt-0 lg:col-span-5">
              <div className="bg-gray-50 rounded-lg px-4 py-6 sm:p-6 lg:p-8">
                <h2 className="text-lg font-medium text-gray-900">
                  Tổng giỏ hàng
                </h2>
                <div className="mt-6 space-y-4">
                  <div className="flex items-center justify-between">
                    <p className="text-sm text-gray-600">Tạm tính</p>
                    <p className="text-sm font-medium text-gray-900">
                      {subtotal.toLocaleString('vi-VN')}₫
                    </p>
                  </div>
                  <div className="flex items-center justify-between">
                    <p className="text-sm text-gray-600">Phí vận chuyển</p>
                    <p className="text-sm font-medium text-gray-900">
                      {shippingFee.toLocaleString('vi-VN')}₫
                    </p>
                  </div>
                  <div className="border-t border-gray-200 pt-4 flex items-center justify-between">
                    <p className="text-base font-medium text-gray-900">
                      Tổng cộng
                    </p>
                    <p className="text-base font-medium text-gray-900">
                      {total.toLocaleString('vi-VN')}₫
                    </p>
                  </div>
                </div>

                <div className="mt-6">
                  <Link
                    to="/checkout"
                    className="w-full bg-indigo-600 border border-transparent rounded-md shadow-sm py-3 px-4 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                  >
                    Tiến hành thanh toán
                  </Link>
                </div>

                <div className="mt-6 text-center">
                  <Link
                    to="/"
                    className="text-sm font-medium text-indigo-600 hover:text-indigo-500"
                  >
                    Tiếp tục mua sắm
                  </Link>
                </div>
              </div>
            </div>
          </div>
        )}
      </div>
    </>
  );
};

export default CartPage;
