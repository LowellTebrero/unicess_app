<?php

namespace App\Models;

use App\Models\User;
use App\Models\Faculty;
use App\Models\EvaluationFile;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;


class Evaluation extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use Notifiable;
    use SoftDeletes;



    protected $guarded = [];


    public function users():BelongsTo{
        return $this->belongsTo(User::class, 'user_id');
    }

    public function faculties(){
        return $this->hasMany(Faculty::class);
    }

    public function medias()
    {
        return $this->morphMany(Media::class, 'model');
    }

    public function evaluationfile(){
        return $this->hasMany(EvaluationFile::class);
    }

    public function scopeSearch($query, $search)
    {
            $search = "%$search%";
     return $query->where(function($query) use ($search) {
        $query->whereHas('users', function($query) use ($search) {
            $query->where('name', 'like', $search)
            ->orWhere('first_name', 'like', $search)
            ->orWhere('last_name', 'like', $search)
            ->orWhere('email', 'like', $search)
            ->orWhere('colleges', 'like', $search)

            ->orWhereHas('faculty', function($query) use ($search){
                $query->where('name', 'like',   $search);
            })
            ->orWhereHas('roles', function($query) use ($search){
                $query->where('name', 'like',   $search);
            });

        });
    });
}
}