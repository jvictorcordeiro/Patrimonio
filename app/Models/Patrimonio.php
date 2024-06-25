<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patrimonio extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = ['nome', 'nota_fiscal', 'aprovado', 'descricao', 'user_id', 'unidade_admin_id', 'classificacao_id', 'origem_id', 'sala_id', 'situacao_id', 'data_compra', 'data_incorporação', 'valor', 'observacao', 'subgrupo_id', 'empenho', 'conta_contabil'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subgrupo()
    {
        return $this->belongsTo(Subgrupo::class);
    }

    public function origem()
    {
        return $this->belongsTo(Origem::class);
    }

    public function sala()
    {
        return $this->belongsTo(Sala::class);
    }

    public function situacao()
    {
        return $this->belongsTo(Situacao::class);
    }

    public function codigos()
    {
        return $this->hasMany(Codigo::class);
    }

    public function unidade()
    {
        return $this->belongsTo(UnidadeAdministrativa::class, 'unidade_admin_id');
    }

    public function movimentos()
    {
        return $this->belongsToMany(Movimento::class, 'movimento_patrimonio', 'patrimonio_id', 'movimento_id');
    }
}
