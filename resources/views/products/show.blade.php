<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} - MyChat</title>
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

    <div class="fixed -top-24 -left-24 w-96 h-96 bg-blue-100 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-float"></div>
    <div class="fixed -bottom-24 -right-24 w-96 h-96 bg-green-100 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-float" style="animation-delay:2s"></div>

    <div class="relative z-10 max-w-3xl mx-auto">

        <!-- Back link -->
        <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 text-gray-500 hover:text-indigo-600 transition-colors mb-6 font-medium">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back to Products
        </a>

        <!-- Card -->
        <div class="glass-card rounded-3xl overflow-hidden">

            <!-- Product Image -->
            @if($product->image)
                <div class="h-64 bg-gray-100 overflow-hidden">
                    <img src="{{ asset('storage/'.$product->image) }}"
                         class="w-full h-full object-cover">
                </div>
            @else
                <div class="h-40 bg-gradient-to-br from-indigo-50 to-purple-50 flex items-center justify-center">
                    <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01"/>
                    </svg>
                </div>
            @endif

            <div class="p-8">
                <!-- Status Badge -->
                <div class="flex items-start justify-between mb-4">
                    <div>
                        @if($product->category)
                            <span class="text-xs font-semibold text-indigo-600 uppercase tracking-wider">{{ $product->category }}</span>
                        @endif
                        <h1 class="text-2xl font-bold text-gray-900 mt-1">{{ $product->name }}</h1>
                    </div>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $product->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                        {{ $product->is_active ? '● Active' : '○ Inactive' }}
                    </span>
                </div>

                @if($product->description)
                    <p class="text-gray-600 mb-6 leading-relaxed">{{ $product->description }}</p>
                @endif

                <!-- Stats -->
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 mb-8">
                    <div class="bg-indigo-50 rounded-2xl p-4">
                        <p class="text-xs font-semibold text-indigo-400 uppercase tracking-wider">Price</p>
                        <p class="text-2xl font-bold text-indigo-700 mt-1">₹{{ number_format($product->price, 2) }}</p>
                    </div>
                    <div class="bg-{{ $product->stock < 10 ? 'red' : 'green' }}-50 rounded-2xl p-4">
                        <p class="text-xs font-semibold text-{{ $product->stock < 10 ? 'red' : 'green' }}-400 uppercase tracking-wider">Stock</p>
                        <p class="text-2xl font-bold text-{{ $product->stock < 10 ? 'red' : 'green' }}-700 mt-1">{{ $product->stock }}</p>
                    </div>
                    <div class="bg-gray-50 rounded-2xl p-4">
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">ID / Slug</p>
                        <p class="text-sm font-semibold text-gray-600 mt-1">#{{ $product->id }}</p>
                        <p class="text-xs text-gray-400 truncate">{{ $product->slug }}</p>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex gap-3">
                    <a href="{{ route('products.edit', $product) }}"
                       class="flex-1 py-3 text-center bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-2xl shadow-lg shadow-indigo-200 hover:shadow-indigo-300 transform hover:-translate-y-0.5 transition-all duration-200">
                        ✏️ Edit Product
                    </a>
                    <form action="{{ route('products.destroy', $product) }}" method="POST"
                          onsubmit="return confirm('Delete this product permanently?')">
                        @csrf @method('DELETE')
                        <button type="submit"
                                class="px-6 py-3 bg-red-100 hover:bg-red-600 hover:text-white text-red-700 font-semibold rounded-2xl transition-all duration-200">
                            🗑 Delete
                        </button>
                    </form>
                </div>
            </div>

        </div>

        <p class="text-center text-xs text-gray-400 mt-4">
            Added {{ $product->created_at->diffForHumans() }}
            @if($product->updated_at != $product->created_at)
                · Updated {{ $product->updated_at->diffForHumans() }}
            @endif
        </p>

    </div>
</body>
</html>
