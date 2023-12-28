<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Latest;
use App\Models\Feature;
use App\Models\AdminYear;
use App\Models\AdminEvent;
use App\Models\NewsUpdate;
use App\Models\AdminArticle;
use App\Models\AdminPartner;
use Illuminate\Http\Request;
use App\Models\AdminCalendar;
use App\Models\AdminBeneficiary;
use Illuminate\Support\Facades\DB;
use App\Events\RealtimeNotification;
use App\Models\AdminProgramServices;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //  public function __construct()
    // {
    //     $this->middleware(['auth','verified']);
    // }


    public function index()
    {
        $posts = Post::orderBy('updated_at', 'desc')->get();

        return view('dashboard', compact('posts'));
    }
    public function proposal()
    {
        $posts = Post::orderBy('updated_at', 'desc')->get();
        return view('proposal', compact('posts'));
    }

    public function lnuShow()
    {
        $authorize = DB::table('users')->select('authorize')->get();
        $slider = AdminEvent::where('status', 'open')->get();
        $articles = AdminArticle::where('status', 'open')->get();
        $partners = AdminPartner::take(6)->get();
        $beneficiaries = AdminBeneficiary::take(6)->get();
        $programservices = AdminProgramServices::all();
        $events = [];
        $appointments  = AdminCalendar::all();

        foreach ($appointments as $appointment) {
            $events[] = [
                'title' => $appointment->title,
                'description' => $appointment->description,
                'start' => $appointment->start_time,
                'end' => $appointment->finish_time,
            ];
        }
        return view('lnu', compact('slider', 'authorize', 'articles', 'partners','beneficiaries', 'events', 'programservices' ));
    }


    public function markasread($id)

    {
        if($id){
            auth()->user()->unreadNotifications->where('id', $id)->markAsRead();
        }
        return back();
    }

    public function markAllAsRead()

    {
        auth()->user()->unreadNotifications->markAsRead();
        return back();
    }

    public function RemoveNotification($id)

    {
        if($id){
            DB::table('notifications')->where('id', $id)->delete();

        }
        return back();
    }


    public function SendPusher(){

        // event(new RealtimeNotification('hello world'));
    }



}
