<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Co_UserModel extends Model
{
    use HasFactory;
    protected $fillable=['permission','user_id'];

    protected $hidden=[
        'permission',
        'user_id',
    ];
}
