<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>إنشاء حساب جديد</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Cairo', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .register-container {
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
        .btn-register {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            transition: all 0.3s ease;
        }
        .btn-register:hover {
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(16, 185, 129, 0.3);
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
        .success-message {
            animation: slideIn 0.5s ease-in-out;
        }
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }
        @keyframes slideIn {
            0% { transform: translateY(-10px); opacity: 0; }
            100% { transform: translateY(0); opacity: 1; }
        }
        .password-strength {
            height: 4px;
            background: #e5e7eb;
            border-radius: 2px;
            overflow: hidden;
            margin-top: 8px;
        }
        .password-strength-bar {
            height: 100%;
            transition: all 0.3s ease;
            border-radius: 2px;
        }
        .strength-weak { background: #ef4444; width: 25%; }
        .strength-fair { background: #f59e0b; width: 50%; }
        .strength-good { background: #10b981; width: 75%; }
        .strength-strong { background: #059669; width: 100%; }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    <!-- Floating Shapes Background -->
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <div class="register-container bg-white bg-opacity-95 p-8 rounded-3xl w-full max-w-md">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="w-20 h-20 bg-gradient-to-br from-green-500 to-emerald-600 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                </svg>
            </div>
            <h2 class="text-3xl font-bold text-gray-800 mb-2">إنشاء حساب جديد</h2>
            <p class="text-gray-600">انضم إلينا وابدأ رحلة الإنتاجية</p>
        </div>

        <!-- Registration Form -->
        <form id="register-form" class="space-y-6">
            <!-- Name Field -->
            <div class="input-group">
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">الاسم الكامل</label>
                <div class="relative">
                    <input type="text" id="name" name="name" required
                        class="input-field w-full p-4 border-2 border-gray-200 rounded-xl focus:border-green-500 focus:outline-none pr-12"
                        placeholder="أدخل اسمك الكامل">
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Email Field -->
            <div class="input-group">
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">البريد الإلكتروني</label>
                <div class="relative">
                    <input type="email" id="email" name="email" required
                        class="input-field w-full p-4 border-2 border-gray-200 rounded-xl focus:border-green-500 focus:outline-none pr-12"
                        placeholder="أدخل بريدك الإلكتروني">
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Password Field -->
            <div class="input-group">
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">كلمة المرور</label>
                <div class="relative">
                    <input type="password" id="password" name="password" required
                        class="input-field w-full p-4 border-2 border-gray-200 rounded-xl focus:border-green-500 focus:outline-none pr-12 pl-12"
                        placeholder="أدخل كلمة المرور">
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <button type="button" id="toggle-password" class="absolute inset-y-0 left-0 pl-3 flex items-center">
                        <svg id="eye-open" class="w-5 h-5 text-gray-400 hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        <svg id="eye-closed" class="hidden w-5 h-5 text-gray-400 hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                        </svg>
                    </button>
                </div>
                <!-- Password Strength Indicator -->
                <div class="password-strength">
                    <div id="password-strength-bar" class="password-strength-bar"></div>
                </div>
                <p id="password-strength-text" class="text-xs text-gray-500 mt-1"></p>
            </div>

            <!-- Password Confirmation Field -->
            <div class="input-group">
                <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">تأكيد كلمة المرور</label>
                <div class="relative">
                    <input type="password" id="password_confirmation" name="password_confirmation" required
                        class="input-field w-full p-4 border-2 border-gray-200 rounded-xl focus:border-green-500 focus:outline-none pr-12"
                        placeholder="أعد إدخال كلمة المرور">
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Error Message -->
            <div id="error-message" class="hidden error-message bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl text-sm"></div>

            <!-- Success Message -->
            <div id="success-message" class="hidden success-message bg-green-50 border border-green-200 text-green-600 px-4 py-3 rounded-xl text-sm"></div>

            <!-- Register Button -->
            <button type="submit" id="register-btn"
                class="btn-register w-full text-white p-4 rounded-xl font-semibold text-lg flex items-center justify-center space-x-2 space-x-reverse">
                <span id="register-text">إنشاء الحساب</span>
                <svg id="register-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
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
            <p>لديك حساب بالفعل؟ <a href="/login" class="text-green-600 hover:text-green-800 font-semibold">تسجيل الدخول</a></p>
        </div>
    </div>

    <script>
        const registerForm = document.getElementById('register-form');
        const registerBtn = document.getElementById('register-btn');
        const registerText = document.getElementById('register-text');
        const registerIcon = document.getElementById('register-icon');
        const loadingSpinner = document.getElementById('loading-spinner');
        const errorMessage = document.getElementById('error-message');
        const successMessage = document.getElementById('success-message');
        const passwordField = document.getElementById('password');
        const passwordConfirmField = document.getElementById('password_confirmation');
        const togglePassword = document.getElementById('toggle-password');
        const eyeOpen = document.getElementById('eye-open');
        const eyeClosed = document.getElementById('eye-closed');
        const passwordStrengthBar = document.getElementById('password-strength-bar');
        const passwordStrengthText = document.getElementById('password-strength-text');

        // الحصول على CSRF token
        function getCSRFToken() {
            return document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
        }

        // تبديل إظهار/إخفاء كلمة المرور
        togglePassword.addEventListener('click', function() {
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            eyeOpen.classList.toggle('hidden');
            eyeClosed.classList.toggle('hidden');
        });

        // فحص قوة كلمة المرور
        passwordField.addEventListener('input', function() {
            const password = this.value;
            const strength = checkPasswordStrength(password);
            updatePasswordStrengthIndicator(strength);
        });

        function checkPasswordStrength(password) {
            let score = 0;

            if (password.length >= 8) score++;
            if (password.match(/[a-z]/)) score++;
            if (password.match(/[A-Z]/)) score++;
            if (password.match(/[0-9]/)) score++;
            if (password.match(/[^a-zA-Z0-9]/)) score++;

            switch (score) {
                case 0:
                case 1:
                    return { level: 'weak', text: 'ضعيفة جداً' };
                case 2:
                    return { level: 'weak', text: 'ضعيفة' };
                case 3:
                    return { level: 'fair', text: 'متوسطة' };
                case 4:
                    return { level: 'good', text: 'جيدة' };
                case 5:
                    return { level: 'strong', text: 'قوية جداً' };
                default:
                    return { level: 'weak', text: 'ضعيفة' };
            }
        }

        function updatePasswordStrengthIndicator(strength) {
            passwordStrengthBar.className = `password-strength-bar strength-${strength.level}`;
            passwordStrengthText.textContent = `قوة كلمة المرور: ${strength.text}`;
        }

        function toggleRegisterButton(disabled) {
            registerBtn.disabled = disabled;
            if (disabled) {
                registerBtn.classList.add('opacity-75', 'cursor-not-allowed');
                registerText.textContent = 'جاري الإنشاء...';
                registerIcon.classList.add('hidden');
                loadingSpinner.classList.remove('hidden');
            } else {
                registerBtn.classList.remove('opacity-75', 'cursor-not-allowed');
                registerText.textContent = 'إنشاء الحساب';
                registerIcon.classList.remove('hidden');
                loadingSpinner.classList.add('hidden');
            }
        }

        // عرض رسالة الخطأ
        function showError(message) {
            errorMessage.textContent = message;
            errorMessage.classList.remove('hidden');
            successMessage.classList.add('hidden');
            
            setTimeout(() => {
                errorMessage.classList.add('hidden');
            }, 5000);
        }

        function showSuccess(message) {
            successMessage.textContent = message;
            successMessage.classList.remove('hidden');
            errorMessage.classList.add('hidden');
        }

        // إخفاء الرسائل
        function hideMessages() {
            errorMessage.classList.add('hidden');
            successMessage.classList.add('hidden');
        }

        registerForm.addEventListener('submit', async function (e) {
            e.preventDefault();
            hideMessages();
            toggleRegisterButton(true);

            const name = document.getElementById('name').value.trim();
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value.trim();
            const passwordConfirmation = document.getElementById('password_confirmation').value.trim();

            if (!name || !email || !password || !passwordConfirmation) {
                showError('يرجى تعبئة جميع الحقول');
                toggleRegisterButton(false);
                return;
            }

            if (!isValidEmail(email)) {
                showError('يرجى إدخال بريد إلكتروني صحيح');
                toggleRegisterButton(false);
                return;
            }

            if (password.length < 8) {
                showError('كلمة المرور يجب أن تكون 8 أحرف على الأقل');
                toggleRegisterButton(false);
                return;
            }

            if (password !== passwordConfirmation) {
                showError('كلمة المرور وتأكيدها غير متطابقتين');
                toggleRegisterButton(false);
                return;
            }

            try {
                let response = await fetch('/api/auth/register', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': getCSRFToken()
                    },
                    body: JSON.stringify({ 
                        name, 
                        email, 
                        password, 
                        password_confirmation: passwordConfirmation 
                    })
                });

                if (!response.ok && response.status === 404) {
                    response = await fetch('/register', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': getCSRFToken()
                        },
                        body: JSON.stringify({ 
                            name, 
                            email, 
                            password, 
                            password_confirmation: passwordConfirmation 
                        })
                    });
                }

                const data = await response.json();

                if (!response.ok) {

                    if (data.errors) {
                        const errorMessages = Object.values(data.errors).flat();
                        throw new Error(errorMessages.join(', '));
                    }
                    throw new Error(data.message || 'فشل إنشاء الحساب');
                }


                showSuccess('تم إنشاء الحساب بنجاح! جاري تسجيل الدخول...');
                registerText.textContent = 'تم بنجاح! جاري التحويل...';
                registerBtn.classList.remove('btn-register');
                registerBtn.classList.add('bg-green-500');
                

                if (data.token) {
                    localStorage.setItem('token', data.token);
                }


                setTimeout(() => {
                    window.location.href = '/tasks-page';
                }, 2000);

            } catch (error) {
                console.error('Registration error:', error);
                showError(error.message || 'حدث خطأ أثناء إنشاء الحساب');
                toggleRegisterButton(false);
            }
        });


        function isValidEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }


        const inputs = document.querySelectorAll('.input-field');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.parentElement.classList.add('scale-105');
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.parentElement.classList.remove('scale-105');
            });
        });


        passwordConfirmField.addEventListener('input', function() {
            const password = passwordField.value;
            const confirmPassword = this.value;
            
            if (confirmPassword && password !== confirmPassword) {
                this.classList.add('border-red-500');
                this.classList.remove('border-gray-200');
            } else {
                this.classList.remove('border-red-500');
                this.classList.add('border-gray-200');
            }
        });

        if (localStorage.getItem('token')) {
            window.location.href = '/tasks-page';
        }
    </script>
</body>
</html>