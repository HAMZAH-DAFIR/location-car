<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reformation extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mechanic_id',
        'damage_id',
        'description',
        'totalprice',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'mechanic_id' => 'integer',
        'damage_id' => 'integer',
        'totalprice' => 'float',
    ];


    public function components()
    {
        return $this->belongsToMany(\App\Models\Component::class);
    }

    public function mechanic()
    {
        return $this->belongsTo(\App\Models\Employe::class);
    }

    public function damage()
    {
        return $this->belongsTo(\App\Models\Damage::class);
    }
}
