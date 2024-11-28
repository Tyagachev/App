<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecoveryPassword extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'recovery_passwords';

    /**
     * @var string[]
     */
    protected $fillable = [
        'email',
        'number'
    ];
}
