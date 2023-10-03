<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ReviewCard extends Component
{

    public $description;

    public $name;

    public $designation;

    public $img_url;

    public function __construct(){

        $this->description = '"We have been using Affinity for a few months now and it has been a game changer for our business. The software has helped us reduce costs by eliminating human error, saving us around 4% in costs. The real-time cost calculation feature has also been a lifesaver, allowing us to save valuable time that we can now use to attend to more customers. The user-friendly interface and compatibility across all devices make it easy for our sales team to use, even while speaking with clients on the shop floor. Overall, we highly recommend Affinity to any business looking for a smarter, more efficient invoicing solution."';

        $this->name = "Jay Jones";

        $this->designation = "Store Manager, National Carpets";

        $this->img_url = asset('images/logo-example.png');
    }

    public function render()
    {
        return view('livewire.review-card');
    }
}
