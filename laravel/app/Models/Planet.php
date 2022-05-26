<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planet extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'bounding_box',
        'obstacles',
    ];

    public $timestamps = true;
    protected $table = 'planet';

    protected $casts = [
      'position' => 'bounding_box',
      'reports' => 'obstacles',
    ];
}
