<?php

namespace App\Http\Livewire;

use App\Models\Feature;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Intervention\Image\ImageManager;

class Article extends Component
{
    use WithFileUploads;

    public $features;
    public $title, $description, $feature_image, $status;
    protected $uploadsTemporary = false;

    public function resetInput()
    {

        $this->title = '';
        $this->description = '';
        $this->feature_image = '';
        $this->status = '';


    }

    public function saveArticle(){

        $this->validate([
            'title' => 'required|unique:features|max:255',
            'description' => 'required',
            'feature_image' => 'required|mimes:jpeg,jpg,png| max:5048'
        ]);


        $article = new Feature();

        $imagehash = Str::limit($this->title, 15).'.'.$this->feature_image->getClientOriginalExtension();
        $manager = new ImageManager();
        $image = $manager->make($this->feature_image)->resize(785, 326);
        $image->save('upload/image-folder/features-folder/'. $imagehash);

        $article->title = $this->title;
        $article->description = $this->description;
        $article->feature_image = $imagehash;


        $article->save();

        flash()->addSuccess('Article Added Successfully.');
        $this->resetInput();
        $this->dispatchBrowserEvent('company-added');


    }

    // public function render()
    // {
    //     return view('livewire.article');
    // }
}
