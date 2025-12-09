<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $settings[6]->value }} | Login</title>
    <link rel="icon" href="../{{ $settings[13]->value }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
        }
        .gradient-bg {
            background: white;
        }
        .btn-primary {
            background-color: {{ $settings[4]->value }};
            color: {{ $settings[5]->value }};
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
        .input-field {
            transition: all 0.3s ease;
        }
        .input-field:focus {
            border-color: {{ $settings[4]->value }};
            box-shadow: 0 0 0 3px {{ $settings[4]->value }}20;
            transform: scale(1.02);
        }
        @media (max-width: 640px) {
            .mobile-stack { flex-direction: column; }
            .mobile-padding { padding: 1.5rem; }
            .mobile-text-center { text-align: center; }
            .mobile-mt-4 { margin-top: 1rem; }
        }

        /* Form field entrance animation (optional – kept because it looks nice) */
        .form-field {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }
        .form-field.visible {
            opacity: 1;
            transform: translateY(0);
        }
        .form-field:nth-child(1) { transition-delay: 0.1s; }
        .form-field:nth-child(2) { transition-delay: 0.2s; }
        .form-field:nth-child(3) { transition-delay: 0.3s; }
        .form-field:nth-child(4) { transition-delay: 0.4s; }
    </style>
</head>

<body class="gradient-bg">

    <!-- Main Login Interface -->
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="flex flex-col w-full max-w-4xl overflow-hidden bg-white shadow-xl rounded-2xl mobile-stack lg:flex-row">

            <!-- Left Side - Branding (Hidden on mobile) -->
            <div class="lg:w-1/2 bg-gradient-to-br from-[{{ $settings[2]->value }}] to-[{{ $settings[4]->value }}] p-8 flex flex-col justify-center items-center text-white hidden sm:flex">
                <div class="w-full max-w-xs mb-8">
                    <img src="{{ asset($settings[1]->value) }}" alt="Company Logo" class="w-full h-auto">
                </div>
                <h2 class="mb-2 text-2xl font-bold mobile-text-center">Welcome Back!</h2>
                <p class="text-center opacity-90">Sign in to access your account and continue your journey with us.</p>
            </div>
            
            <!-- Mobile Header (Shown only on mobile) -->
            <div class="sm:hidden p-6 bg-gradient-to-r from-[{{ $settings[2]->value }}] to-[{{ $settings[4]->value }}] text-white">
                <div class="w-16 h-16 mx-auto mb-4">
                    <img src="{{ asset($settings[1]->value) }}" alt="Company Logo" class="object-contain w-full h-full">
                </div>
                <h2 class="text-xl font-bold text-center">Welcome Back!</h2>
            </div>
            
            <!-- Right Side - Login Form -->
            <div class="p-6 sm:p-8 lg:w-1/2 mobile-padding">
                <h1 class="mb-2 text-2xl font-bold text-gray-800 sm:text-3xl mobile-text-center sm:text-left">Sign In</h1>
                <p class="mb-6 text-gray-600 sm:mb-8 mobile-text-center sm:text-left">Enter your credentials to access your account</p>
                
                <form method="POST" action="{{ route('login') }}" class="space-y-4 sm:space-y-6">
                    @csrf
                    
                    <!-- Email Field -->
                    <div class="form-field">
                        <label for="email" class="block mb-1 text-sm font-medium text-gray-700">Email Address</label>
                        <div class="relative">
                            <input type="email" name="email" id="email" placeholder="your@email.com" 
                                   class="w-full px-4 py-2 text-sm border border-gray-300 rounded-lg sm:py-3 sm:text-base input-field focus:outline-none" required autocomplete="email">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Password Field -->
                    <div class="form-field">
                        <label for="password" class="block mb-1 text-sm font-medium text-gray-700">Password</label>
                        <div class="relative">
                            <input type="password" name="password" id="password" placeholder="••••••••" 
                                   class="w-full px-4 py-2 pr-10 text-sm border border-gray-300 rounded-lg sm:py-3 sm:text-base input-field focus:outline-none" required autocomplete="current-password">
                            <button type="button" id="togglePassword" class="absolute inset-y-0 right-3 flex items-center text-gray-400 hover:text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    
                    <div class="w-full mt-4 text-center text-gray-600 form-field max-sm:text-sm">
                        <p>Welcome back! Please enter your credentials to access the system.</p>
                    </div>
                    
                    <!-- Submit Button -->
                    <div class="form-field">
                        <button type="submit" class="w-full px-4 py-2 text-base font-medium rounded-lg shadow-sm sm:py-3 sm:text-lg btn-primary mobile-mt-4">
                            Sign In
                        </button>
                    </div>
                </form>
                
                <!-- Footer -->
                <div class="mt-8 text-xs text-center text-gray-500">
                    <p>© {{ date('Y') }} {{ $settings[6]->value }}. All rights reserved.</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Password toggle
        document.getElementById('togglePassword')?.addEventListener('click', function () {
            const passwordField = document.getElementById('password');
            const icon = this.querySelector('svg');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                icon.innerHTML = `<path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z"/><path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z"/><path d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12-.708.708z"/>`;
            } else {
                passwordField.type = 'password';
                icon.innerHTML = `<path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/><path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>`;
            }
        });

        // Simple fade-in for form fields when page loads (optional but smooth)
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.form-field').forEach(field => {
                field.classList.add('visible');
            });
        });
    </script>
</body>
</html>