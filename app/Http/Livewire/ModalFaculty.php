<?php

namespace App\Http\Livewire;

use App\Models\Faculty;
use LivewireUI\Modal\ModalComponent;


class ModalFaculty extends ModalComponent
{
    public $name;
    /**
 * Supported: 'sm', 'md', 'lg', 'xl', '2xl', '3xl', '4xl', '5xl', '6xl', '7xl'
 */
    public static function modalMaxWidth(): string
    {
        return 'xl';
    }

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
         $this->closeModal();
     }

     public function resetInput()
     {
         $this->name = '';
     }

    public function render()
    {
        return view('livewire.modal-faculty');
    }


}
