<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class news_menu extends Model
{
    protected $table = 'news_menu';

    protected $fillable = ['sl','link_name','status','admin_id'];
}
