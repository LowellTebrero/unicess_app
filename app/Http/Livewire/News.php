<?php

namespace App\Http\Livewire;

use App\Models\NewsUpdate;
use Livewire\Component;
use Intervention\Image\ImageManager;
use Livewire\WithFileUploads;

class News extends Component
{

    use WithFileUploads;

    public $news;
    public $title, $description, $status, $image;

    public function resetInput()
    {
        $this->title = '';
        $this->description = '';
        $this->status = '';
        $this->image = '';
    }

    public function saveNews(){

        $this->validate([
            'title' => 'required|unique:news_updates|max:255',
            'description' => 'required',
            'image' => 'image|required|mimes:jpg,png,jpeg| max:5048']);

        $news = new NewsUpdate();

        $this->image->store('photos');
        $imagehash = $this->title.'.'.$this->image->getClientOriginalExtension();
        $manager = new ImageManager();
        $image = $manager->make($this->image)->resize(600, 500);
        $image->save('upload/image-folder/news-folder/'. $imagehash);

        $news->title = $this->title;
        $news->description = $this->description;
        $news->image = $imagehash;
        $news->status = $this->status == true ? '1': '0';
        $news->save();

        session()->flash('message', 'News  added successfully');
        $this->resetInput();
        $this->dispatchBrowserEvent('company-added');
    }


    public function render()
    {
        $this->news = NewsUpdate::orderBy('updated_at', 'desc')->get();
        return view('livewire.news');
    }
}
