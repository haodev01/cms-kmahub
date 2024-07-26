<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Kyslik\ColumnSortable\Sortable;

class Section extends Model
{
    use HasFactory, Sortable;

    protected $table = 'sections';

    protected array $sortable = ['id', 'name', 'status', 'created_at', 'updated_at', 'course_id',];
    protected $fillable = [
        'name',
        'slug',
        'description',
        'order',
        'status',
        'course_id',
        'created_by_id',
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($section) {
            $section->created_by_id = Auth::guard('admin')->id();
            $section->slug = Str::slug($section->name);
            $section->order = rand(1, 999999999);
        });
        static::deleting(function ($section) {
            $section->lessons()->delete();
        });
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'created_by_id');
    }
}
