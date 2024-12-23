<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

// #[Layout('components.layouts.app')]
class Login extends Component
{
    public $email = '';
    public $password = '';
    public $errorMsg = '';
    protected $layout = 'layouts.app';

    public function submit() {
        $user = User::where('email', $this->email)->first();
        
        if(!$user) {
            $this->errorMsg = 'Account not found or password is incorrect.';
            return;
        } elseif(!password_verify($this->password, $user->password)) {
            $this->errorMsg = 'Account not found or password is incorrect.';
            return;
        }
        Auth::login($user);
        $user = Auth::user();

         // Delete all other sessions of this user
        $currentSessionId = Session::getId();
        DB::table('sessions')
            ->where('user_id', $user->id)
            ->where('id', '!=', $currentSessionId)
            ->delete();

        return redirect()->route('dashboard');
    }
    public function render()
    {
        return view('livewire.auth.login');
    }
}
