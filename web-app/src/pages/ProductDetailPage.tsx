import React, { useState } from 'react';
import { useParams } from 'react-router-dom';
import { Helmet } from 'react-helmet-async';

const ProductDetailPage: React.FC = () => {
  const { id } = useParams<{ id: string }>();
  const [quantity, setQuantity] = useState(1);

  // Placeholder product data
  const product = {
    name: 'Sản phẩm mẫu',
    price: 299000,
    originalPrice: 399000,
    description: 'Mô tả chi tiết về sản phẩm sẽ được hiển thị ở đây.',
    images: [
      'https://images.pexels.com/photos/4464821/pexels-photo-4464821.jpeg',
      'https://images.pexels.com/photos/4464821/pexels-photo-4464821.jpeg',
    ],
    category: 'Danh mục mẫu',
    brand: 'Thương hiệu mẫu',
    stock: 10,
    rating: 4.5,
    reviews: [
      {
        id: 1,
        user: 'Người dùng 1',
        rating: 5,
        comment: 'Sản phẩm rất tốt, đóng gói cẩn thận.',
        date: '2023-10-01',
      },
      {
        id: 2,
        user: 'Người dùng 2',
        rating: 4,
        comment: 'Chất lượng tốt, giao hàng nhanh.',
        date: '2023-09-30',
      },
    ],
  };

  const handleAddToCart = () => {
    // TODO: Implement add to cart functionality
    console.log('Adding to cart:', { productId: id, quantity });
  };

  return (
    <>
      <Helmet>
        <title>{product.name} | Vietnamese E-commerce</title>
        <meta name="description" content={product.description} />
      </Helmet>

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="lg:grid lg:grid-cols-2 lg:gap-x-8 lg:items-start">
          {/* Image gallery */}
          <div className="flex flex-col">
            <div className="aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-lg">
              <img
                src={product.images[0]}
                alt={product.name}
                className="w-full h-full object-cover"
              />
            </div>
            <div className="mt-4 grid grid-cols-4 gap-2">
              {product.images.map((image, index) => (
                <div
                  key={index}
                  className="aspect-w-1 aspect-h-1 rounded-lg overflow-hidden"
                >
                  <img
                    src={image}
                    alt={`${product.name} ${index + 1}`}
                    className="w-full h-full object-cover cursor-pointer"
                  />
                </div>
              ))}
            </div>
          </div>

          {/* Product info */}
          <div className="mt-10 px-4 sm:px-0 sm:mt-16 lg:mt-0">
            <h1 className="text-3xl font-bold tracking-tight text-gray-900">
              {product.name}
            </h1>

            <div className="mt-3">
              <h2 className="sr-only">Thông tin sản phẩm</h2>
              <p className="text-3xl tracking-tight text-gray-900">
                {product.price.toLocaleString('vi-VN')}₫
              </p>
              {product.originalPrice > product.price && (
                <p className="text-lg text-gray-500 line-through">
                  {product.originalPrice.toLocaleString('vi-VN')}₫
                </p>
              )}
            </div>

            {/* Rating */}
            <div className="mt-3">
              <div className="flex items-center">
                <div className="flex items-center">
                  {[0, 1, 2, 3, 4].map((rating) => (
                    <svg
                      key={rating}
                      className={`h-5 w-5 ${
                        rating < product.rating
                          ? 'text-yellow-400'
                          : 'text-gray-300'
                      }`}
                      fill="currentColor"
                      viewBox="0 0 20 20"
                    >
                      <path
                        fillRule="evenodd"
                        d="M10 15.585l-7.07 3.714 1.35-7.858L.72 7.012l7.88-1.145L10 0l2.4 5.867 7.88 1.145-5.56 4.429 1.35 7.858z"
                      />
                    </svg>
                  ))}
                </div>
                <p className="ml-2 text-sm text-gray-500">
                  {product.reviews.length} đánh giá
                </p>
              </div>
            </div>

            <div className="mt-6">
              <h3 className="sr-only">Mô tả</h3>
              <div className="space-y-6 text-base text-gray-700">
                {product.description}
              </div>
            </div>

            <div className="mt-6">
              <div className="flex items-center">
                <h3 className="text-sm text-gray-600">Số lượng:</h3>
                <div className="ml-4 flex items-center">
                  <button
                    type="button"
                    className="rounded-l border border-gray-300 px-3 py-1"
                    onClick={() => setQuantity(Math.max(1, quantity - 1))}
                  >
                    -
                  </button>
                  <input
                    type="number"
                    className="w-16 border-t border-b border-gray-300 px-3 py-1 text-center"
                    value={quantity}
                    onChange={(e) => setQuantity(parseInt(e.target.value) || 1)}
                    min="1"
                    max={product.stock}
                  />
                  <button
                    type="button"
                    className="rounded-r border border-gray-300 px-3 py-1"
                    onClick={() =>
                      setQuantity(Math.min(product.stock, quantity + 1))
                    }
                  >
                    +
                  </button>
                </div>
              </div>
            </div>

            <div className="mt-6">
              <button
                type="button"
                onClick={handleAddToCart}
                className="w-full bg-indigo-600 py-3 px-8 rounded-md text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500"
              >
                Thêm vào giỏ hàng
              </button>
            </div>

            {/* Product metadata */}
            <div className="mt-6">
              <div className="border-t border-gray-200 pt-4">
                <h3 className="text-sm font-medium text-gray-900">
                  Thông tin chi tiết
                </h3>
                <div className="mt-4 space-y-3">
                  <p className="text-sm text-gray-600">
                    Danh mục: {product.category}
                  </p>
                  <p className="text-sm text-gray-600">
                    Thương hiệu: {product.brand}
                  </p>
                  <p className="text-sm text-gray-600">
                    Tình trạng: {product.stock > 0 ? 'Còn hàng' : 'Hết hàng'}
                  </p>
                </div>
              </div>
            </div>

            {/* Reviews */}
            <div className="mt-8 border-t border-gray-200 pt-8">
              <h2 className="text-lg font-medium text-gray-900">
                Đánh giá từ khách hàng
              </h2>
              <div className="mt-6 space-y-6">
                {product.reviews.map((review) => (
                  <div key={review.id} className="border-b border-gray-200 pb-6">
                    <div className="flex items-center">
                      <div className="flex items-center">
                        {[0, 1, 2, 3, 4].map((rating) => (
                          <svg
                            key={rating}
                            className={`h-4 w-4 ${
                              rating < review.rating
                                ? 'text-yellow-400'
                                : 'text-gray-300'
                            }`}
                            fill="currentColor"
                            viewBox="0 0 20 20"
                          >
                            <path
                              fillRule="evenodd"
                              d="M10 15.585l-7.07 3.714 1.35-7.858L.72 7.012l7.88-1.145L10 0l2.4 5.867 7.88 1.145-5.56 4.429 1.35 7.858z"
                            />
                          </svg>
                        ))}
                      </div>
                      <p className="ml-2 text-sm text-gray-500">{review.user}</p>
                      <p className="ml-4 text-sm text-gray-500">{review.date}</p>
                    </div>
                    <p className="mt-2 text-sm text-gray-600">{review.comment}</p>
                  </div>
                ))}
              </div>
            </div>
          </div>
        </div>
      </div>
    </>
  );
};

export default ProductDetailPage;
