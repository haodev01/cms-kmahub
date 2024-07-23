<?php

namespace App\Helpers;

class ConstantsHelper
{
    const LEVEL = [
        'beginner' => 'Cơ bản',
        'intermediate' => 'Trung bình',
        'anvanced' => 'Nâng cao',
        'expert' => 'Chuyên sâu',
    ];
    const LEVEL_COLOR = [
        'beginner' => 'bg-primary',
        'intermediate' => 'bg-warning',
        'anvanced' => 'bg-success',
        'expert' => 'bg-info',
    ];

    const STATUS = [
        'active' => 'Hoạt động',
        'pending' => 'Tạm dừng',
        'draft' => 'Nháp',
    ];
    const STATUS_COLOR = [
        'active' => 'text-success',
        'pending' => 'text-warning',
        'draft' => 'text-danger',
    ];
    const STATUS_COLOR_BG = [
        'active' => 'bg-success',
        'pending' => 'bg-warning',
        'draft' => 'bg-danger',
    ];
    const LIST_STATUS = [
        'active' => [
            'text' => 'Hoạt động',
            'key' => 'active',
        ],
        'pending' => [
            'text' => 'Tạm dừng',
            'key' => 'pending',
        ],
        'draft' => [
            'text' => 'Nháp',
            'key' => 'draft',
        ],
    ];

    const LIST_LEVEL = [
        'beginner' => [
            'text' => 'Cơ bản',
            'key' => 'beginner',
        ],
        'intermediate' => [
            'text' => 'Trung bình',
            'key' => 'intermediate',
        ],
        'anvanced' => [
            'text' => 'Nâng cao',
            'key' => 'anvanced',
        ],
        'expert' => [
            'text' => 'Chuyên sâu',
            'key' => 'expert',
        ],
    ];

}
