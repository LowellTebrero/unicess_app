<?php

namespace App\Http\Controllers;

use App\Models\AdminEvent;
use App\Models\AdminYear;
use App\Models\Post;
use App\Models\Feature;
use App\Models\User;
use App\Models\Latest;
use App\Models\NewsUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $features = Feature::where('status', '1')->get();
        $newsUpdate = NewsUpdate::where('status', '1')->get();
        return view('lnu', compact('newsUpdate', 'slider', 'authorize', 'features'));
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



}
