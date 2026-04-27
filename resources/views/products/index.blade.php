<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - MyChat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Outfit', sans-serif; background: radial-gradient(circle at top left, #f3f4f6 0%, #e5e7eb 100%); }
        .glass-card { background: rgba(255,255,255,0.7); backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.3); box-shadow: 0 25px 50px -12px rgba(0,0,0,0.1); }
        .animate-float { animation: float 6s ease-in-out infinite; }
        @keyframes float { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-20px)} }
        .badge-active  { background:#dcfce7; color:#15803d; }
        .badge-inactive{ background:#f1f5f9; color:#64748b; }
    </style>
</head>
<body class="min-h-screen p-6 overflow-hidden relative">

    <!-- Decorative blobs -->
    <div class="fixed -top-24 -left-24 w-96 h-96 bg-blue-100 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-float"></div>
    <div class="fixed -bottom-24 -right-24 w-96 h-96 bg-purple-100 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-float" style="animation-delay:2s"></div>

    <div class="relative z-10 max-w-6xl mx-auto">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">🛒 Products</h1>
                <p class="text-gray-500 mt-1">Manage your product catalog</p>
            </div>
            <a href="{{ route('products.create') }}"
               class="inline-flex items-center gap-2 px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-2xl shadow-lg shadow-indigo-200 hover:shadow-indigo-300 transform hover:-translate-y-0.5 transition-all duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add Product
            </a>
        </div>

        <!-- Flash Message -->
        @if(session('success'))
            <div class="mb-6 px-5 py-4 bg-green-50 border border-green-200 text-green-800 rounded-2xl flex items-center gap-3">
                <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        <!-- Search Bar -->
        <form method="GET" class="mb-6 flex gap-3">
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Search by name or category..."
                   class="flex-1 px-5 py-3 bg-white/60 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 backdrop-blur">
            <button type="submit"
                    class="px-6 py-3 bg-white/70 border border-gray-200 text-gray-700 font-semibold rounded-2xl hover:bg-white transition-all duration-200">
                Search
            </button>
            @if(request('search'))
                <a href="{{ route('products.index') }}"
                   class="px-6 py-3 bg-white/70 border border-gray-200 text-gray-500 font-semibold rounded-2xl hover:bg-white transition-all duration-200">
                    Clear
                </a>
            @endif
        </form>

        <!-- Table Card -->
        <div class="glass-card rounded-3xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-indigo-600 text-white text-sm font-semibold">
                            <th class="px-6 py-4 text-left">#</th>
                            <th class="px-6 py-4 text-left">Image</th>
                            <th class="px-6 py-4 text-left">Product</th>
                            <th class="px-6 py-4 text-left">Price</th>
                            <th class="px-6 py-4 text-left">Stock</th>
                            <th class="px-6 py-4 text-left">Status</th>
                            <th class="px-6 py-4 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                    @forelse($products as $p)
                        <tr class="hover:bg-indigo-50/50 transition-colors duration-150">
                            <td class="px-6 py-4 text-gray-400 text-sm">{{ $p->id }}</td>
                            <td class="px-6 py-4">
                                @if($p->image)
                                    <img src="{{ asset('storage/'.$p->image) }}"
                                         class="w-12 h-12 object-cover rounded-xl shadow-sm">
                                @else
                                    <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center text-gray-400">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-semibold text-gray-900">{{ $p->name }}</p>
                                @if($p->category)
                                    <p class="text-xs text-gray-400 mt-0.5">{{ $p->category }}</p>
                                @endif
                            </td>
                            <td class="px-6 py-4 font-semibold text-gray-800">₹{{ number_format($p->price, 2) }}</td>
                            <td class="px-6 py-4">
                                <span class="font-medium {{ $p->stock < 10 ? 'text-red-600' : 'text-gray-700' }}">
                                    {{ $p->stock }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $p->is_active ? 'badge-active' : 'badge-inactive' }}">
                                    {{ $p->is_active ? '● Active' : '○ Inactive' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('products.show', $p) }}"
                                       class="px-3 py-1.5 bg-indigo-100 text-indigo-700 text-xs font-semibold rounded-xl hover:bg-indigo-200 transition-colors">
                                        View
                                    </a>
                                    <a href="{{ route('products.edit', $p) }}"
                                       class="px-3 py-1.5 bg-amber-100 text-amber-700 text-xs font-semibold rounded-xl hover:bg-amber-200 transition-colors">
                                        Edit
                                    </a>
                                    <form action="{{ route('products.destroy', $p) }}" method="POST"
                                          onsubmit="return confirm('Delete this product?')">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                                class="px-3 py-1.5 bg-red-100 text-red-700 text-xs font-semibold rounded-xl hover:bg-red-200 transition-colors">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center gap-3 text-gray-400">
                                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                    </svg>
                                    <p class="font-medium">No products found</p>
                                    <a href="{{ route('products.create') }}" class="text-indigo-600 text-sm hover:underline">Add your first product →</a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($products->hasPages())
                <div class="px-6 py-4 border-t border-gray-100">
                    {{ $products->links() }}
                </div>
            @endif
        </div>

        <!-- Stats Row -->
        <div class="mt-4 text-center text-sm text-gray-400">
            Showing {{ $products->firstItem() ?? 0 }}–{{ $products->lastItem() ?? 0 }} of {{ $products->total() }} products
        </div>

    </div>
</body>
</html>
