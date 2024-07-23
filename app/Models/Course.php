<?php

namespace App\Models;

use App\Helpers\FileUpload;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Kyslik\ColumnSortable\Sortable;

class Course extends Model
{
    use HasFactory, SoftDeletes, Sortable;

    protected array $sortable = ["id", "name", 'description', 'status', 'level', 'price_original', 'created_by_id'];

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price_original',
        'price_sale',
        'status',
        'level',
        'category_id',
        'thumbnail',
        'video_preview',
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($course) {
            $user = Auth::guard('admin')->user();
            $course->created_by_id = $user->id;
            $course->price_original = str_replace(',', '', $course->price_original);
            $course->price_sale = str_replace(',', '', $course->price_sale);
        });
        static::updating(function ($course) {
            $course->price_original = str_replace(',', '', $course->price_original);
            $course->price_sale = str_replace(',', '', $course->price_sale);
        });
        static::deleting(function ($course) {
            $course->sections()->delete();
            $course->requirements()->delete();
            FileUpload::delete($course->thumbnail);
            FileUpload::delete($course->video_preview);
        });

    }

    public function sections(): HasMany
    {
        return $this->hasMany(Section::class);
    }

    public function requirements(): HasMany
    {
        return $this->hasMany(CourseRequirement::class);
    }

    public function benefits(): HasMany
    {
        return $this->hasMany(CourseBenefit::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'created_by_id');
    }
}
