<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - MyChat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background: radial-gradient(circle at top left, #f3f4f6 0%, #e5e7eb 100%);
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-6 overflow-hidden relative">
    <!-- Decorative Elements -->
    <div class="absolute -top-24 -left-24 w-96 h-96 bg-blue-100 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-float" style="animation-delay: 0s;"></div>
    <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-purple-100 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-float" style="animation-delay: 2s;"></div>

    <div class="w-full max-w-md relative z-10 transition-all duration-500 ease-out transform">
        <!-- Logo -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-indigo-600 rounded-2xl shadow-indigo-200 shadow-2xl mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-900">Join MyChat</h1>
            <p class="text-gray-500 mt-2">Create an account to start chatting</p>
        </div>

        <div class="glass-card rounded-[2.5rem] p-10">
            <form action="{{ route('register') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2 ml-1">Full Name</label>
                    <input type="text" id="name" name="name" required placeholder="John Doe" 
                        class="w-full px-5 py-3.5 bg-white/50 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200">
                </div>

                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2 ml-1">Email Address</label>
                    <input type="email" id="email" name="email" required placeholder="john@example.com" 
                        class="w-full px-5 py-3.5 bg-white/50 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200">
                </div>

                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2 ml-1">Password</label>
                    <input type="password" id="password" name="password" required placeholder="••••••••" 
                        class="w-full px-5 py-3.5 bg-white/50 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200">
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2 ml-1">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="••••••••" 
                        class="w-full px-5 py-3.5 bg-white/50 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200">
                </div>

                <div class="flex items-start ml-1 pt-1">
                    <input type="checkbox" id="terms" name="terms" required class="w-4 h-4 mt-0.5 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                    <label for="terms" class="ml-2 text-xs text-gray-600 font-medium">I agree to the <a href="#" class="text-indigo-600 underline">Terms of Service</a> and <a href="#" class="text-indigo-600 underline">Privacy Policy</a></label>
                </div>

                <button type="submit" 
                    class="w-full py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-2xl shadow-lg shadow-indigo-200 hover:shadow-indigo-300 transform hover:-translate-y-1 transition-all duration-200 mt-2">
                    Create Account
                </button>
            </form>

            <div class="mt-8 pt-8 border-t border-gray-100 text-center">
                <p class="text-gray-600 font-medium">
                    Already have an account? 
                    <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-500 font-bold ml-1">Login here</a>
                </p>
            </div>
        </div>

        <!-- Footer -->
        <p class="text-center text-gray-400 text-sm mt-8">
            &copy; 2026 MyChat. All rights reserved.
        </p>
    </div>
</body>
</html>
