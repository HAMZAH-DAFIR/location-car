<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'model',
        'carNumber',
        'horse',
        'kilometers',
        'dor',
        'fuel',
        'type',
        'luggage',
        'status',
        'category_id',
        'agence_id',
        'in_agaence',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'category_id' => 'integer',
        'agence_id' => 'integer',
        'in_agaence' => 'boolean',
    ];


    public function agence()
    {
        return $this->belongsTo(\App\Models\Agence::class);
    }

    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class);
    }





    public function users()
    {
        return $this->belongsToMany(\App\Models\User::class);
    }
}
