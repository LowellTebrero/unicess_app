<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Program;
use App\Models\Template;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;



class TemplateController extends Controller
{


    public function genereatePdf()
    {
        $pdf = Pdf::loadView('view-pdf-template');
        return $pdf->download('template-proposal.pdf');
    }

    public function Templatedownload()
    {
        $template = Template::loadView('view-pdf-template');
        // return $pdf->download('template-proposal.pdf');
    }

    public function UserTemplateDownload(Request $request){

        $templates = Template::all();
        foreach($templates as $template){
            if($lol =  Storage::disk('local')->exists('upload/template/'.$template->template_name)){
                // dd('upload/template/'.$template->template_name);
                return response()->download(public_path('upload/template/'.$template->template_name));
             }
        }
    }

}
