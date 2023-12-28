<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Models\AdminEvent;
use App\Models\AdminArticle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;


class AdminArticleEventController extends Controller
{
    public function index(){

        $articles = AdminArticle::all();
        $events = AdminEvent::all();
        return view('admin.article_event.index', compact('articles', 'events'));
    }

    public function ArticlePost(Request $request){

        $request->validate([

            'title' => 'required|unique:admin_articles|max:255',
            'description' => 'required',
            'image' => 'required','mimes:jpg,png,jpeg', 'max:5048']);

            $image = $request->image;
            $filename = Str::limit($request->title, 15).'.'. $image->getClientOriginalExtension();
            $resize_image = Image::make($image->getRealPath());
            $resize_image->resize(785, 326);
            $resize_image->save(public_path('upload/image-folder/features-folder/'. $filename));

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

                    'title' => 'required',
                    'description' => 'required',
                    'image' => 'mimes:jpg,png,jpeg', 'max:5048']);

                if($request->file('image')){
                $image = $request->file('image');
                $filename = $request->title.'.'.$image->getClientOriginalExtension();
                $resize_image = Image::make($image->getRealPath());
                $resize_image->resize(785, 326);
                $resize_image->save(public_path('upload/image-folder/features-folder/'. $filename));

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
        $destination = public_path(('upload/image-folder/features-folder/'. $article->image));
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


    public function EventPost(Request $request){

        $request->validate([

            'title' => 'required|unique:admin_articles|max:255',
            'description' => 'required',
            'image' => 'required','mimes:jpg,png,jpeg', 'max:5048']);

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

                    'title' => 'required',
                    'description' => 'required',
                    'image' => 'mimes:jpg,png,jpeg', 'max:5048']);

                if($request->file('image')){
                $image = $request->file('image');
                $filename = $request->title.'.'.$image->getClientOriginalExtension();
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
}
