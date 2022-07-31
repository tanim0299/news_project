<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class website_settings extends Model
{
    use HasFactory;

    protected $table = 'website_settings';

    protected $guarded = [];
}
