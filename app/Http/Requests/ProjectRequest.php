<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProjectRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        $id = $this->route('project')?->id ?? $this->route('id');

        return [
            'title'      => ['required','string','max:255'],
            'slug'       => ['nullable','string','max:255', Rule::unique('projects','slug')->ignore($id)],
            'city'       => ['nullable','string','max:120'],
            'area'       => ['nullable','string','max:120'],
            'bedrooms'   => ['nullable','integer','min:0'],
            'size_sqft'  => ['nullable','integer','min:0'],
            'price'      => ['nullable','integer','min:0'],
            'status'     => ['required', Rule::in(['draft','published'])],
            'description'=> ['nullable','string'],
            'published_at'=>['nullable','date'],
        ];
    }
}

