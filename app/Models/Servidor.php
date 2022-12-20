<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servidor extends Model
{
    use HasFactory;

    protected $fillable = ['cpf', 'matricula', 'user_id', 'cargo_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function cargo(){
        return $this->belongsTo(Cargo::class);
    }
}
