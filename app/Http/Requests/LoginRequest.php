<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
//para verificar se está bloqueado
use App\Rules\Block;
//para verificar se está com muito tempo de inatividade
use App\Rules\IntervaloDias;
class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'rg' => ['required', 'numeric', 'exists:users', new Block, new IntervaloDias],
            'password'=>'required',
        ];
    }
}
