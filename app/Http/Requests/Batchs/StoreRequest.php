<?php

namespace App\Http\Requests\Batchs;

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
			'name' => "required",
			'project_id' => "required",
			'group_id' => "required",
			'mts_north' => "required|string",
			'mts_south' => "required|string",
			'mts_est' => "required|string",
			'mts_west' => "required|string",

			'adjoins_north' => "required|string",
			'adjoins_south' => "required|string",
			'adjoins_est' => "required|string",
			'adjoins_west' => "required|string",

			'amount' => "required|string",
			'amount_owed' => "required|string",
			// 'status' => "required|integer",
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
