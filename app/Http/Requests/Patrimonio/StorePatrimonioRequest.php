<?php

namespace App\Http\Requests\Patrimonio;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class StorePatrimonioRequest extends FormRequest
{
    public function rules()
    {
        return [
            'nome' => 'required|string|max:255',
            'nota_fiscal' => 'required_if:origem_id,==,4|string|max:255',
            'descricao' => 'required|string',
            'observacao' => 'nullable|string|max:255',
            'data_compra' => 'required_if:origem_id,==,4|date',
            'data_incorporação' => 'required|date',
            'valor' => 'required|numeric',
            'empenho' => 'required_if:origem_id,==,4|sometimes|string',
            'conta_contabil' => 'required|string',
            'user_id' => 'required|integer|exists:users,id',
            'unidade_admin_id' => 'required|integer|exists:unidades_administrativas,id',
            'subgrupo_id' => 'required|integer|exists:subgrupos,id',
            'origem_id' => 'required|integer|exists:origens,id',
            'sala_id' => 'required|integer|exists:salas,id',
            'situacao_id' => 'required|integer|exists:situacoes,id',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();
        
        return redirect()->back()->withErrors($errors)->withInput();
    }
}
