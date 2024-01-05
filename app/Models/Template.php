<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Template extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = ['template_name' ];


    public function programs():BelongsTo
    {

       return  $this->belongsTo(Program::class, 'program_id');
    }

   public function users():BelongsTo
    {
       return  $this->belongsTo(User::class, 'user_id');
    }

    public function faculty()
    {
       return $this->belongsTo(Faculty::class, 'faculty_id');
    }

    public function medias()
    {
        return $this->morphMany(Media::class, 'model');
    }

}
