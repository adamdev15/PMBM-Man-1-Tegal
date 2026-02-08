<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Casis extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'casis';
    protected $guarded = ['id'];

    public function nilaiRapor()
    {
        return $this->hasMany(NilaiRapor::class , 'casis_id');
    }

    public function berkas()
    {
        return $this->hasMany(CasisBerkas::class , 'casis_id');
    }
}