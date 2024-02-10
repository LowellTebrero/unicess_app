<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TrashedRecord extends Model
{
    use HasFactory;


    public function user()
    {
       return  $this->BelongsTo(User::class);
    }

}
