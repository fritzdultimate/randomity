<?php

namespace App\Livewire\Dashboard;

use App\Models\Passphrase;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.dashboard')]
class Index extends Component {
    public $size = 12;
    private $min = 2;
    private $max = 100;
    public $errorMessage = '';
    public $passphrase = [];

    public $passphraseHistory = [];

    public function triggerSizeUpdate() {
        $this->dispatch('update-size', $this->size);
    }

    public function render() {
        return view('livewire.dashboard.index');
    }
}
