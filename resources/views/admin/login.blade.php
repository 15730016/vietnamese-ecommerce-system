<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập Quản Trị - HaXuVina</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Be Vietnam Pro Font -->
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        body {
            font-family: 'Be Vietnam Pro', sans-serif;
            background: linear-gradient(rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.3)), url('{{ asset("images/background_login_desktop.svg") }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            min-height: 100vh;
            position: relative;
            overflow: hidden;
        }
        
        /* Decorative circles */
        body::before,
        body::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            background: #FF6B4A08;
            z-index: -1;
        }
        
        body::before {
            width: 300px;
            height: 300px;
            top: -100px;
            right: -100px;
        }
        
        body::after {
            width: 400px;
            height: 400px;
            bottom: -150px;
            left: -150px;
        }

        .login-animation {
            animation: fadeIn 0.5s ease-in-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
        }

        /* Custom focus styles */
        .focus-custom:focus {
            box-shadow: 0 0 0 2px rgba(255, 107, 74, 0.2);
            border-color: #FF6B4A;
            transform: translateY(-1px);
            background-color: white;
            color: #FF6B4A;
        }

        .focus-custom:focus::placeholder {
            color: rgba(255, 107, 74, 0.5);
        }

        /* Custom checkbox */
        .custom-checkbox:checked {
            background-color: #FF6B4A;
            border-color: #FF6B4A;
        }
    </style>
</head>
<body class="flex items-center justify-center p-4">
    <div class="login-animation w-full max-w-[420px]">
        <div class="glass-effect rounded-2xl shadow-xl p-8 space-y-6">
            <!-- Logo -->
            <div class="text-center mb-8">
                <img src="{{ asset('images/logo-haxu-all-12.png') }}" alt="HaXuVina Logo" class="h-16 mx-auto mb-6 transform hover:scale-105 transition-all duration-300 drop-shadow-lg">
                <h2 class="text-2xl font-bold text-gray-900">Đăng Nhập Quản Trị</h2>
                <p class="text-gray-600 mt-2">Vui lòng đăng nhập để tiếp tục</p>
            </div>

            <!-- Login Form -->
            <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-5">
                @csrf
                
                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <div class="relative">
                        <input type="email" name="email" id="email" required 
                               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus-custom transition-all pl-11 bg-white/50 hover:bg-white focus:bg-white"
                               placeholder="Nhập email của bạn"
                               autocomplete="email">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </div>
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Mật khẩu</label>
                    <div class="relative">
                        <input type="password" name="password" id="password" required 
                               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus-custom transition-all pl-11 bg-white/50 hover:bg-white focus:bg-white"
                               placeholder="Nhập mật khẩu của bạn"
                               autocomplete="current-password">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input type="checkbox" name="remember" id="remember" 
                               class="h-4 w-4 custom-checkbox focus:ring-[#FF6B4A] border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-700">Ghi nhớ đăng nhập</label>
                    </div>
                    <a href="{{ route('admin.password.reset') }}" class="text-sm text-[#FF6B4A] hover:text-[#FF8F6B] transition-colors">
                        Quên mật khẩu?
                    </a>
                </div>

                <!-- Error Message -->
                @if ($errors->any())
                <div class="bg-red-50 text-red-500 p-3 rounded-lg text-sm">
                    {{ $errors->first() }}
                </div>
                @endif

                <!-- Submit Button -->
                <button type="submit" 
                        class="w-full bg-[#FF6B4A] text-white py-2.5 px-4 rounded-lg hover:bg-[#FF8F6B] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF6B4A] transition-all font-medium shadow-md hover:shadow-lg hover:-translate-y-0.5">
                    Đăng Nhập
                </button>
            </form>

            <!-- Footer -->
            <div class="text-center text-sm text-gray-600 mt-6">
                <div class="flex items-center justify-center gap-2">
                    <img src="{{ asset('images/logo-haxu-icon.png') }}" alt="Icon" class="w-6 h-6">
                    <span>&copy; {{ date('Y') }} HaXuVina. Đã đăng ký bản quyền.</span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
