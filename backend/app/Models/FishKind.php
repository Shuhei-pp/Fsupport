<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FishKind extends Model
{
    //タイムスタンプ無効
    public $timestamps = false;

    use HasFactory;
}
