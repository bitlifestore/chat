<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product - MyChat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Outfit', sans-serif; background: radial-gradient(circle at top left, #f3f4f6 0%, #e5e7eb 100%); }
        .glass-card { background: rgba(255,255,255,0.7); backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.3); box-shadow: 0 25px 50px -12px rgba(0,0,0,0.1); }
        .animate-float { animation: float 6s ease-in-out infinite; }
        @keyframes float { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-20px)} }
    </style>
</head>
<body class="min-h-screen p-6 overflow-hidden relative">

    <div class="fixed -top-24 -left-24 w-96 h-96 bg-amber-100 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-float"></div>
    <div class="fixed -bottom-24 -right-24 w-96 h-96 bg-rose-100 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-float" style="animation-delay:2s"></div>

    <div class="relative z-10 max-w-2xl mx-auto">

        <!-- Back link -->
        <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 text-gray-500 hover:text-indigo-600 transition-colors mb-6 font-medium">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back to Products
        </a>

        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">✏️ Edit Product</h1>
            <p class="text-gray-500 mt-1">Updating: <span class="font-semibold text-gray-700">{{ $product->name }}</span></p>
        </div>

        <!-- Form Card -->
        <div class="glass-card rounded-3xl p-8">
            <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('products._form')

                <div class="flex gap-3 mt-8">
                    <button type="submit"
                            class="flex-1 py-3.5 bg-green-600 hover:bg-green-700 text-white font-bold rounded-2xl shadow-lg shadow-green-200 hover:shadow-green-300 transform hover:-translate-y-0.5 transition-all duration-200">
                        ✅ Update Product
                    </button>
                    <a href="{{ route('products.index') }}"
                       class="px-6 py-3.5 bg-gray-100 hover:bg-gray-200 text-gray-600 font-semibold rounded-2xl transition-all duration-200">
                        Cancel
                    </a>
                </div>
            </form>
        </div>

    </div>
</body>
</html>
