<?php

namespace App\Models;

use App\Models\Location;
use Spatie\Tags\HasTags;
use App\Models\ProposalMember;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Proposal extends Model implements HasMedia
{
    use HasFactory;
    use hasTags;
    use InteractsWithMedia;
    use Notifiable;

    protected $guarded = [];

    public function programs():BelongsTo
    {

       return  $this->belongsTo(Program::class, 'program_id');
    }

   public function user():BelongsTo
    {
       return  $this->belongsTo(User::class );
    }

    public function users(){
        return $this->belongsToMany(User::class, 'proposal_members', )->withPivot('created_at', 'proposal_id', 'leader_member_type' , 'member_type')->withTimestamps();
    }

    public function projectLeader(){
        return $this->belongsTo(User::class, 'project_leader');
    }

    public function ceso():BelongsTo{
        return $this->belongsTo(CesoRole::class, 'ceso_role_id');
    }

    public function proposal_members(){
        return $this->hasMany(ProposalMember::class );
    }


    public function medias()
    {
        return $this->morphMany(Media::class, 'model');
    }

    public function locations():BelongsTo{
        return $this->belongsTo(Location::class, 'location_id');
    }
}


