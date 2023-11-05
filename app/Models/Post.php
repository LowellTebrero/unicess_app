<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory , HasRoles;

    protected $fillable = ['title', 'description' , 'user_id'];

    public function user(){

        return $this->belongsTo(User::class);
    }
}
