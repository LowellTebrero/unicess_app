<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminProposalProject extends Model
{
    use HasFactory;

    protected $fillable = ['proposal_file', 'moa_file', 'involve_name',
                           'office_order', 'travel_order', 'other_file'];
}
