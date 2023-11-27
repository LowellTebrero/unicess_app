<?php

namespace App\Models;

use App\Models\User;
use App\Models\Proposal;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProposalRequest extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $guarded = [];

    public function medias()
    {
        return $this->morphMany(Media::class, 'model');
    }

    public function proposal(){
        return $this->belongsTo(Proposal::class);
    }

    public function user():BelongsTo
    {
       return  $this->belongsTo(User::class );
    }

    public function ceso():BelongsTo{
        return $this->belongsTo(CesoRole::class, 'leader_member_type');
    }

    public function location():BelongsTo{
        return $this->belongsTo(Location::class, 'leader_location');
    }

    public function participation():BelongsTo{
        return $this->belongsTo(ParticipationName::class, 'member_type');
    }

}
