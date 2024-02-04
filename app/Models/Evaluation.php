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


class Evaluation extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use Notifiable;
    use SoftDeletes;



    protected $fillable = [

        'user_id',
        'faculty_id',
        'period_of_evaluation',
        'chairmanship_university',
        'chairmanship_college',
        'membership_university',
        'membership_college',
        'advisorship',
        'oic',
        'judge',
        'resource',
        'chairmanship_membership',
        'facilication_on_going',
        'facilication_regional',
        'facilication_national',
        'facilication_international',
        'training_director_local',
        'training_director_international',
        'resource_speaker_local',
        'resource_speaker_international',
        'facilitator_moderator_local',
        'facilitator_moderator_international',
        'reactor_panel_member_local',
        'reactor_panel_member_international',
        'technical_assistance',
        'judge_community',
        'commencement_guest_speaker',
        'coordinator_organizer_consultants',
        'resource_person_lecturer',
        'facilitator',
        'member',
        'name_of_faculty',
        'university_wide',

    ];


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
}
