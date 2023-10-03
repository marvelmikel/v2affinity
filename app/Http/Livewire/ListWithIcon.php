<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ListWithIcon extends Component
{

    public $title;
    public $description;
    public $icon;

    public function render()
    {
        return view('livewire.list-with-icon');
    }
}
