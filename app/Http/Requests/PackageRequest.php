<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Package;

class PackageRequest extends FormRequest
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
            'name' => 'required|max:60',
            'type' => [
                'required',
                Rule::in([
                    Package::TYPE_IN,
                    Package::TYPE_OUT,
                    Package::TYPE_LEND,
                    Package::TYPE_INVEST,
                ]),
            ]
        ];
    }
}