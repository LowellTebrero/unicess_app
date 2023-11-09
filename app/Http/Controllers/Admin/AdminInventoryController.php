<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Faculty;
use App\Models\Program;
use App\Models\Proposal;
use App\Models\AdminYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\CustomizeAdminInventory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class AdminInventoryController extends Controller
{

    // Admin Main Index Inventory
    public function index()
    {
        $program = Program::all();
        $proposal = DB::table('proposals')->select('program_id', DB::raw('count(*) as qty'))->groupBy('program_id')->get();
        $inventory = CustomizeAdminInventory::where('id', 1)->get();
        $years = AdminYear::orderBy('year', 'DESC')->pluck('year');
        $medias = Media::orderBy('file_name', 'DESC')->get();
        $proposals = Proposal::orderBy('created_at', 'DESC')->get();

        return view('admin.inventory.index', compact('program' , 'proposal', 'inventory', 'medias', 'years', 'proposals'));
    }

     // Show Faculty Admin
     public function show($id)
     {
        
      $proposalID = Proposal::with('programs')
      ->whereHas('user', function($query){
          $query->with('faculty')
      ->whereHas('faculty', function ($query){
              if($facultyId = request('faculty_id')) {
                  $query->where('faculty_id', $facultyId);
              }
         });
      })->get();

      $facs = Faculty::where('id', $id)->first();
      $userfaculty = User::where('id', $id)->first();
      $programID =   Program::where('id', $id)->first();
      $allFaculty = Faculty::orderBy('name')->pluck('name', 'id')->prepend('All Faculty', '');

      return view('admin.inventory.show' , compact('proposalID', 'programID', 'userfaculty', 'facs', 'allFaculty'));
     }


     public function showInventory($id){

        $proposals = Proposal::where('id', $id)->first();
        return view('admin.inventory.show-inventory', compact('proposals'));
     }


    public function search(Request $request)
    {
        $query = $request->input('query');

        $program = Program::all();
        $years = AdminYear::orderBy('year', 'DESC')->pluck('year');
        $proposal = DB::table('proposals')->select('program_id', DB::raw('count(*) as qty'))->groupBy('program_id')->get();
        $inventory = CustomizeAdminInventory::where('id', 1)->get();

        $medias = Media::where(function ($query) {
            if($companyId = request('selected_value')){
                $query->whereYear('created_at', $companyId);
            }})
            ->where(function ($query) {
                if($companyId = request('files')){
                    $query->where('collection_name', $companyId);
                }})
            ->when($query, function ($querys) use ($query) {
                return $querys->where('file_name', 'like', "%$query%");
            })->orderBy('file_name', 'DESC')->get();


            return view('admin.inventory.index-filter._all-files-medias', compact('program' , 'proposal', 'inventory', 'medias', 'years'));

    }
    public function filter(Request $request){
        $query = $request->input('query');

        $program = Program::all();
        $years = AdminYear::orderBy('year', 'DESC')->pluck('year');
        $proposal = DB::table('proposals')->select('program_id', DB::raw('count(*) as qty'))->groupBy('program_id')->get();
        $inventory = CustomizeAdminInventory::where('id', 1)->get();


        $medias = Media::when($query, function ($querys) use ($query) {
            return $querys->where('file_name', 'like', "%$query%");
        })
        ->where(function ($query) {
            if($companyId = request('files')){
                $query->where('collection_name', $companyId);}})
        ->where(function ($query) {
            if($companyId = request('year')){
                $query->whereYear('created_at', $companyId);}})
        ->orderBy('file_name', 'DESC')->get();


        return view('admin.inventory.index-filter._all-files-medias', compact('program' , 'proposal', 'inventory', 'medias', 'years'));

    }


    public function sortfile(Request $request){
        $query = $request->input('query');

        $program = Program::all();
        $years = AdminYear::orderBy('year', 'DESC')->pluck('year');
        $proposal = DB::table('proposals')->select('program_id', DB::raw('count(*) as qty'))->groupBy('program_id')->get();
        $inventory = CustomizeAdminInventory::where('id', 1)->get();

        $medias = Media::when($query, function ($querys) use ($query) {
            return $querys->where('file_name', 'like', "%$query%");})
                        ->where(function ($query) {
                            if($companyId = request('year')){
                                $query->whereYear('created_at', $companyId);}})
                        ->where(function ($query) {
                            if($companyId = request('selected_value')){
                                $query->where('collection_name', $companyId);}})
                                    ->orderBy('file_name', 'DESC')->get();


        return view('admin.inventory.index-filter._all-files-medias', compact('program' , 'proposal', 'inventory', 'medias', 'years'));

    }

    public function sort(Request $request){
        $query = $request->input('query');
        $sort = $request->input('selected_value');

        $program = Program::all();
        $years = AdminYear::orderBy('year', 'DESC')->pluck('year');
        $proposal = DB::table('proposals')->select('program_id', DB::raw('count(*) as qty'))->groupBy('program_id')->get();
        $inventory = CustomizeAdminInventory::where('id', 1)->get();

        $medias = Media::when($query, function ($querys) use ($query) {
            return $querys->where('file_name', 'like', "%$query%");})
                        ->where(function ($query) {
                            if($companyId = request('year')){
                                $query->whereYear('created_at', $companyId);}})
                        ->where(function ($query) {
                            if($companyId = request('files')){
                                $query->where('collection_name', $companyId);}})
                        ->orderBy('file_name', $sort)->get();

        return view('admin.inventory.index-filter._all-files-medias', compact('program' , 'proposal', 'inventory', 'medias', 'years'));

    }

    public function InventorydownloadMedia(Media $id){

        return response()->download($id->getPath(), $id->file_name);

    }



}
