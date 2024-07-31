<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Kyslik\ColumnSortable\Sortable;

class Lesson extends Model
{
    use HasFactory, Sortable;

    protected $table = 'lessons';

    protected array $sortable = ['id', 'name', 'status', 'created_at', 'updated_at'];

    protected $fillable = ['name', 'section_id', 'description', 'status', 'video', 'duration', ];

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($chapter) {
            $latestLesson = self::latest()->first();
            $chapter->slug = Str::slug($chapter->name);
            $chapter->order = $latestLesson ? $latestLesson->order + 1 : 1;
        });

    }

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'created_by_id');
    }
}
