<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateCourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        // Lấy dữ liệu từ request
        $data = $this->all();

        // Loại bỏ các phần tử rỗng khỏi mảng 'names'
        if (isset($data['requirments']) && is_array($data['requirments'])) {
            $data['requirments'] = array_filter($data['requirments'], function ($value) {
                return !empty($value);
            });
        }

        // Cập nhật dữ liệu đã làm sạch
        $this->merge($data);
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
            'slug' => 'required|string|max:255|unique:courses,slug',
            'category_id' => 'required|exists:categories,id',
            'price_original' => 'required',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:4096',
            'video' => 'file|mimes:mp4,ogx,oga,ogv,ogg,webm,',
            'requirments' => 'nullable|array',
            'requirments.*' => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Tên khóa học không được để trống',
            'price_original.required' => 'Giá không được để trống',
            'category_id.required' => 'Danh mục khóa học không được để trống',
            'category_id.exists' => 'Không tìm thấy danh mục khóa học',
            'slug.required' => 'Đường dẫn khóa học không được để trống',
            'slug.unique' => 'Đường dẫn khóa học đã tồn tại',
            'thumbnail.required' => 'Thumbnail không được để trống',
            'thumbnail.image' => 'Thumbnail khóa học phải hình ảnh ',
            'thumbnail.mimes' => 'Thumbnail phải có định dạng jpeg, png, jpg, gif, svg webp',
            'thumbnail.max' => 'Thumbnail phải có định dạng tối đa 4MB',
            'video.required' => 'Video preview không được để trống',
            'video.file' => 'Video preview phải có định dạng file ',
            'video.mimes' => 'Video preview phải có định dạng mp4, ogx, oga, ogv, ogg, webm',
            'requirments.array' => 'Yêu cầu cho khó học phải có định dạng mảng',
            'requirments.*.string' => 'Các yêu cầu cho khóa học phải có là string',
            'requirments.*.max' => 'Các yêu cầu cho khóa học chứa tối đa 255 ký tự',
        ];
    }


}
