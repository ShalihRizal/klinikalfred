<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';

    protected $fillable = ['user_id', 'news_category_id', 'news_title', 'news_image', 'news_description', 'created_at', 'updated_at'];
}
