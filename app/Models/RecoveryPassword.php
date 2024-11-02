<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecoveryPassword extends Model
{
    use HasFactory;

    protected $table = 'recovery_passwords';
    protected $fillable = [
        'email',
        'number'
    ];
}
