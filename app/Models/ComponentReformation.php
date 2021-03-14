<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ComponentReformation extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'reformation_id',
        'component_id',
        'quantity',
        'priceTotal',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'reformation_id' => 'integer',
        'component_id' => 'integer',
        'priceTotal' => 'float',
    ];


    public function reformation()
    {
        return $this->belongsTo(\App\Models\Reformation::class);
    }

    public function component()
    {
        return $this->belongsTo(\App\Models\Component::class);
    }
}
