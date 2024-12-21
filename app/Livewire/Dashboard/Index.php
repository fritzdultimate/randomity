<?php

namespace App\Livewire\Dashboard;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public function render() {
        dd(Auth::user());
        return view('livewire.dashboard.index');
    }
}
