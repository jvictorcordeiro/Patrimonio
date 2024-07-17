<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    use HasFactory;

    protected $fillable = ['nome'];

    public function users() {
        return $this->belongsToMany(User::class, 'cargo_user', 'cargo_id', 'user_id');
    }
}
