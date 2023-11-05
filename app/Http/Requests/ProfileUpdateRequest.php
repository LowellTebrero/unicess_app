<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [

            // 'role' => ['required'],
            // 'faculty_id' => Rule::requiredIf(function ()  {
            //     return in_array(request()->role,['Faculty extensionist','Extension coordinator','nullable']);
            // }),
            'first_name' => ['string', 'max:255', 'required'],
            'last_name' => ['string', 'max:255' , 'required'],
            'middle_name' => ['string', 'max:255' , 'required'],
            'suffix' => ['string', 'max:255' ,'nullable'],
            'recipient_name' => ['required', 'string', 'alpha_num', 'max:255'],
            'name' => ['string', 'max:255'],
            'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'gender' => ['required', 'string', 'max:255'],
            'birth_date' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'contact_number' => ['required', 'string', 'max:255'],
            'province' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'barangay' => ['required', 'string', 'max:255'],
            'zipcode' => ['required', 'string', 'max:255'],
        ];
    }
}
