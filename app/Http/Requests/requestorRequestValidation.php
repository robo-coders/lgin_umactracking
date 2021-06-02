<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class requestorRequestValidation extends FormRequest
{
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'machine_description' => 'required',
            'brp' => 'required|int|digits_between:1,10',
            'cost_center_line' => 'required',
            'supervisor_name' => 'required',
            'description_of_problem' => 'required',
            'priority_level' => 'required',
        ];
    }
}
