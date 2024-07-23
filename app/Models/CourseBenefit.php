<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourseBenefit extends Model
{
    use HasFactory;

    protected $table = 'course_benefits';

    protected $fillable = ['course_id', 'name', 'description'];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
