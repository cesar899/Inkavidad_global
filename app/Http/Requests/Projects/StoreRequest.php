<?php

namespace App\Http\Requests\Projects;

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
			'featured_image' => "required",
			'plan' => "required|string",
      'group_quantity' => "required|integer",
			'status' => "required|integer",
		];
    }

    public function messages()
    {
		return [
			'name.required' => 'El nombre es requerido',
			'featured_image.required' => 'La imagen es requerida',
      'group_quantity.required' => "La cantidad de grupos es requerida",
			'plan.required' => 'El plan es requerido',
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
