<?php

namespace App\Models;

use App\Models\Proposal;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class NarrativeReport extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $guarded = [];


    public function proposals():BelongsTo{
        return $this->belongsTo(Proposal::class, 'proposal_id');
    }


    public function medias()
    {
        return $this->morphMany(Media::class, 'model');
    }
}
