<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taco extends Model
{
    use HasFactory;

    protected $table = 'tacos';
    protected $primaryKey = 'id_taco';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $fillable = [
        'nom',
        'prix',
        'description',
    ];

    protected $casts = [
        'prix'       => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
