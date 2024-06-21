<?php

namespace App\Http\Requests\Subgrupo;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class StoreSubgrupoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nome' => 'required|string|max:255',
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'classificacao_id' => 'required|exists:classificacoes,id',
        ];
    }

    public function messages()
    {
        return [
            'nome.required'     =>  'O campo nome é obrigatório',
            'marca.required'    =>  'O campo marca é obrigatório',
            'modelo.required'   =>  'O campo modelo é obrigatório',
            'classificacao_id'  =>  'O campo classificação é obrigatório',
        ];
    }

}
