<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimento extends Model
{
    use HasFactory;

    protected $fillable = ['observacao', 'status' ,'user_destino_id', 'user_origem_id', 'tipo_movimento_id', 'data_movimento'];

    public function userDestino()
{
    return $this->belongsTo(User::class, 'user_destino_id');
}


    public function userOrigem()
    {
        return $this->belongsTo(User::class, 'user_origem_id');
    }
    

    public function itens_movimento()
    {
        return $this->belongsToMany(Patrimonio::class, 'movimento_patrimonios', 'movimento_id')
            ->withPivot('id');
    }


    public function tipo_movimento(){
        return $this->belongsTo(TipoMovimento::class);
    }
}
