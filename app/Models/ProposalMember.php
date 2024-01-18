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

    protected $fillable = ['proposal_id', 'user_id', 'leader_member_type' , 'member_type', 'location_id'];



    public function proposal(){
        return $this->belongsTo(Proposal::class);
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function participation_names(){
        return $this->belongsTo(ParticipationName::class);
    }

    public function ceso_role(){
        return $this->belongsTo(CesoRole::class, 'leader_member_type');
    }

    public function locations():BelongsTo{
        return $this->belongsTo(Location::class, 'location_id');
    }

}
