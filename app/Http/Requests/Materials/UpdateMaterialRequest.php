<?php

namespace App\Http\Requests\Materials;

use Illuminate\Foundation\Http\FormRequest;
use Elegant\Sanitizer\Laravel\SanitizesInput;

class UpdateMaterialRequest extends FormRequest
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
            'name'        => 'string|max:80',
            'description' => 'string|max:2048',
            'parent_id'   => 'nullable|integer',
            'project_id'  => 'nullable|integer',
            'owner_id'    => 'nullable|integer'
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
