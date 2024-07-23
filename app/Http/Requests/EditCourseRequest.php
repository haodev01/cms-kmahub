<?php

namespace App\Http\Requests;

use http\Env\Request;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class EditCourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'price_original' => 'required',
            'category_id' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Tên khóa học không được để trống',
            'price_original.required' => 'Giá không được để trống',
            'category_id.required' => 'Danh mục khóa học không được để trống',
        ];
    }


}
