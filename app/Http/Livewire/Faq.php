<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Faq extends Component
{
    public $faq_id;
    
    public $question;

    public $answer;

    public $expanded;

    public $collapsed;

    public function render()
    {

        if($this->expanded == 'show'){
            $this->collapsed = '';
        }else{
            $this->collapsed = 'collapsed';
        }
        return view('livewire.faq');
    }
}
