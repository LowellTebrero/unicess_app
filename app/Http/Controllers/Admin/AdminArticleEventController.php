<?php

namespace App\Http\Controllers\Admin;

use App\Models\AdminEvent;
use Illuminate\Support\Str;
use App\Models\AdminArticle;
use App\Models\AdminPartner;
use Illuminate\Http\Request;
use App\Models\AdminBeneficiary;
use App\Http\Controllers\Controller;
use App\Models\AdminProgramServices;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;


class AdminArticleEventController extends Controller
{
    public function index(){

        $articles = AdminArticle::all();
        $events = AdminEvent::all();
        $partners = AdminPartner::all();
        $beneficiaries = AdminBeneficiary::all();
        $programservices = AdminProgramServices::paginate(7);
        return view('admin.article_event.index', compact('articles', 'events', 'partners','beneficiaries','programservices'));
    }

    // Article
    public function ArticlePost(Request $request){

        $request->validate([

            'title' => ['required','unique:admin_articles','max:255','min:6','regex:/^[^<>?:|\/"*]+$/'],
            'description' => 'required',
            'image' => ['required', 'mimes:jpg,png,jpeg', 'max:5048'],

            ],
            ['title.regex' => 'Invalid characters: \ / : * ? " < > |']
            );

            $image = $request->image;
            $filename = Str::limit($request->title, 15).'.'. $image->getClientOriginalExtension();
            $resize_image = Image::make($image->getRealPath());
            $resize_image->resize(600, 500);
            $resize_image->save(public_path('upload/image-folder/article-folder/'. $filename));

            if(File::exists($resize_image)){
                unlink($resize_image);
            }

            $articles = new AdminArticle();
            $articles->title = $request->title;
            $articles->description = $request->description;
            $articles->image = $filename;
            $articles->save();


        flash()->addSuccess('Article Uploded Successfully.');
        return back();
    }

    public function ArticleUpdate(Request $request, $id)
    {
                $request->validate([

                    'title' => ['required','max:255','min:6','regex:/^[^<>?:|\/"*]+$/'],
                    'description' => 'required',
                    'image' => ['sometimes', 'mimes:jpg,png,jpeg', 'max:5048'],


                ],
                ['title.regex' => 'Invalid characters: \ / : * ? " < > |']
                );

                if($request->file('image')){
                $image = $request->file('image');
                $filename =  Str::limit($request->title, 15).'.'.$image->getClientOriginalExtension();
                $resize_image = Image::make($image->getRealPath());
                  $resize_image->resize(600, 500);
                $resize_image->save(public_path('upload/image-folder/article-folder/'. $filename));

                if(File::exists($resize_image)){
                    unlink($resize_image);
                }

                AdminArticle::where('id', $id)->update([

                    'title' => $request->title,
                    'description' => $request->description,
                    'image' => $filename,

                ]);

                  flash()->addSuccess('Article Updated Successfully.');
                return back();
            }else {

                AdminArticle::where('id', $id)->update([
                    'title' => $request->title,
                    'description' => $request->description,
                ]);

                flash()->addSuccess('Article Updated Successfully.');
                return back();
            }

    }

    public function ArticleDelete($id){

        $article = AdminArticle::find($id);
        $destination = public_path(('upload/image-folder/article-folder/'. $article->image));
        if(File::exists($destination))
        {
            File::delete($destination);
        }
        $article->delete();

        flash()->addSuccess('Delete Successfully.');
        return back();
    }

    public function UpdateToggleFeatureStatus(Request $request)
    {

        $featureId = $request->input('article_id');
        $status = $request->input('status');

        $feature = AdminArticle::find($featureId);
        $feature->update(['status' => $status]);

        return response()->json(['message' => 'Status updated successfully']);
    }

    public function UpdateToggleEventStatus(Request $request)
    {
        $taskId = $request->input('task_id');
        $status = $request->input('status');

        $task = AdminEvent::find($taskId);
        $task->update(['status' => $status]);

        return response()->json(['message' => 'Status updated successfully']);
    }



    // Event
    public function EventPost(Request $request){

        $request->validate([

            'title' => ['required','unique:admin_events','max:255','min:6','regex:/^[^<>?:|\/"*]+$/'],
            'description' => 'required',
            'image' => ['required', 'mimes:jpg,png,jpeg', 'max:5048'],

        ],
        ['title.regex' => 'Invalid characters: \ / : * ? " < > |']
        );

        $image = $request->image;
        $filename = Str::limit($request->title, 15).'.'. $image->getClientOriginalExtension();
        $resize_image = Image::make($image->getRealPath());
        $resize_image->resize(600, 500);
        $resize_image->save(public_path('upload/image-folder/event-folder/'. $filename));

        if(File::exists($resize_image)){
            unlink($resize_image);
        }

        $articles = new AdminEvent();
        $articles->title = $request->title;
        $articles->description = $request->description;
        $articles->image = $filename;
        $articles->save();


        flash()->addSuccess('Article Uploded Successfully.');
        return back();
    }

    public function EventUpdate(Request $request, $id)
    {
                $request->validate([

                    'title' => ['required','max:255','min:6','regex:/^[^<>?:|\/"*]+$/'],
                    'description' => 'required',
                    'image' => ['sometimes', 'mimes:jpg,png,jpeg', 'max:5048'],
                ],
                ['title.regex' => 'Invalid characters: \ / : * ? " < > |']
                );


                if($request->file('image')){
                $image = $request->file('image');
                $filename =  Str::limit($request->title, 15).'.'.$image->getClientOriginalExtension();
                $resize_image = Image::make($image->getRealPath());
                $resize_image->resize(600, 500);
                $resize_image->save(public_path('upload/image-folder/event-folder/'. $filename));

                if(File::exists($resize_image)){
                    unlink($resize_image);
                }

                AdminEvent::where('id', $id)->update([

                    'title' => $request->title,
                    'description' => $request->description,
                    'image' => $filename,

                ]);

                  flash()->addSuccess('Article Updated Successfully.');
                return back();
            }else {

                AdminEvent::where('id', $id)->update([
                    'title' => $request->title,
                    'description' => $request->description,
                ]);

                flash()->addSuccess('Article Updated Successfully.');
                return back();
            }

    }

    public function EventDelete($id){

        $event = AdminEvent::find($id);
        $destination = public_path(('upload/image-folder/event-folder/'. $event->image));
        if(File::exists($destination))
        {
            File::delete($destination);
        }
        $event->delete();

        flash()->addSuccess('Delete Successfully.');
        return back();
    }


    // Partner
    public function PartnerPost(Request $request){

        {
            $request->validate([

                'title' => ['required', 'unique:admin_partners','max:255','min:6','regex:/^[^<>?:|\/"*]+$/'],
                'description' => 'required',
                'image' => ['required', 'mimes:jpg,png,jpeg', 'max:5048'],

            ],
            ['title.regex' => 'Invalid characters: \ / : * ? " < > |']
            );


            $image = $request->image;
            $filename = Str::limit($request->title, 15).'.'. $image->getClientOriginalExtension();
            $resize_image = Image::make($image->getRealPath());
            $resize_image->resize(600, 500);
            $resize_image->save(public_path('upload/image-folder/partner-folder/'. $filename));

            if(File::exists($resize_image)){
                unlink($resize_image);
            }

            $partners = new AdminPartner();
            $partners->title = $request->title;
            $partners->description = $request->description;
            $partners->image = $filename;
            $partners->save();


            flash()->addSuccess('Partner Uploded Successfully.');

            return back();
        }
    }

    public function PartnerUpdate(Request $request, $id)
    {
            $request->validate([

                'title' => ['required','max:255','min:6','regex:/^[^<>?:|\/"*]+$/'],
                'description' => 'required',
                'image' => ['sometimes', 'mimes:jpg,png,jpeg', 'max:5048'],


            ],
            ['title.regex' => 'Invalid characters: \ / : * ? " < > |']
            );


                if($request->file('image')){
                $image = $request->file('image');
                $filename = $request->title.'.'.$image->getClientOriginalExtension();
                $resize_image = Image::make($image->getRealPath());
                $resize_image->resize(600, 500);
                $resize_image->save(public_path('upload/image-folder/partner-folder/'. $filename));

                if(File::exists($resize_image)){
                    unlink($resize_image);
                }

                AdminPartner::where('id', $id)->update([

                    'title' => $request->title,
                    'description' => $request->description,
                    'image' => $filename,

                ]);

                  flash()->addSuccess('Partner Updated Successfully.');
                return back();
            }else {

                AdminPartner::where('id', $id)->update([
                    'title' => $request->title,
                    'description' => $request->description,
                ]);

                flash()->addSuccess('Partner Updated Successfully.');
                return back();
            }

    }

    public function PartnerDelete($id){

        $partner = AdminPartner::find($id);
        $destination = public_path(('upload/image-folder/partner-folder/'. $partner->image));
        if(File::exists($destination))
        {
            File::delete($destination);
        }
        $partner->delete();

        flash()->addSuccess('Delete Successfully.');
        return back();
    }



    // Beneficiary
    public function BeneficiaryPost(Request $request){

        {
            $request->validate([

                'title' => ['required', 'unique:admin_beneficiaries','max:255','min:6','regex:/^[^<>?:|\/"*]+$/'],
                'description' => 'required',
                'image' => ['required', 'mimes:jpg,png,jpeg', 'max:5048'],

            ],
            ['title.regex' => 'Invalid characters: \ / : * ? " < > |']
            );



            $image = $request->image;
            $filename = Str::limit($request->title, 15).'.'. $image->getClientOriginalExtension();
            $resize_image = Image::make($image->getRealPath());
            $resize_image->resize(600, 500);
            $resize_image->save(public_path('upload/image-folder/beneficiary-folder/'. $filename));

            if(File::exists($resize_image)){
                unlink($resize_image);
            }

            $beneficiary = new AdminBeneficiary();
            $beneficiary->title = $request->title;
            $beneficiary->description = $request->description;
            $beneficiary->image = $filename;
            $beneficiary->save();


            flash()->addSuccess('Beneficiary Uploded Successfully.');

            return back();
        }
    }

    public function BeneficiaryUpdate(Request $request, $id)
    {
            $request->validate([

                'title' => ['required','max:255','min:6','regex:/^[^<>?:|\/"*]+$/'],
                'description' => 'required',
                'image' => ['sometimes', 'mimes:jpg,png,jpeg', 'max:5048'],


            ],
            ['title.regex' => 'Invalid characters: \ / : * ? " < > |']
            );


                if($request->file('image')){
                $image = $request->file('image');
                $filename = $request->title.'.'.$image->getClientOriginalExtension();
                $resize_image = Image::make($image->getRealPath());
                $resize_image->resize(600, 500);
                $resize_image->save(public_path('upload/image-folder/beneficiary-folder/'. $filename));

                if(File::exists($resize_image)){
                    unlink($resize_image);
                }

                AdminBeneficiary::where('id', $id)->update([

                    'title' => $request->title,
                    'description' => $request->description,
                    'image' => $filename,

                ]);

                  flash()->addSuccess('Beneficiary Updated Successfully.');
                return back();
            }else {

                AdminBeneficiary::where('id', $id)->update([

                    'title' => $request->title,
                    'description' => $request->description,


                ]);

                flash()->addSuccess('Partner Updated Successfully.');
                return back();
            }

    }

    public function BeneficiaryDelete($id){

        $beneficiary = AdminBeneficiary::find($id);
        $destination = public_path(('upload/image-folder/beneficiary-folder/'. $beneficiary->image));
        if(File::exists($destination))
        {
            File::delete($destination);
        }
        $beneficiary->delete();

        flash()->addSuccess('Delete Successfully.');
        return back();
    }




    // Program and Services
    public function ProgramServicesUpdate(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description'  => 'required',
            'image' => ['required', 'mimes:jpg,png,jpeg', 'max:5048'],
        ]);

        if($request->file('image')){
        $image = $request->file('image');
        $filename = Str::limit($request->title, 15).'.'.$image->getClientOriginalExtension();
        $resize_image = Image::make($image->getRealPath());
        $resize_image->resize(600, 500);
        $resize_image->save(public_path('upload/image-folder/program-services-folder/'. $filename));

        if(File::exists($resize_image)){
            unlink($resize_image);
        }

        AdminProgramServices::where('id', $id)->update([
            'description' => $request->description,
            'image' => $filename,

        ]);

            flash()->addSuccess('Program Services Updated Successfully.');
        return back();
    }else {

        AdminProgramServices::where('id', $id)->update([
            'description' => $request->description,
        ]);

        flash()->addSuccess('Program Services Updated Successfully.');
        return back();
        }

    }

    public function ProgramServicesDelete($id){

        $programservices = AdminProgramServices::find($id);
        $destination = public_path(('upload/image-folder/program-services-folder/'. $programservices->image));
        if(File::exists($destination))
        {
            File::delete($destination);
        }
        $programservices->delete();

        flash()->addSuccess('Delete Successfully.');
        return back();
    }

    public function UpdateToggleStatus(Request $request)
    {
        $articleId = $request->input('article_id');
        $status = $request->input('status');

        $task = AdminProgramServices::find($articleId);
        $task->update(['status' => $status]);

        return response()->json(['message' => 'Status updated successfully']);
    }

    public function UpdateToggleStatustoPhysical(Request $request)
    {
        $physicalId = $request->input('physical_id');
        $status = $request->input('status');

        $task = AdminProgramServices::find($physicalId);
        $task->update(['status' => $status]);

        return response()->json(['message' => 'Status updated successfully']);
    }

    public function UpdateToggleStatustoInformation(Request $request)
    {
        $informationId = $request->input('information_id');
        $status = $request->input('status');

        $task = AdminProgramServices::find($informationId);
        $task->update(['status' => $status]);

        return response()->json(['message' => 'Status updated successfully']);
    }

    public function UpdateToggleStatustoLiteracy(Request $request)
    {
        $literacyId = $request->input('literacy_id');
        $status = $request->input('status');

        $task = AdminProgramServices::find($literacyId);
        $task->update(['status' => $status]);

        return response()->json(['message' => 'Status updated successfully']);
    }

    public function UpdateToggleStatustoCultural(Request $request)
    {
        $culturalId = $request->input('cultural_id');
        $status = $request->input('status');

        $task = AdminProgramServices::find($culturalId);
        $task->update(['status' => $status]);

        return response()->json(['message' => 'Status updated successfully']);
    }

    public function UpdateToggleStatustoLivelihood(Request $request)
    {
        $livelihoodId = $request->input('livelihood_id');
        $status = $request->input('status');

        $task = AdminProgramServices::find($livelihoodId);
        $task->update(['status' => $status]);

        return response()->json(['message' => 'Status updated successfully']);
    }

    public function UpdateToggleStatustoEnvironmental(Request $request)
    {
        $environmentalId = $request->input('environmental_id');
        $status = $request->input('status');

        $task = AdminProgramServices::find($environmentalId);
        $task->update(['status' => $status]);

        return response()->json(['message' => 'Status updated successfully']);
    }

    public function UpdateToggleStatustoManagement(Request $request)
    {
        $managementId = $request->input('management_id');
        $status = $request->input('status');

        $task = AdminProgramServices::find($managementId);
        $task->update(['status' => $status]);

        return response()->json(['message' => 'Status updated successfully']);
    }

    public function UpdateToggleStatustoSpecial(Request $request)
    {
        $specialId = $request->input('special_id');
        $status = $request->input('status');

        $task = AdminProgramServices::find($specialId);
        $task->update(['status' => $status]);

        return response()->json(['message' => 'Status updated successfully']);
    }

}
