<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PersentageCount extends Component
{
    public $count;

    public $detail;
    
    public function render()
    {
        return view('livewire.persentage-count');
    }
}
