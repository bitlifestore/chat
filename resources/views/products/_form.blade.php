{{-- Shared Product Form Partial --}}

@if($errors->any())
    <div class="mb-6 px-5 py-4 bg-red-50 border border-red-200 rounded-2xl">
        <p class="text-red-700 font-semibold text-sm mb-2">Please fix the following errors:</p>
        <ul class="list-disc list-inside space-y-1">
            @foreach($errors->all() as $e)
                <li class="text-red-600 text-sm">{{ $e }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- Product Name --}}
<div class="mb-5">
    <label class="block text-sm font-semibold text-gray-700 mb-2 ml-1">Product Name *</label>
    <input type="text" name="name" id="product_name" required
           value="{{ old('name', $product->name ?? '') }}"
           placeholder="e.g. iPhone 15 Pro"
           class="w-full px-5 py-3.5 bg-white/50 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200">
</div>

{{-- Description --}}
<div class="mb-5">
    <label class="block text-sm font-semibold text-gray-700 mb-2 ml-1">Description</label>
    <textarea name="description" id="product_description" rows="3"
              placeholder="Product details..."
              class="w-full px-5 py-3.5 bg-white/50 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 resize-none">{{ old('description', $product->description ?? '') }}</textarea>
</div>

{{-- Price & Stock --}}
<div class="grid grid-cols-2 gap-4 mb-5">
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-2 ml-1">Price (₹) *</label>
        <input type="number" name="price" id="product_price" required step="0.01" min="0"
               value="{{ old('price', $product->price ?? '') }}"
               placeholder="0.00"
               class="w-full px-5 py-3.5 bg-white/50 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200">
    </div>
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-2 ml-1">Stock *</label>
        <input type="number" name="stock" id="product_stock" required min="0"
               value="{{ old('stock', $product->stock ?? 0) }}"
               placeholder="0"
               class="w-full px-5 py-3.5 bg-white/50 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200">
    </div>
</div>

{{-- Category --}}
<div class="mb-5">
    <label class="block text-sm font-semibold text-gray-700 mb-2 ml-1">Category</label>
    <input type="text" name="category" id="product_category"
           value="{{ old('category', $product->category ?? '') }}"
           placeholder="e.g. Electronics, Footwear..."
           class="w-full px-5 py-3.5 bg-white/50 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200">
</div>

{{-- Image Upload --}}
<div class="mb-5">
    <label class="block text-sm font-semibold text-gray-700 mb-2 ml-1">Product Image</label>
    <label class="block cursor-pointer">
        <div class="w-full px-5 py-4 bg-white/50 border-2 border-dashed border-gray-300 rounded-2xl hover:border-indigo-400 transition-colors text-center">
            <svg class="w-8 h-8 mx-auto text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01"/>
            </svg>
            <p class="text-sm text-gray-500">Click to upload image</p>
            <p class="text-xs text-gray-400 mt-1">JPG, JPEG, PNG, WEBP — Max 2MB</p>
        </div>
        <input type="file" name="image" id="product_image" accept="image/*" class="hidden"
               onchange="previewImage(this)">
    </label>

    {{-- Preview --}}
    <div id="image_preview_wrap" class="{{ !empty($product->image ?? null) ? '' : 'hidden' }} mt-3">
        <img id="image_preview"
             src="{{ !empty($product->image ?? null) ? asset('storage/'.$product->image) : '' }}"
             class="w-24 h-24 object-cover rounded-2xl shadow border border-gray-200">
        <p class="text-xs text-gray-400 mt-1 ml-1">Current image</p>
    </div>
</div>

{{-- Active Status --}}
<div class="mb-2">
    <label class="flex items-center gap-3 cursor-pointer group">
        <input type="hidden" name="is_active" value="0">
        <div class="relative">
            <input type="checkbox" name="is_active" id="is_active" value="1"
                   class="sr-only peer"
                   {{ old('is_active', $product->is_active ?? true) ? 'checked' : '' }}>
            <div class="w-11 h-6 bg-gray-200 peer-checked:bg-indigo-600 rounded-full transition-colors duration-200"></div>
            <div class="absolute top-0.5 left-0.5 w-5 h-5 bg-white rounded-full shadow transition-transform duration-200 peer-checked:translate-x-5"></div>
        </div>
        <span class="text-sm font-semibold text-gray-700">Active <span class="text-gray-400 font-normal">(visible to customers)</span></span>
    </label>
</div>

<script>
function previewImage(input) {
    const wrap = document.getElementById('image_preview_wrap');
    const preview = document.getElementById('image_preview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            preview.src = e.target.result;
            wrap.classList.remove('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
