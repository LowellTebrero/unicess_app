<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProposalMember extends Model
{
    use HasFactory;
    use Notifiable;

    protected $fillable = ['proposal_id', 'user_id',];

    public function proposal(){
        return $this->belongsTo(Proposal::class);
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

}
