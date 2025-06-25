<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>تسجيل الدخول</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Cairo', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .login-container {
            backdrop-filter: blur(20px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.1);
        }
        .input-group {
            position: relative;
        }
        .input-field {
            transition: all 0.3s ease;
        }
        .input-field:focus {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        .btn-login {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            transition: all 0.3s ease;
        }
        .btn-login:hover {
            background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(59, 130, 246, 0.3);
        }
        .floating-shapes {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1;
        }
        .shape {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }
        .shape:nth-child(1) {
            width: 60px;
            height: 60px;
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }
        .shape:nth-child(2) {
            width: 80px;
            height: 80px;
            top: 60%;
            left: 80%;
            animation-delay: 2s;
        }
        .shape:nth-child(3) {
            width: 40px;
            height: 40px;
            top: 80%;
            left: 20%;
            animation-delay: 4s;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        .error-message {
            animation: shake 0.5s ease-in-out;
        }
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    <!-- Floating Shapes Background -->
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <div class="login-container bg-white bg-opacity-95 p-8 rounded-3xl w-full max-w-md">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h2 class="text-3xl font-bold text-gray-800 mb-2">مرحباً بك</h2>
            <p class="text-gray-600">سجل دخولك لإدارة مهامك</p>
        </div>

        <!-- Login Form -->
        <form id="login-form" class="space-y-6">
            <!-- CSRF Token Hidden Field -->
            <input type="hidden" id="csrf-token" name="_token" value="">
            
            <div class="input-group">
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">البريد الإلكتروني</label>
                <div class="relative">
                    <input type="email" id="email" name="email" required
                        class="input-field w-full p-4 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:outline-none pr-12"
                        placeholder="أدخل بريدك الإلكتروني">
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="input-group">
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">كلمة المرور</label>
                <div class="relative">
                    <input type="password" id="password" name="password" required
                        class="input-field w-full p-4 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:outline-none pr-12"
                        placeholder="أدخل كلمة المرور">
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Error Message -->
            <div id="error-message" class="hidden error-message bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl text-sm"></div>

            <!-- Login Button -->
            <button type="submit" id="login-btn"
                class="btn-login w-full text-white p-4 rounded-xl font-semibold text-lg flex items-center justify-center space-x-2 space-x-reverse">
                <span id="login-text">تسجيل الدخول</span>
                <svg id="login-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                </svg>
                <!-- Loading Spinner -->
                <svg id="loading-spinner" class="hidden animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </button>
        </form>

        <!-- Footer -->
        <div class="text-center mt-8 text-sm text-gray-600">
            <p>لا تملك حساب؟ <a href="/register" class="text-blue-600 hover:text-blue-800 font-semibold">إنشاء حساب جديد</a></p>
        </div>
    </div>

    <script>
        const loginForm = document.getElementById('login-form');
        const loginBtn = document.getElementById('login-btn');
        const loginText = document.getElementById('login-text');
        const loginIcon = document.getElementById('login-icon');
        const loadingSpinner = document.getElementById('loading-spinner');
        const errorMessage = document.getElementById('error-message');

        // Get CSRF token from meta tag or fetch it
        function getCSRFToken() {
            // Method 1: From meta tag (Laravel style)
            const metaToken = document.querySelector('meta[name="csrf-token"]');
            if (metaToken) {
                return metaToken.getAttribute('content');
            }
            
            // Method 2: From cookie (if using cookie-based CSRF)
            const cookies = document.cookie.split(';');
            for (let cookie of cookies) {
                const [name, value] = cookie.trim().split('=');
                if (name === 'XSRF-TOKEN' || name === 'csrf_token') {
                    return decodeURIComponent(value);
                }
            }
            
            return null;
        }

        // Fetch CSRF token from server if not available
        async function fetchCSRFToken() {
            try {
                const response = await fetch('/sanctum/csrf-cookie', {
                    method: 'GET',
                    credentials: 'same-origin'
                });
                
                if (response.ok) {
                    return getCSRFToken();
                }
            } catch (error) {
                console.log('Failed to fetch CSRF token:', error);
            }
            return null;
        }

        // Initialize CSRF token
        async function initializeCSRFToken() {
            let token = getCSRFToken();
            
            if (!token) {
                token = await fetchCSRFToken();
            }
            
            if (token) {
                document.getElementById('csrf-token').value = token;
            }
        }

        // تعطيل/تفعيل الزر
        function toggleLoginButton(disabled) {
            loginBtn.disabled = disabled;
            if (disabled) {
                loginBtn.classList.add('opacity-75', 'cursor-not-allowed');
                loginText.textContent = 'جاري التحقق...';
                loginIcon.classList.add('hidden');
                loadingSpinner.classList.remove('hidden');
            } else {
                loginBtn.classList.remove('opacity-75', 'cursor-not-allowed');
                loginText.textContent = 'تسجيل الدخول';
                loginIcon.classList.remove('hidden');
                loadingSpinner.classList.add('hidden');
            }
        }

        // عرض رسالة الخطأ
        function showError(message) {
            errorMessage.textContent = message;
            errorMessage.classList.remove('hidden');
            
            // إخفاء الرسالة بعد 5 ثوانٍ
            setTimeout(() => {
                errorMessage.classList.add('hidden');
            }, 5000);
        }

        // إخفاء رسالة الخطأ
        function hideError() {
            errorMessage.classList.add('hidden');
        }

        loginForm.addEventListener('submit', async function (e) {
            e.preventDefault();
            hideError();
            toggleLoginButton(true);

            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value.trim();
            const csrfToken = document.getElementById('csrf-token').value;

            // التحقق من صحة البيانات
            if (!email || !password) {
                showError('يرجى تعبئة جميع الحقول');
                toggleLoginButton(false);
                return;
            }

            if (!isValidEmail(email)) {
                showError('يرجى إدخال بريد إلكتروني صحيح');
                toggleLoginButton(false);
                return;
            }

            // Prepare headers
            const headers = {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            };

            // Add CSRF token to headers
            if (csrfToken) {
                headers['X-CSRF-TOKEN'] = csrfToken;
            }

            // Also add X-Requested-With for Laravel
            headers['X-Requested-With'] = 'XMLHttpRequest';

            // Prepare request body
            const requestBody = { email, password };
            
            // If using form data instead of JSON
            // const formData = new FormData();
            // formData.append('email', email);
            // formData.append('password', password);
            // if (csrfToken) formData.append('_token', csrfToken);

            try {
                const response = await fetch('/api/auth/login', {
                    method: 'POST',
                    headers: headers,
                    credentials: 'same-origin', // Important for CSRF cookies
                    body: JSON.stringify(requestBody)
                    // body: formData // Use this if sending form data
                });

                const data = await response.json();

                if (!response.ok) {
                    // Handle specific CSRF error
                    if (response.status === 419) {
                        // Try to refresh CSRF token and retry
                        await initializeCSRFToken();
                        showError('انتهت صلاحية الجلسة. يرجى المحاولة مرة أخرى');
                        toggleLoginButton(false);
                        return;
                    }
                    throw new Error(data.message || 'فشل تسجيل الدخول');
                }

                // تخزين التوكن
                if (data.token) {
                    localStorage.setItem('token', data.token);
                }

                // رسالة نجاح
                loginText.textContent = 'تم بنجاح! جاري التحويل...';
                loginBtn.classList.add('bg-green-500');
                
                // تأخير قبل التحويل لإظهار رسالة النجاح
                setTimeout(() => {
                    window.location.href = '/tasks-page';
                }, 1500);

            } catch (error) {
                showError(error.message || 'حدث خطأ أثناء الاتصال بالسيرفر');
                toggleLoginButton(false);
            }
        });

        // التحقق من صحة البريد الإلكتروني
        function isValidEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        // تأثير بصري للحقول
        const inputs = document.querySelectorAll('.input-field');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.parentElement.classList.add('scale-105');
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.parentElement.classList.remove('scale-105');
            });
        });

        // التحقق من وجود توكن مسبق
        if (localStorage.getItem('token')) {
            window.location.href = '/tasks-page';
        }

        // Initialize CSRF token on page load
        document.addEventListener('DOMContentLoaded', function() {
            initializeCSRFToken();
        });
    </script>
</body>
</htm