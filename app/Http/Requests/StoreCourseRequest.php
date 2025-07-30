<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
{
    public function authorize()
    {
        return true; // adjust as per auth logic
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'nullable|string|max:255',
            'modules' => 'required|array|min:1',
            'modules.*.title' => 'required|string|max:255',
            'modules.*.contents' => 'nullable|array',
            'modules.*.contents.*.title' => 'required|string|max:255',
            'modules.*.contents.*.video_source_type' => 'nullable|string|in:youtube,vimeo,dailymotion,other',
            'modules.*.contents.*.video_url' => 'nullable|url',
            'modules.*.contents.*.video_length' => 'nullable|numeric|min:0',
        ];
    }
}
