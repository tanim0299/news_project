<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class current_image extends Model
{
    use HasFactory;

    protected $table = 'current_image';

    protected $guarded = [];
}
