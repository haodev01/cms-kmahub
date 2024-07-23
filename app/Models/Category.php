<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Kyslik\ColumnSortable\Sortable;

class Category extends Model
{
    use HasFactory, SoftDeletes, Sortable;

    protected $sortable = ['id', 'name', 'created_at', 'description'];

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'parent_id',
        'status'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($category) {
            $category->slug = Str::slug($category->name);
        });
        static::deleting(function ($category) {
            $category->children()->delete();
        });
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }

    public static function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
