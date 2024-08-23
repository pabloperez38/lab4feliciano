<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Users;
use App\Models\Perfiles;

class UsersMetadata extends Model
{
    use HasFactory;
    public function users()
    {
        return $this->belongsTo(User::class);
    }
    public function perfiles()
    {
        return $this->belongsTo(Perfiles::class);
    }
}