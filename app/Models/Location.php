<?php

namespace App\Models;

use App\Models\Proposal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Location extends Model
{
    use HasFactory;

    protected $fillable = ['location_name'];

    public function proposal(){
        return $this->hasMany(Proposal::class, 'location_id');
    }
}
