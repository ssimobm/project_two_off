<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class validateLogin extends FormRequest
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
    public function wantsJson() {
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

              'email' => 'required|email|max:255|exists:users,email',



            //  'user' => 'required|min:4|max:14|unique:users,username,'.auth()->user()->id.',id',
            //  'namefirst' => 'required|min:4|max:15',
         ];
     }


     //  public function messages()
     //  {
     //      return [
     // //
     // //       //  'namefirst.required' => 'simoo is required',
     // //         //'namefirst.min' => 'simoo must be max 255 length',
     // //       //  'namefirst.max' => 'simoo must be max 10',
     //  'email.required' => 'email is required',
     //  'email.exists' => 'email is exists',
     // //         // 'email.min' => 'email must be max 255 length',
     // //         // 'email.max' => 'email must be max 10'
     // //
     //      ];
     //  }

     public function validate() {
        $instance = $this->getValidatorInstance();
        if ($instance->fails()) {
            throw new HttpResponseException(response()->json($instance->errors(), 422));
        }
    }
}
