<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employe extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'role',
        'birthday',
        'cni',
        'agence_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'birthday' => 'timestamp',
        'agence_id' => 'integer',
    ];


    public function agence()
    {
        return $this->belongsTo(\App\Models\Agence::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }




    public function cars()
    {
        return $this->belongsToMany(\App\Models\Car::class);
    }
}
