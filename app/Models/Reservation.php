<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'car_id',
        'user_id',
        'agent_id',
        'date_start',
        'date_back',
        'time_start',
        'time_back',
        'agenceBack_id',
        'confiremed',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'car_id' => 'integer',
        'user_id' => 'integer',
        'agent_id' => 'integer',
        'date_start' => 'timestamp',
        'date_back' => 'timestamp',
        'agenceBack_id' => 'integer',
        'confiremed' => 'boolean',
    ];


    public function employe()
    {
        return $this->belongsTo(\App\Models\Employe::class);
    }

    public function car()
    {
        return $this->belongsTo(\App\Models\Car::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function agent()
    {
        return $this->belongsTo(\App\Models\Employe::class);
    }

    public function agenceBack()
    {
        return $this->belongsTo(\App\Models\Agence::class);
    }

    public function extras()
    {
        return $this->belongsToMany(\App\Models\Extra::class);
    }
}
