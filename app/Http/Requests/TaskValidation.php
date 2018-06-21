<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskValidation extends FormRequest
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
          'deviceId' => 'required',
          'latitude' => 'required',
          'longitude' => 'required',
          'type' => 'required',
        ];
    }

    public function messages()
    {
      return[
        'deviceId.required' => 'Please enter valid device ID.',
        'latitude.required' => 'Please enter your coordinates.',
        'longitude.required' => 'Please enter your coordinates.',
        'type.required' => 'Please select one of the following options.',
      ];

    }
}
