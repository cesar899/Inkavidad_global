<?php

namespace App\Http\Requests\Orders;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(){
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(){
		return [
      'name' => 'required',
      'last_name' => 'required',
      'dni' => 'required|integer',
      'address' => 'required',
      'phone' => 'required',
      'batch_id' => 'required|exists:batches,id',
      'amount' => 'required|integer',
		];
    }

    public function messages()
    {
		return [
		];
    }

    /**
    * Devolucion de los errores correspondientes
    *
    * @return HttpResponseException
    */

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json($validator->errors()->all(), 422));
    }
}
