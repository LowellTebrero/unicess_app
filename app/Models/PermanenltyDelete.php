<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermanenltyDelete extends Model
{
    use HasFactory;


    public function user()
    {
       return  $this->BelongsTo(User::class);
    }
}
