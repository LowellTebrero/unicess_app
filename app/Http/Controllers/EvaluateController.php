<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\AdminYear;
use App\Models\Evaluation;
use Illuminate\Http\Request;
use App\Models\EvaluationFile;
use App\Models\ProposalMember;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\EvaluationStatus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\TemporaryEvaluationFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class EvaluateController extends Controller
{
    public function index(){

        $currentYear = date('Y');
        $previousYear = $currentYear + 1;
        $evaluation = Evaluation::where('user_id', Auth()->user()->id)->whereYear('created_at', '>=', $currentYear)->whereYear('created_at', '<=', $previousYear)->get();
        $evaluation_status = Evaluation::select(DB::raw('YEAR(created_at) year') , 'status', 'id')->where('user_id', auth()->user()->id)->get();
        $status = EvaluationStatus::select('status')->get();
        $proposal_member = ProposalMember::where('user_id', auth()->user()->id)->with('proposal')->get();
        $latestYear = ProposalMember::select(DB::raw('MAX(YEAR(created_at)) as max_year'))->where('user_id', auth()->user()->id)->value('max_year');
        $latesEvaluationtYear = Evaluation::select(DB::raw('MAX(YEAR(created_at)) as max_year'))->where('user_id', auth()->user()->id)->value('max_year');
        $result = Evaluation::select('status', DB::raw('MAX(YEAR(created_at)) as max_year'))->groupBy('status')->where('user_id', auth()->user()->id)->get();
        $latestYearAndId = Evaluation::select(DB::raw('YEAR(created_at) as year'),DB::raw('MAX(id) as id'))->groupBy('year')->orderByDesc('year')->where('user_id', auth()->user()->id)->first();
        $id = Auth()->user()->id;
        $years = AdminYear::orderBy('year', 'DESC')->pluck('year');

        return view('user.evaluate.index',
        compact('latestYearAndId','id','result',
        'currentYear', 'previousYear', 'evaluation_status', 'status',
        'proposal_member', 'latestYear', 'latesEvaluationtYear' , 'evaluation', 'years'));
    }


    public function EvaluateFilterIndex(Request $request){

        $selectedYear = $request->input('year');
        $currentYear = date('Y');
        $previousYear = $currentYear + 1;
        [$startYear, $endYear] = explode('-', $selectedYear);
        $currentYear = $startYear;
        $previousYear = $endYear;

        $proposal_member = ProposalMember::where('user_id', auth()->user()->id)->with('proposal')
        ->whereYear('created_at', '>=', $startYear)
        ->whereYear('created_at', '<=', $endYear)
        ->get();

        $evaluation_status = Evaluation::select(DB::raw('YEAR(created_at) year') , 'status' , 'id')->where('user_id', auth()->user()->id)
        ->whereYear('created_at', '>=', $startYear)
        ->whereYear('created_at', '<=', $endYear)
        ->get();


        $status = EvaluationStatus::select('status')->get();
        $latestYear = ProposalMember::select(DB::raw('MAX(YEAR(created_at)) as max_year'))->where('user_id', auth()->user()->id)->value('max_year');
        $result = Evaluation::select('status', DB::raw('MAX(YEAR(created_at)) as max_year'))->groupBy('status')->get();
        $latesEvaluationtYear = Evaluation::select(DB::raw('MAX(YEAR(created_at)) as max_year'))->where('user_id', auth()->user()->id)->value('max_year');
        $latestYearAndId = Evaluation::select(DB::raw('YEAR(created_at) as year'), DB::raw('MAX(id) as id'))->groupBy('year')->orderByDesc('year')->first();

        return view('user.evaluate.index', compact('latestYearAndId','latesEvaluationtYear','result','currentYear', 'previousYear', 'evaluation_status', 'status', 'proposal_member', 'latestYear'));


    }

    public function create(Request $request, $id){

        $currentYear = date('Y');
        $previousYear = $currentYear + 1;
        $user = User::where('id', $id)->first();

        $selectedYear = $request->yearGetter;

        [$startYear, $endYear] = explode('-', $selectedYear);

        $proposals = ProposalMember::where('user_id', auth()->user()->id)->whereYear('created_at', '>=', $startYear)->whereYear('created_at', '<=', $endYear)->get();

        $status = EvaluationStatus::select('status')->get();
        $proposal_member = ProposalMember::where('user_id', auth()->user()->id)->with('proposal')->get();

        $result2 = ProposalMember::where('user_id', auth()->user()->id)
        ->select('location_id','leader_member_type', 'member_type')
        ->groupBy('user_id', 'location_id', 'leader_member_type', 'member_type')
        ->whereYear('created_at', '>=', $startYear)
        ->whereYear('created_at', '<=', $endYear)
        ->orderBy('member_type', 'asc')
        ->get();

        $temporary = TemporaryEvaluationFile::where('user_id', $id)->get();
        return view('user.evaluate.create', compact(
        'user', 'startYear', 'endYear',
        'proposals', 'result2', 'status',
        'proposal_member' , 'currentYear', 'previousYear', 'temporary'));
    }


    public function post(Request $request){

        $total = $request->input('chairmanship_university') + $request->input('chairmanship_college') + $request->input('membership_university') + $request->input('membership_college') + $request->input('advisorship')
        + $request->input('oic') + $request->input('judge') + $request->input('resource') + $request->input('chairmanship_membership') + $request->input('facilication_on_going') + $request->input('facilication_regional')
        + $request->input('facilication_national') +  $request->input('facilication_international') +  $request->input('training_director_local')  + $request->input('training_director_international')
        + $request->input('resource_speaker_local') + $request->input('resource_speaker_international') + $request->input('facilitator_moderator_local')
        + $request->input('facilitator_moderator_international') + $request->input('reactor_panel_member_local') + $request->input('reactor_panel_member_international') + $request->input('technical_assistance')
        + $request->input('judge_community') + $request->input('commencement_guest_speaker') +  $request->input('coordinator_organizer_consultants') + $request->input('resource_person_lecturer')
        + $request->input('facilitator') + $request->input('member');


        $evaluate = new Evaluation();
            $evaluate->faculty_id = $request->faculty_id;
            $evaluate->period_of_evaluation = $request->period_of_evaluation;
            $evaluate->chairmanship_university = $request->chairmanship_university;
            $evaluate->chairmanship_college = $request->chairmanship_college;
            $evaluate->membership_university = $request->membership_university;
            $evaluate->membership_college = $request->membership_college;
            $evaluate->advisorship = $request->advisorship;
            $evaluate->oic = $request->oic;
            $evaluate->judge = $request->judge;
            $evaluate->resource = $request->resource;
            $evaluate->chairmanship_membership = $request->chairmanship_membership;
            $evaluate->facilication_on_going = $request->facilication_on_going;
            $evaluate->facilication_regional = $request->facilication_regional;
            $evaluate->facilication_national = $request->facilication_national;
            $evaluate->facilication_international = $request->facilication_international;
            $evaluate->training_director_local = $request->training_director_local;
            $evaluate->training_director_international = $request->training_director_international;
            $evaluate->resource_speaker_local = $request->resource_speaker_local;
            $evaluate->resource_speaker_international = $request->resource_speaker_international;
            $evaluate->facilitator_moderator_local = $request->facilitator_moderator_local;
            $evaluate->facilitator_moderator_international = $request->facilitator_moderator_international;
            $evaluate->reactor_panel_member_local = $request->reactor_panel_member_local;
            $evaluate->reactor_panel_member_international = $request->reactor_panel_member_international;
            $evaluate->technical_assistance = $request->technical_assistance;
            $evaluate->judge_community = $request->judge_community;
            $evaluate->commencement_guest_speaker = $request->commencement_guest_speaker;
            $evaluate->coordinator_organizer_consultants = $request->coordinator_organizer_consultants;
            $evaluate->resource_person_lecturer = $request->resource_person_lecturer;
            $evaluate->facilitator = $request->facilitator;
            $evaluate->member = $request->member;
            $evaluate->name_of_faculty = $request->name_of_faculty;
            $evaluate->total_points = $total;
            $evaluate->user_id  = auth()->id();
        $evaluate->save();

        if ($request->has('chairmanship_wide')){
            foreach ($request['chairmanship_wide'] as $file){

            $tmpfile = TemporaryEvaluationFile::where('chairmanship_wide', $file)->first();
            Storage::copy('file/tmp/'. $tmpfile->chairmanship_wide. '/' . $tmpfile->chairmanship_wide_file, 'file/'. $tmpfile->chairmanship_wide. '/'. $tmpfile->chairmanship_wide_file);
            EvaluationFile::create([
                'evaluation_id' => $evaluate->id,
                'chairmanship_wide' => $tmpfile->chairmanship_wide_file,
                'path' => $tmpfile->chairmanship_wide. '/'. $tmpfile->chairmanship_wide_file
            ]);

            Storage::deleteDirectory(('file/tmp/'). $tmpfile->chairmanship_wide);
            $tmpfile->delete();
            }
        }

        if ($request->has('chairmanship_unit')){
            foreach ($request['chairmanship_unit'] as $file){
                $tmpfile = TemporaryEvaluationFile::where('chairmanship_unit', $file)->first();
                Storage::copy('file/tmp/'. $tmpfile->chairmanship_unit. '/' . $tmpfile->chairmanship_unit_file, 'file/'. $tmpfile->chairmanship_unit. '/'. $tmpfile->chairmanship_unit_file);
                EvaluationFile::create([
                    'evaluation_id' => $evaluate->id,
                    'chairmanship_unit' => $tmpfile->chairmanship_unit_file,
                    'path' => $tmpfile->chairmanship_unit. '/'. $tmpfile->chairmanship_unit_file
                ]);

                Storage::deleteDirectory(('file/tmp/'). $tmpfile->chairmanship_unit);
                $tmpfile->delete();
            }
        }

        if ($request->has('membership_wide')){
            foreach ($request['membership_wide'] as $file){
                $tmpfile = TemporaryEvaluationFile::where('membership_wide', $file)->first();
                Storage::copy('file/tmp/'. $tmpfile->membership_wide. '/' . $tmpfile->membership_wide_file, 'file/'. $tmpfile->membership_wide. '/'. $tmpfile->membership_wide_file);
                EvaluationFile::create([
                    'evaluation_id' => $evaluate->id,
                    'membership_wide' => $tmpfile->membership_wide_file,
                    'path' => $tmpfile->membership_wide. '/'. $tmpfile->membership_wide_file
                ]);
                Storage::deleteDirectory(('file/tmp/'). $tmpfile->membership_wide);
                $tmpfile->delete();
            }
        }

        if ($request->has('membership_unit')){
            foreach ($request['membership_unit'] as $file){
                $tmpfile = TemporaryEvaluationFile::where('membership_unit', $file)->first();
                Storage::copy('file/tmp/'. $tmpfile->membership_unit. '/' . $tmpfile->membership_unit_file, 'file/'. $tmpfile->membership_unit. '/'. $tmpfile->membership_unit_file);
                EvaluationFile::create([
                    'evaluation_id' => $evaluate->id,
                    'membership_unit' => $tmpfile->membership_unit_file,
                    'path' => $tmpfile->membership_unit. '/'. $tmpfile->membership_unit_file
                ]);
                Storage::deleteDirectory(('file/tmp/'). $tmpfile->membership_unit);
                $tmpfile->delete();
            }
        }

        if ($request->has('advisorships')){
            foreach ($request['advisorships'] as $file){
                $tmpfile = TemporaryEvaluationFile::where('advisorships', $file)->first();
                Storage::copy('file/tmp/'. $tmpfile->advisorships. '/' . $tmpfile->advisorships_file, 'file/'. $tmpfile->advisorships. '/'. $tmpfile->advisorships_file);
                EvaluationFile::create([
                    'evaluation_id' => $evaluate->id,
                    'advisorships' => $tmpfile->advisorships_file,
                    'path' => $tmpfile->advisorships. '/'. $tmpfile->advisorships_file
                ]);
                Storage::deleteDirectory(('file/tmp/'). $tmpfile->advisorships);
                $tmpfile->delete();
            }
        }

        if ($request->has('oics')){
            foreach ($request['oics'] as $file){
                $tmpfile = TemporaryEvaluationFile::where('oics', $file)->first();
                Storage::copy('file/tmp/'. $tmpfile->oics. '/' . $tmpfile->oics_file, 'file/'. $tmpfile->oics. '/'. $tmpfile->oics_file);
                EvaluationFile::create([
                    'evaluation_id' => $evaluate->id,
                    'oics' => $tmpfile->oics_file,
                    'path' => $tmpfile->oics. '/'. $tmpfile->oics_file
                ]);
                Storage::deleteDirectory(('file/tmp/'). $tmpfile->oics);
                $tmpfile->delete();
            }
        }

        if ($request->has('judges')){
            foreach ($request['judges'] as $file){
                $tmpfile = TemporaryEvaluationFile::where('judges', $file)->first();
                Storage::copy('file/tmp/'. $tmpfile->judges. '/' . $tmpfile->judges_file, 'file/'. $tmpfile->judges. '/'. $tmpfile->judges_file);
                EvaluationFile::create([
                    'evaluation_id' => $evaluate->id,
                    'judges' => $tmpfile->judges_file,
                    'path' => $tmpfile->judges. '/'. $tmpfile->judges_file
                ]);
                Storage::deleteDirectory(('file/tmp/'). $tmpfile->judges);
                $tmpfile->delete();
            }
        }

        if ($request->has('resource_generation')){
            foreach ($request['resource_generation'] as $file){
                $tmpfile = TemporaryEvaluationFile::where('resource_generation', $file)->first();
                Storage::copy('file/tmp/'. $tmpfile->resource_generation. '/' . $tmpfile->resource_generation_file, 'file/'. $tmpfile->resource_generation. '/'. $tmpfile->resource_generation_file);
                EvaluationFile::create([
                    'evaluation_id' => $evaluate->id,
                    'resource_generation' => $tmpfile->resource_generation_file,
                    'path' => $tmpfile->resource_generation. '/'. $tmpfile->resource_generation_file
                ]);
                Storage::deleteDirectory(('file/tmp/'). $tmpfile->resource_generation);
                $tmpfile->delete();
            }
        }

        if ($request->has('chairmanship')){
            foreach ($request['chairmanship'] as $file){
                $tmpfile = TemporaryEvaluationFile::where('chairmanship', $file)->first();
                Storage::copy('file/tmp/'. $tmpfile->chairmanship. '/' . $tmpfile->chairmanship_file, 'file/'. $tmpfile->chairmanship. '/'. $tmpfile->chairmanship_file);
                EvaluationFile::create([
                    'evaluation_id' => $evaluate->id,
                    'chairmanship' => $tmpfile->chairmanship_file,
                    'path' => $tmpfile->chairmanship. '/'. $tmpfile->chairmanship_file
                ]);
                Storage::deleteDirectory(('file/tmp/'). $tmpfile->chairmanship);
                $tmpfile->delete();
            }
        }

        if ($request->has('facilitation_ongoing')){
            foreach ($request['facilitation_ongoing'] as $file){
                $tmpfile = TemporaryEvaluationFile::where('facilitation_ongoing', $file)->first();
                Storage::copy('file/tmp/'. $tmpfile->facilitation_ongoing. '/' . $tmpfile->facilitation_ongoing_file, 'file/'. $tmpfile->facilitation_ongoing. '/'. $tmpfile->facilitation_ongoing_file);
                EvaluationFile::create([
                    'evaluation_id' => $evaluate->id,
                    'facilitation_ongoing' => $tmpfile->facilitation_ongoing_file,
                    'path' => $tmpfile->facilitation_ongoing. '/'. $tmpfile->facilitation_ongoing_file
                ]);
                Storage::deleteDirectory(('file/tmp/'). $tmpfile->facilitation_ongoing);
                $tmpfile->delete();
            }
        }

        if ($request->has('facilitation_regional')){
            foreach ($request['facilitation_regional'] as $file){
                $tmpfile = TemporaryEvaluationFile::where('facilitation_regional', $file)->first();
                Storage::copy('file/tmp/'. $tmpfile->facilitation_regional. '/' . $tmpfile->facilitation_regional_file, 'file/'. $tmpfile->facilitation_regional. '/'. $tmpfile->facilitation_regional_file);
                EvaluationFile::create([
                    'evaluation_id' => $evaluate->id,
                    'facilitation_regional' => $tmpfile->facilitation_regional_file,
                    'path' => $tmpfile->facilitation_regional. '/'. $tmpfile->facilitation_regional_file
                ]);
                Storage::deleteDirectory(('file/tmp/'). $tmpfile->facilitation_regional);
                $tmpfile->delete();
            }
        }

        if ($request->has('facilitation_national')){
            foreach ($request['facilitation_national'] as $file){
                $tmpfile = TemporaryEvaluationFile::where('facilitation_national', $file)->first();
                Storage::copy('file/tmp/'. $tmpfile->facilitation_national. '/' . $tmpfile->facilitation_national_file, 'file/'. $tmpfile->facilitation_national. '/'. $tmpfile->facilitation_national_file);
                EvaluationFile::create([
                    'evaluation_id' => $evaluate->id,
                    'facilitation_national' => $tmpfile->facilitation_national_file,
                    'path' => $tmpfile->facilitation_national. '/'. $tmpfile->facilitation_national_file
                ]);
                Storage::deleteDirectory(('file/tmp/'). $tmpfile->facilitation_national);
                $tmpfile->delete();
            }
        }

        if ($request->has('facilitation_international')){
            foreach ($request['facilitation_international'] as $file){
                $tmpfile = TemporaryEvaluationFile::where('facilitation_international', $file)->first();
                Storage::copy('file/tmp/'. $tmpfile->facilitation_international. '/' . $tmpfile->facilitation_international_file, 'file/'. $tmpfile->facilitation_international. '/'. $tmpfile->facilitation_international_file);
                EvaluationFile::create([
                    'evaluation_id' => $evaluate->id,
                    'facilitation_international' => $tmpfile->facilitation_international_file,
                    'path' => $tmpfile->facilitation_international. '/'. $tmpfile->facilitation_international_file
                ]);
                Storage::deleteDirectory(('file/tmp/'). $tmpfile->facilitation_international);
                $tmpfile->delete();
            }
        }

        return redirect(route('evaluate.index'));
    }


    public function evaluatePdf($id){

        $evaluations = Evaluation::where('id', $id)->firstOrFail();
        $pdf = Pdf::loadView('user.evaluate.evaluate',  ['evaluations' => $evaluations]);
        return $pdf->download('evaluation.pdf');
    }


    public function UploadTemporaryFile(Request $request, User $id){

        if ($request->has('chairmanship_wide')){
            $images = $request->chairmanship_wide;
            $folder = uniqid('chairmanship_wide-', true);


            foreach($images as $image){

                $fileName = $image->getClientOriginalName();
                $image->storeAs('file/tmp/'. $folder, $fileName);

                TemporaryEvaluationFile::create([
                    'user_id'  => $id->id,
                    'chairmanship_wide' => $folder,
                    'chairmanship_wide_file' => $fileName,
                ]);



            }
            return $folder;
        }


        if ($request->has('chairmanship_unit')){
            $unit = $request->chairmanship_unit;
            $file = uniqid('chairmanship_unit-', true);

            foreach($unit as $imageunit){

                $fileNames = $imageunit->getClientOriginalName();
                $imageunit->storeAs('file/tmp/'. $file, $fileNames);

                  TemporaryEvaluationFile::create([
                     'user_id'  => $id->id,
                    'chairmanship_unit' => $file,
                    'chairmanship_unit_file' => $fileNames,
                ]);


            }
            return $file;
        }

        if ($request->has('membership_wide')){
            $unit = $request->membership_wide;
            $file = uniqid('membership_wide-', true);

            foreach($unit as $imageunit){

                $fileNames = $imageunit->getClientOriginalName();
                $imageunit->storeAs('file/tmp/'. $file, $fileNames);

                  TemporaryEvaluationFile::create([
                     'user_id'  => $id->id,
                    'membership_wide' => $file,
                    'membership_wide_file' => $fileNames,
                ]);


            }
            return $file;
        }
        if ($request->has('membership_unit')){
            $unit = $request->membership_unit;
            $file = uniqid('membership_unit-', true);

            foreach($unit as $imageunit){

                $fileNames = $imageunit->getClientOriginalName();
                $imageunit->storeAs('file/tmp/'. $file, $fileNames);

                  TemporaryEvaluationFile::create([
                     'user_id'  => $id->id,
                    'membership_unit' => $file,
                    'membership_unit_file' => $fileNames,
                ]);


            }
            return $file;
        }

        if ($request->has('advisorships')){
            $unit = $request->advisorships;
            $file = uniqid('advisorships-', true);

            foreach($unit as $imageunit){

                $fileNames = $imageunit->getClientOriginalName();
                $imageunit->storeAs('file/tmp/'. $file, $fileNames);

                  TemporaryEvaluationFile::create([
                     'user_id'  => $id->id,
                    'advisorships' => $file,
                    'advisorships_file' => $fileNames,
                ]);


            }
            return $file;
        }

        if ($request->has('oics')){
            $unit = $request->oics;
            $file = uniqid('oics-', true);

            foreach($unit as $imageunit){

                $fileNames = $imageunit->getClientOriginalName();
                $imageunit->storeAs('file/tmp/'. $file, $fileNames);

                  TemporaryEvaluationFile::create([
                     'user_id'  => $id->id,
                    'oics' => $file,
                    'oics_file' => $fileNames,
                ]);


            }
            return $file;
        }

        if ($request->has('judges')){
            $unit = $request->judges;
            $file = uniqid('judges-', true);

            foreach($unit as $imageunit){

                $fileNames = $imageunit->getClientOriginalName();
                $imageunit->storeAs('file/tmp/'. $file, $fileNames);

                  TemporaryEvaluationFile::create([
                     'user_id'  => $id->id,
                    'judges' => $file,
                    'judges_file' => $fileNames,
                ]);


            }
            return $file;
        }

        if ($request->has('resource_generation')){
            $unit = $request->resource_generation;
            $file = uniqid('resource_generation-', true);

            foreach($unit as $imageunit){

                $fileNames = $imageunit->getClientOriginalName();
                $imageunit->storeAs('file/tmp/'. $file, $fileNames);

                  TemporaryEvaluationFile::create([
                     'user_id'  => $id->id,
                    'resource_generation' => $file,
                    'resource_generation_file' => $fileNames,
                ]);


            }
            return $file;
        }

        if ($request->has('chairmanship')){
            $unit = $request->chairmanship;
            $file = uniqid('chairmanship-', true);

            foreach($unit as $imageunit){

                $fileNames = $imageunit->getClientOriginalName();
                $imageunit->storeAs('file/tmp/'. $file, $fileNames);

                  TemporaryEvaluationFile::create([
                     'user_id'  => $id->id,
                    'chairmanship' => $file,
                    'chairmanship_file' => $fileNames,
                ]);


            }
            return $file;
        }

        if ($request->has('facilitation_ongoing')){
            $unit = $request->facilitation_ongoing;
            $file = uniqid('facilitation_ongoing-', true);

            foreach($unit as $imageunit){

                $fileNames = $imageunit->getClientOriginalName();
                $imageunit->storeAs('file/tmp/'. $file, $fileNames);

                  TemporaryEvaluationFile::create([
                     'user_id'  => $id->id,
                    'facilitation_ongoing' => $file,
                    'facilitation_ongoing_file' => $fileNames,
                ]);


            }
            return $file;
        }

        if ($request->has('facilitation_regional')){
            $unit = $request->facilitation_regional;
            $file = uniqid('facilitation_regional-', true);

            foreach($unit as $imageunit){

                $fileNames = $imageunit->getClientOriginalName();
                $imageunit->storeAs('file/tmp/'. $file, $fileNames);

                  TemporaryEvaluationFile::create([
                     'user_id'  => $id->id,
                    'facilitation_regional' => $file,
                    'facilitation_regional_file' => $fileNames,
                ]);


            }
            return $file;
        }

        if ($request->has('facilitation_national')){
            $unit = $request->facilitation_national;
            $file = uniqid('facilitation_national-', true);

            foreach($unit as $imageunit){

                $fileNames = $imageunit->getClientOriginalName();
                $imageunit->storeAs('file/tmp/'. $file, $fileNames);

                  TemporaryEvaluationFile::create([
                     'user_id'  => $id->id,
                    'facilitation_national' => $file,
                    'facilitation_national_file' => $fileNames,
                ]);


            }
            return $file;
        }

        if ($request->has('facilitation_international')){
            $unit = $request->facilitation_international;
            $file = uniqid('facilitation_international-', true);

            foreach($unit as $imageunit){

                $fileNames = $imageunit->getClientOriginalName();
                $imageunit->storeAs('file/tmp/'. $file, $fileNames);

                  TemporaryEvaluationFile::create([
                     'user_id'  => $id->id,
                    'facilitation_international' => $file,
                    'facilitation_international_file' => $fileNames,
                ]);


            }
            return $file;
        }


    }


    public function deleteFile($id){


        $files = TemporaryEvaluationFile::where('user_id', $id)->get();

        foreach($files as $file){


        // dd($file);

        if ($file->chairmanship_wide) {

            Storage::deleteDirectory('file/tmp/'. $file->chairmanship_wide);
            $file->delete();
        }

        if($file->chairmanship_unit){
            Storage::deleteDirectory('file/tmp/'. $file->chairmanship_unit);
            $file->delete();
        }

        if($file->membership_wide){
            Storage::deleteDirectory('file/tmp/'. $file->membership_wide);
            $file->delete();
        }

        if($file->membership_unit){
            Storage::deleteDirectory('file/tmp/'. $file->membership_unit);
            $file->delete();
        }

        if($file->advisorships){
            Storage::deleteDirectory('file/tmp/'. $file->advisorships);
            $file->delete();
        }

        if($file->oics){
            Storage::deleteDirectory('file/tmp/'. $file->oics);
            $file->delete();
        }

        if($file->judges){
            Storage::deleteDirectory('file/tmp/'. $file->judges);
            $file->delete();
        }

        if($file->resource_generation){
            Storage::deleteDirectory('file/tmp/'. $file->resource_generation);
            $file->delete();
        }

        if($file->chairmanship){
            Storage::deleteDirectory('file/tmp/'. $file->chairmanship);
            $file->delete();
        }

        if($file->facilitation_ongoing){
            Storage::deleteDirectory('file/tmp/'. $file->facilitation_ongoing);
            $file->delete();
        }

        if($file->facilitation_regional){
            Storage::deleteDirectory('file/tmp/'. $file->facilitation_regional);
            $file->delete();
        }

        if($file->facilitation_national){
            Storage::deleteDirectory('file/tmp/'. $file->facilitation_national);
            $file->delete();
        }

        if($file->facilitation_international){
            Storage::deleteDirectory('file/tmp/'. $file->facilitation_international);
            $file->delete();
        }
        }

        return response()->json(['error' => 'Your File not found'], 404);

    }


}
