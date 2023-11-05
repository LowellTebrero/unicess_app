<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $fillable = ['program_name'];

    public function projectproposal(){

        return $this->belongsTo(ProjectProposal::class, 'program_id');
    }
    public function proposalproject(){

        return $this->belongsTo(ProposalProject::class, 'program_id');
    }
}
