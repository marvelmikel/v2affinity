<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Faq extends Component
{
    public $faq_id;
    public $question;
    public $answer;

    public function render()
    {
        return view('livewire.faq');
    }
}
