<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProposalCreateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'authorize' => 'required',
            'office_order' => 'mimes:jpg,png,jpeg', 'max:5048', 'nullable',
            'travel_order' => 'mimes:jpg,png,jpeg', 'max:5048' , 'nullable',
        ];
    }
}
