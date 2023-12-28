<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use App\Models\AdminEvent;
use App\Models\AdminArticle;
use Illuminate\Http\Request;

class LnuAdditionalController extends Controller
{

    public function lnuEvent(){

        $events = AdminEvent::orderBy('description', 'asc')->get();
        return view('lnu-additional-partials.event-additionals', compact('events'));
    }

    public function lnuFeatures(){


        $articles = AdminArticle::all();

        return view('lnu-additional-partials.features-additionals', compact('articles'));
    }

    public function showEvent($id){

        $events = AdminEvent::where('id', $id)->firstorFail();
        return view('lnu-additional-partials.lnu-show-details.show-event', compact('events'));
    }



    public function showFeatures($id){

        $articles = AdminArticle::where('id', $id)->firstorFail();
        return view('lnu-additional-partials.lnu-show-details.show-article', compact('articles'));
    }

}
