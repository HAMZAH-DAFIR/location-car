<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Control extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'controller_id',
        'car_id',
        'confirmed',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'controller_id' => 'integer',
        'car_id' => 'integer',
        'confirmed' => 'boolean',
    ];


    public function damages()
    {
        return $this->hasMany(\App\Models\Damage::class);
    }

    public function controller()
    {
        return $this->belongsTo(\App\Models\Employe::class);
    }

    public function car()
    {
        return $this->belongsTo(\App\Models\Car::class);
    }
}
