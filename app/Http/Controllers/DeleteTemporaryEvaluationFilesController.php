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

    }
}
