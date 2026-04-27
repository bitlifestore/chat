<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Product extends Model {
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'description',
        'price', 'stock', 'image',
        'category', 'is_active',
    ];

    protected $casts = [
        'price'     => 'decimal:2',
        'is_active' => 'boolean',
    ];

    // Auto-generate slug from name
    protected static function boot() {
        parent::boot();
        static::creating(function ($product) {
            $product->slug = Str::slug($product->name);
        });
    }

    // Scope: only active products
    public function scopeActive($query) {
        return $query->where('is_active', true);
    }

    // Scope: search by name/category
    public function scopeSearch($query, $term) {
        return $query->where(function ($q) use ($term) {
            $q->where('name', 'like', "%$term%")
              ->orWhere('category', 'like', "%$term%");
        });
    }
}
