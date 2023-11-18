<?php

namespace App\Http\Livewire;

use App\Models\Feature;
use Livewire\Component;
use Intervention\Image\ImageManager;
use Livewire\WithFileUploads;

class Article extends Component
{
    use WithFileUploads;

    public $features;
    public $title, $description, $feature_image, $status;

    public function resetInput()
    {

        $this->title = '';
        $this->description = '';
        $this->feature_image = '';
        $this->status = '';
    }


    public function saveArticle(){

        $this->validate([
            'title' => 'required|unique:latests|max:255',
            'description' => 'required',
            'feature_image' => 'image|required|mimes:jpg,png,jpeg| max:5048']);





        $article = new Feature();

        $this->feature_image->store('photos');
        $imagehash = $this->title.'.'.$this->feature_image->getClientOriginalExtension();
        $manager = new ImageManager();
        $image = $manager->make($this->feature_image)->resize(785, 326);
        $image->save('upload/image-folder/features-folder/'. $imagehash);

        $article->title = $this->title;
        $article->description = $this->description;
        $article->feature_image = $imagehash;
        $article->status = $this->status == true ? '1': '0';

        dd($article);
        $article->save();

        session()->flash('message', 'Article added successfully');
        $this->resetInput();
        $this->dispatchBrowserEvent('company-added');

    }

    public function render()
    {

        $this->features = Feature::orderBy('updated_at', 'desc')->get();
        return view('livewire.article');
    }
}
