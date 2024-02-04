<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\TemporaryEvaluationFile;
use Illuminate\Support\Facades\Storage;

class DeleteTemporaryEvaluationFilesController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {

       $fileId = $request->getContent();



       $fileDelete = Str::startsWith($fileId, 'file');

    //    if($fileDelete){

            $chairmanship_wide = TemporaryEvaluationFile::where('chairmanship_wide', $fileId)->first();
            if($chairmanship_wide){
                Storage::deleteDirectory('file/tmp/'. $fileId);
                $chairmanship_wide->delete();
            }

            $chairmanship_unit = TemporaryEvaluationFile::where('chairmanship_unit', $fileId)->first();
            if($chairmanship_unit){
                Storage::deleteDirectory('file/tmp/'. $fileId);
                $chairmanship_unit->delete();
            }

            $membership_wide = TemporaryEvaluationFile::where('membership_wide', $fileId)->first();
            if($membership_wide){
                Storage::deleteDirectory('file/tmp/'. $fileId);
                $membership_wide->delete();
            }

            $membership_unit = TemporaryEvaluationFile::where('membership_unit', $fileId)->first();
            if($membership_unit){
                Storage::deleteDirectory('file/tmp/'. $fileId);
                $membership_unit->delete();
            }

            $advisorships = TemporaryEvaluationFile::where('advisorships', $fileId)->first();
            if($advisorships){
                Storage::deleteDirectory('file/tmp/'. $fileId);
                $advisorships->delete();
            }

            $oics = TemporaryEvaluationFile::where('oics', $fileId)->first();
            if($oics){
                Storage::deleteDirectory('file/tmp/'. $fileId);
                $oics->delete();
            }

            $judges = TemporaryEvaluationFile::where('judges', $fileId)->first();
            if($judges){
                Storage::deleteDirectory('file/tmp/'. $fileId);
                $judges->delete();
            }

            $resource_generation = TemporaryEvaluationFile::where('resource_generation', $fileId)->first();
            if($resource_generation){
                Storage::deleteDirectory('file/tmp/'. $fileId);
                $resource_generation->delete();
            }

            $chairmanship = TemporaryEvaluationFile::where('chairmanship', $fileId)->first();
            if($chairmanship){
                Storage::deleteDirectory('file/tmp/'. $fileId);
                $chairmanship->delete();
            }

            $facilitation_ongoing = TemporaryEvaluationFile::where('facilitation_ongoing', $fileId)->first();
            if($facilitation_ongoing){
                Storage::deleteDirectory('file/tmp/'. $fileId);
                $facilitation_ongoing->delete();
            }

            $facilitation_regional = TemporaryEvaluationFile::where('facilitation_regional', $fileId)->first();
            if($facilitation_regional){
                Storage::deleteDirectory('file/tmp/'. $fileId);
                $facilitation_regional->delete();
            }

            $facilitation_national = TemporaryEvaluationFile::where('facilitation_national', $fileId)->first();
            if($facilitation_national){
                Storage::deleteDirectory('file/tmp/'. $fileId);
                $facilitation_national->delete();
            }

            $facilitation_international = TemporaryEvaluationFile::where('facilitation_international', $fileId)->first();
            if($facilitation_international){
                Storage::deleteDirectory('file/tmp/'. $fileId);
                $facilitation_international->delete();
            }
            $training_director_local = TemporaryEvaluationFile::where('training_director_local', $fileId)->first();
            if($training_director_local){
                Storage::deleteDirectory('file/tmp/'. $fileId);
                $training_director_local->delete();
            }
            $training_director_international = TemporaryEvaluationFile::where('training_director_international', $fileId)->first();
            if($training_director_international){
                Storage::deleteDirectory('file/tmp/'. $fileId);
                $training_director_international->delete();
            }
            $resource_speaker_local = TemporaryEvaluationFile::where('resource_speaker_local', $fileId)->first();
            if($resource_speaker_local){
                Storage::deleteDirectory('file/tmp/'. $fileId);
                $resource_speaker_local->delete();
            }
            $resource_speaker_international = TemporaryEvaluationFile::where('resource_speaker_international', $fileId)->first();
            if($resource_speaker_international){
                Storage::deleteDirectory('file/tmp/'. $fileId);
                $resource_speaker_international->delete();
            }
            $facilitator_moderator_local = TemporaryEvaluationFile::where('facilitator_moderator_local', $fileId)->first();
            if($facilitator_moderator_local){
                Storage::deleteDirectory('file/tmp/'. $fileId);
                $facilitator_moderator_local->delete();
            }
            $facilitator_moderator_international = TemporaryEvaluationFile::where('facilitator_moderator_international', $fileId)->first();
            if($facilitator_moderator_international){
                Storage::deleteDirectory('file/tmp/'. $fileId);
                $facilitator_moderator_international->delete();
            }
            $reactor_panel_member_local = TemporaryEvaluationFile::where('reactor_panel_member_local', $fileId)->first();
            if($reactor_panel_member_local){
                Storage::deleteDirectory('file/tmp/'. $fileId);
                $reactor_panel_member_local->delete();
            }
            $reactor_panel_member_international = TemporaryEvaluationFile::where('reactor_panel_member_international', $fileId)->first();
            if($reactor_panel_member_international){
                Storage::deleteDirectory('file/tmp/'. $fileId);
                $reactor_panel_member_international->delete();
            }
            $technical_assistance = TemporaryEvaluationFile::where('technical_assistance', $fileId)->first();
            if($technical_assistance){
                Storage::deleteDirectory('file/tmp/'. $fileId);
                $technical_assistance->delete();
            }
            $judge_community = TemporaryEvaluationFile::where('judge_community', $fileId)->first();
            if($judge_community){
                Storage::deleteDirectory('file/tmp/'. $fileId);
                $judge_community->delete();
            }
            $commencement_guest_speaker = TemporaryEvaluationFile::where('commencement_guest_speaker', $fileId)->first();
            if($commencement_guest_speaker){
                Storage::deleteDirectory('file/tmp/'. $fileId);
                $commencement_guest_speaker->delete();
            }
            $coordinator_organizer_consultants = TemporaryEvaluationFile::where('coordinator_organizer_consultants', $fileId)->first();
            if($coordinator_organizer_consultants){
                Storage::deleteDirectory('file/tmp/'. $fileId);
                $coordinator_organizer_consultants->delete();
            }
            $facilitator = TemporaryEvaluationFile::where('facilitator', $fileId)->first();
            if($facilitator){
                Storage::deleteDirectory('file/tmp/'. $fileId);
                $facilitator->delete();
            }
            $member = TemporaryEvaluationFile::where('member', $fileId)->first();
            if($member){
                Storage::deleteDirectory('file/tmp/'. $fileId);
                $member->delete();
            }
            $resource_person_lecturer = TemporaryEvaluationFile::where('resource_person_lecturer', $fileId)->first();
            if($resource_person_lecturer){
                Storage::deleteDirectory('file/tmp/'. $fileId);
                $resource_person_lecturer->delete();
            }

    }
}
