<?php

namespace App\Models;

use App\Models\Proposal;
use App\Models\ProposalMember;
use App\Models\ProposalRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CesoRole extends Model
{
    use HasFactory;

    protected $fillable = ['role_name'];


    public function proposal(){
        return $this->hasMany(Proposal::class);
    }

    public function proposal_member(){
        return $this->hasMany(ProposalMember::class);
    }

    public function proposal_request(){
        return $this->hasMany(ProposalRequest::class);
    }
}
