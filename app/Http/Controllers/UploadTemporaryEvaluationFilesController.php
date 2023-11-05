<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TemporaryEvaluationFile;

class UploadTemporaryEvaluationFilesController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if($request->hasFile('chairmanship_wide')){
            $image = $request->file('chairmanship_wide');
            $fileName = $image->getClientOriginalName();
            $folder = uniqid('file-', true);
            $image->storeAs('file/tmp/'. $folder, $fileName);

            TemporaryEvaluationFile::create([
                'chairmanship_wide' => $folder,
                'chairmanship_wide_file' => $fileName,
            ]);

            return $folder;
        }

        if($request->hasFile('chairmanship_unit')){
            $image = $request->file('chairmanship_unit');
            $fileName = $image->getClientOriginalName();
            $folder = uniqid('file-', true);
            $image->storeAs('file/tmp/'. $folder, $fileName);

            TemporaryEvaluationFile::create([
                'chairmanship_unit' => $folder,
                'chairmanship_unit_file' => $fileName,
            ]);

            return $folder;
        }

        if($request->hasFile('membership_wide')){
            $image = $request->file('membership_wide');
            $fileName = $image->getClientOriginalName();
            $folder = uniqid('file-', true);
            $image->storeAs('file/tmp/'. $folder, $fileName);

            TemporaryEvaluationFile::create([
                'membership_wide' => $folder,
                'membership_wide_file' => $fileName,
            ]);

            return $folder;
        }
        return '';
    }
}
