<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Jurusan;

class Alumni extends Model
{
    protected $table = 'alumni';

    protected $fillable = [
        'user_id',
        'jurusan_id',
        'pelatihan_id',
        'graduation_year',
        'employment_status',
        'address',
        'phone_number',
        'company_name',
        'position',
        'description',
        'photo_path',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function pelatihan()
    {
        return $this->belongsTo(Pelatihan::class);
    }
}
