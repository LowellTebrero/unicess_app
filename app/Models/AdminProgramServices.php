<?php

namespace App\Models;

use App\Models\Proposal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdminProgramServices extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function proposals(){
        return $this->belongsTo(Proposal::class);
    }
}
