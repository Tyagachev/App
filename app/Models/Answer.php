<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'answers';

    /**
     * @var string[]
     */
    protected $fillable = [
        'answer',
        'picked',
        'ticket_id',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'updated_at' => 'date:Y-m-d H:i:s',
        'created_at' => 'date:Y-m-d H:i:s',
    ];
}
