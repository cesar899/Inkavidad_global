<?php

namespace App\Http\Requests\Groups;

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
			'name' => "required|string",
      'project_id' => "required|integer",
			'status' => "required|integer",
		];
    }

    public function messages()
    {
		return [
			'name.required' => 'El nombre es requerido',
      'project_id.required' => "El proyecto es requerido",
			'status.required' => 'El plan es requerido',
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
