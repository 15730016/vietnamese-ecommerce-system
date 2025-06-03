import React from 'react';
import { Helmet } from 'react-helmet-async';

const HomePage: React.FC = () => {
  return (
    <>
      <Helmet>
        <title>Trang chủ | Vietnamese E-commerce</title>
        <meta name="description" content="Khám phá các sản phẩm chất lượng cao với giá cả hợp lý tại Vietnamese E-commerce" />
      </Helmet>

      <div className="space-y-8">
        {/* Hero Section */}
        <section className="relative">
          <div className="bg-gray-900 rounded-2xl overflow-hidden">
            <div className="max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
              <div className="text-center">
                <h1 className="text-4xl font-extrabold text-white sm:text-5xl sm:tracking-tight lg:text-6xl">
                  Chào mừng đến với Vietnamese E-commerce
                </h1>
                <p className="mt-6 max-w-2xl mx-auto text-xl text-gray-300">
                  Khám phá hàng nghìn sản phẩm chất lượng với giá cả hợp lý
                </p>
                <div className="mt-10">
                  <a
                    href="/flash-sale"
                    className="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-red-600 hover:bg-red-700"
                  >
                    Xem Flash Sale
                  </a>
                </div>
              </div>
            </div>
          </div>
        </section>

        {/* Flash Sale Section */}
        <section>
          <div className="flex items-center justify-between mb-6">
            <h2 className="text-2xl font-bold text-gray-900">Flash Sale</h2>
            <a href="/flash-sale" className="text-red-600 hover:text-red-700 font-medium">
              Xem tất cả
            </a>
          </div>
          <div className="grid grid-cols-2 md:grid-cols-4 gap-4">
            {/* Placeholder for Flash Sale Products */}
            {[1, 2, 3, 4].map((item) => (
              <div key={item} className="bg-white rounded-lg shadow-sm p-4">
                <div className="aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-lg bg-gray-200">
                  <img
                    src="https://images.pexels.com/photos/4464821/pexels-photo-4464821.jpeg"
                    alt="Product"
                    className="object-cover"
                  />
                </div>
                <div className="mt-4">
                  <h3 className="text-sm font-medium text-gray-900">Sản phẩm {item}</h3>
                  <p className="mt-1 text-lg font-bold text-red-600">199.000₫</p>
                  <p className="mt-1 text-sm text-gray-500 line-through">299.000₫</p>
                </div>
              </div>
            ))}
          </div>
        </section>

        {/* Categories Section */}
        <section>
          <h2 className="text-2xl font-bold text-gray-900 mb-6">Danh mục sản phẩm</h2>
          <div className="grid grid-cols-2 md:grid-cols-4 gap-4">
            {/* Placeholder for Categories */}
            {[1, 2, 3, 4].map((item) => (
              <a
                key={item}
                href={`/category/${item}`}
                className="group relative overflow-hidden rounded-lg bg-white shadow-sm"
              >
                <div className="aspect-w-3 aspect-h-2">
                  <img
                    src="https://images.pexels.com/photos/264636/pexels-photo-264636.jpeg"
                    alt="Category"
                    className="object-cover group-hover:scale-105 transition-transform duration-300"
                  />
                </div>
                <div className="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent" />
                <div className="absolute bottom-0 left-0 right-0 p-4">
                  <h3 className="text-lg font-medium text-white">Danh mục {item}</h3>
                </div>
              </a>
            ))}
          </div>
        </section>

        {/* Featured Products Section */}
        <section>
          <h2 className="text-2xl font-bold text-gray-900 mb-6">Sản phẩm nổi bật</h2>
          <div className="grid grid-cols-2 md:grid-cols-4 gap-4">
            {/* Placeholder for Featured Products */}
            {[1, 2, 3, 4, 5, 6, 7, 8].map((item) => (
              <div key={item} className="bg-white rounded-lg shadow-sm p-4">
                <div className="aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-lg bg-gray-200">
                  <img
                    src="https://images.pexels.com/photos/4464821/pexels-photo-4464821.jpeg"
                    alt="Product"
                    className="object-cover"
                  />
                </div>
                <div className="mt-4">
                  <h3 className="text-sm font-medium text-gray-900">Sản phẩm nổi bật {item}</h3>
                  <p className="mt-1 text-lg font-medium text-gray-900">299.000₫</p>
                </div>
              </div>
            ))}
          </div>
        </section>

        {/* Latest Blog Posts Section */}
        <section>
          <div className="flex items-center justify-between mb-6">
            <h2 className="text-2xl font-bold text-gray-900">Tin tức mới nhất</h2>
            <a href="/blog" className="text-blue-600 hover:text-blue-700 font-medium">
              Xem tất cả
            </a>
          </div>
          <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
            {/* Placeholder for Blog Posts */}
            {[1, 2, 3].map((item) => (
              <article key={item} className="bg-white rounded-lg shadow-sm overflow-hidden">
                <div className="aspect-w-16 aspect-h-9">
                  <img
                    src="https://images.pexels.com/photos/1884581/pexels-photo-1884581.jpeg"
                    alt="Blog post"
                    className="object-cover"
                  />
                </div>
                <div className="p-4">
                  <h3 className="text-lg font-medium text-gray-900">Bài viết {item}</h3>
                  <p className="mt-2 text-sm text-gray-600 line-clamp-2">
                    Mô tả ngắn về bài viết sẽ xuất hiện ở đây. Đây là một đoạn văn bản mẫu để hiển thị giao diện.
                  </p>
                  <div className="mt-4">
                    <a href={`/blog/${item}`} className="text-blue-600 hover:text-blue-700 font-medium">
                      Đọc thêm
                    </a>
                  </div>
                </div>
              </article>
            ))}
          </div>
        </section>
      </div>
    </>
  );
};

export default HomePage;
