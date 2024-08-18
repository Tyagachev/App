<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserVerifiedNumber extends Model
{
    use HasFactory;
    protected $table = 'user_verified_numbers';
    protected $fillable = [
        'uid',
        'number',
        'verified'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
