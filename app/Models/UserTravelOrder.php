<?php

namespace App\Models;

use App\Models\User;
use App\Models\Proposal;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class UserTravelOrder extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use Notifiable;

    protected $guarded = [];

    public function proposals(){
        return $this->belongsTo(Proposal::class, 'proposal_id');
    }

    public function medias()
    {
        return $this->morphMany(Media::class, 'model');
    }

    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
