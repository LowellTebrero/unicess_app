<?php

namespace App\Http\Controllers;

use App\Models\Latest;
use App\Models\Feature;
use App\Models\NewsUpdate;
use Illuminate\Http\Request;

class LnuAdditionalController extends Controller
{

    public function lnuEvent(){

        $events = Latest::orderBy('description', 'asc')->get();
        return view('lnu-additional-partials.event-additionals', compact('events'));
    }
    public function lnuNews(){


        $news = NewsUpdate::orderBy('description', 'asc')->get();

        return view('lnu-additional-partials.news-additionals', compact( 'news',));
    }
    public function lnuFeatures(){


        $features = Feature::all();

        return view('lnu-additional-partials.features-additionals', compact('features'));
    }

    public function showEvent($id){

        $events = Latest::where('id', $id)->firstorFail();
        return view('lnu-additional-partials.lnu-show-details.show-event', compact('events'));
    }

    public function showNews($id){

        $news = NewsUpdate::where('id', $id)->firstorFail();
        return view('lnu-additional-partials.lnu-show-details.show-news', compact('news'));
    }

    public function showFeatures($id){

        $articles = Feature::where('id', $id)->firstorFail();
        return view('lnu-additional-partials.lnu-show-details.show-article', compact('articles'));
    }

}
