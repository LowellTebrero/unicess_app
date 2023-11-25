<?php

namespace App\Http\Livewire;

use App\Models\AdminEvent;
use App\Models\Latest;
use Livewire\Component;
use Intervention\Image\ImageManager;
use Livewire\WithFileUploads;

class Event extends Component
{
    use WithFileUploads;

    public $latests;
    public $title, $description, $status, $image;


    public function resetInput()
    {
        $this->title = '';
        $this->description = '';
        $this->status = '';
        $this->image = '';
    }


    public function saveEvent(){

        $this->validate([
            'title' => 'required|unique:latests|max:255',
            'description' => 'required',
            'image' => 'image|required|mimes:jpg,png,jpeg| max:5048']
        );

        $event = new AdminEvent();

        $this->image->store('photos');
        $imagehash = $this->title.'.'.$this->image->getClientOriginalExtension();
        $manager = new ImageManager();
        $image = $manager->make($this->image)->resize(600, 500);
        $image->save('upload/image-folder/event-folder/'.  $imagehash);

        $event->title = $this->title;
        $event->description = $this->description;
        $event->image = $imagehash;
        $event->status = $this->status == true ? '1': '0';
        $event->save();

        session()->flash('message', 'Event  added successfully');
        $this->resetInput();
        $this->dispatchBrowserEvent('company-added');

    }


    public function render()
    {
        $this->latests = AdminEvent::orderBy('updated_at', 'desc')->get();
        return view('livewire.event');
    }
}
