<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Models\AdminPartner;
use Illuminate\Http\Request;
use App\Models\AdminBeneficiary;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;


class AdminPartnerBeneficiaryController extends Controller
{
    public function index(){

        $partners = AdminPartner::all();
        $beneficiaries = AdminBeneficiary::all();
        return view('admin.partner_beneficiary.index',compact('partners', 'beneficiaries'));
    }

    public function PartnerPost(Request $request){

        {
            $request->validate([

                'title' => 'required|unique:admin_partners|max:255',
                'description' => 'required',
                'image' => ['required', 'mimes:jpg,png,jpeg', 'max:5048'],

            ]);

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

                    'title' => 'required',
                    'description' => 'required',
                    'image' => ['required', 'mimes:jpg,png,jpeg', 'max:5048'],
                ]);

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


    public function BeneficiaryPost(Request $request){

        {
            $request->validate([

                'title' => 'required|unique:admin_beneficiaries|max:255',
                'description' => 'required',
                'image' => ['required', 'mimes:jpg,png,jpeg', 'max:5048'],
            ]);

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

                    'title' => 'required',
                    'description' => 'required',
                    'image' => ['required', 'mimes:jpg,png,jpeg', 'max:5048'],
                ]);

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

}
