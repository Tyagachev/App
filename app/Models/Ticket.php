<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Ticket extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'tickets';
    /**
     * @var bool
     */
    protected $guarded = false;

    /**
     * @return HasMany
     */
    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class, 'ticket_id', 'id');
    }

    /**
     * @return HasOne
     */
    public function hint(): HasOne
    {
        return $this->hasOne(Hint::class);
    }

    /**
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(Ticket::class);
    }

}
