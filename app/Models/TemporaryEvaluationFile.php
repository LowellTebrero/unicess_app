<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemporaryEvaluationFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'chairmanship_wide',
        'chairmanship_wide_file',
        'chairmanship_unit',
        'chairmanship_unit_file',
        'membership_wide',
        'membership_wide_file',
        'membership_unit',
        'membership_unit_file',
        'advisorships',
        'advisorships_file',
        'oics',
        'oics_file',
        'judges',
        'judges_file',
        'resource_generation',
        'resource_generation_file',
        'chairmanship',
        'chairmanship_file',
        'facilitation_ongoing',
        'facilitation_ongoing_file',
        'facilitation_regional',
        'facilitation_regional_file',
        'facilitation_national',
        'facilitation_national_file',
        'facilitation_international',
        'facilitation_international_file',
        'training_director_local',
        'training_director_local_file',
        'training_director_international',
        'training_director_international_file',
        'resource_speaker_local',
        'resource_speaker_local_file',
        'resource_speaker_international',
        'resource_speaker_international_file',
        'facilitator_moderator_local',
        'facilitator_moderator_local_file',
        'facilitator_moderator_international',
        'facilitator_moderator_international_file',
        'reactor_panel_member_local',
        'reactor_panel_member_local_file',
        'reactor_panel_member_international',
        'reactor_panel_member_international_file',
        'technical_assistance',
        'technical_assistance_file',
        'judge_community',
        'judge_community_file',
        'commencement_guest_speaker',
        'commencement_guest_speaker_file',
        'coordinator_organizer_consultants',
        'coordinator_organizer_consultants_file',
        'facilitator',
        'facilitator_file',
        'member',
        'member_file',
        'resource_person_lecturer',
        'resource_person_lecturer_file',
    ];



    public function user(){
        return $this->belongsTo(User::class );
    }
}
