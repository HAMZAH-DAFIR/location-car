<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Extrareservation extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'extra_id',
        'reservation_id',
        'quantite',
        'totalPrice',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'extra_id' => 'integer',
        'reservation_id' => 'integer',
        'totalPrice' => 'float',
    ];


    public function extra()
    {
        return $this->belongsTo(\App\Models\Extra::class);
    }

    public function reservation()
    {
        return $this->belongsTo(\App\Models\Reservation::class);
    }
}
