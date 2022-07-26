<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class news_categorey extends Model
{
    protected $table = 'news_categorey';

    protected $fillable = ['sl','cat_name','status','admin_id'];
}
