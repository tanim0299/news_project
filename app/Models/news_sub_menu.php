<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class news_sub_menu extends Model
{
    protected $table = 'news_sub_menu';

    protected $fillable = ['sl','news_menuid','news_submenu_name','status','admin_id'];
}
