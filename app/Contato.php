<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contato extends Model
{
    protected $fillable = ['nome', 'email', 'informacoes'];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
