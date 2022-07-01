<?php

namespace App\Http\Requests\Materials;

use Elegant\Sanitizer\Laravel\SanitizesInput;
use Illuminate\Foundation\Http\FormRequest;

class CreateMaterialRequest extends FormRequest
{
    use SanitizesInput;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     *  Validation rules to be applied to the input.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'               => 'required|string|max:80',
            'description'        => 'required|string|max:8192',
            'summary'            => 'nullable|string|max:100',
            'parent_id'          => 'nullable|integer',
            'project_id'         => 'nullable|integer',
            'owner_id'           => 'nullable|integer',
       ];
    }

    /**
     *  Filters to be applied to the input.
     *
     * @return array
     */
    public function filters()
    {
        return [];
    }
}
