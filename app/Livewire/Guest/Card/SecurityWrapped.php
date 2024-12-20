<?php

namespace App\Livewire\Guest\Card;

use Livewire\Component;

class SecurityWrapped extends Component {
    public $title;
    public $content;
    public $image;
    public $path;
    public $location;
    
    public function render()
    {
        return view('livewire.guest.card.security-wrapped');
    }
}
