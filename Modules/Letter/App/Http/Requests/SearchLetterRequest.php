<?php

namespace Modules\Letter\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchLetterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [

            'title' => 'nullable|string',
            'body' => 'nullable|string',
            'user_id' => 'nullable|numeric|exists:users,id',
            'tasks' => 'nullable|array',
            'tasks.*' => 'nullable|numeric|exists:tasks,id',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }
}
