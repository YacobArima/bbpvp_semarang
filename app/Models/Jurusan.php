<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $fillable = ['name'];

    public function pelatihans()
    {
        return $this->hasMany(Pelatihan::class);
    }

    public function alumni()
    {
        return $this->hasMany(Alumni::class);
    }
}
