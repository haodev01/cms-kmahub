<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourseRequirement extends Model
{
    use HasFactory;

    protected $fillable = [
        'requirement',
        'course_id',
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
