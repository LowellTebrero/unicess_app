<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Faculty;
use Livewire\Component;
use Livewire\WithPagination;

class Faculties extends Component

{   use WithPagination;
    public $search = "";
    public $paginate = 10;
    public $selectedFaculty = null;
    public $authorizing = "";
    public $faculty;
    public $name;

    protected function rules()
    {
        return [
            'name' => ['required','string','min:6','unique:'.Faculty::class],
        ];
    }


     // Save Faculty
     public function saveFaculty()
     {
         $this->validate();

         Faculty::create([
             'name' => $this->name,
         ]);

         session()->flash('message', 'Faculty  added successfully');
         $this->resetInput();
         $this->dispatchBrowserEvent('company-added');
     }

     public function resetInput()
     {
         $this->name = '';
     }


    public function render()
    {
        $this->faculty = Faculty::orderBy('name', 'asc')->get();

        return view('livewire.faculties', [
            'users' => User::whereNotNull('faculty_id')->orderBy('first_name', 'asc' )
            ->search(trim($this->search))
            ->when($this->selectedFaculty, function ($query){
            $query->where('faculty_id', $this->selectedFaculty);
            })
            ->when($this->authorizing, function ($query){
            $query->where('authorize', $this->authorizing);
            })
            ->orderBy('authorize', 'asc')
            ->paginate($this->paginate),
            'faculties' => Faculty::orderBy('name')->pluck('name', 'id')->prepend('All Faculties', '')
        ]);
    }
}
