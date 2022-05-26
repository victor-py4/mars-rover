<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rover extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'position',
        'reports',
        'instructions'
    ];

    public $timestamps = true;
    protected $table = 'rovers';

    protected $casts = [
      'position' => 'array',
      'reports' => 'array',
      'instructions' => 'array'
    ];
}
