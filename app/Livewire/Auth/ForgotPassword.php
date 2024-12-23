<?php

namespace App\Livewire\Auth;

use App\Models\PasswordResetTokens;
use App\Models\User;
use Illuminate\Support\Str;
use Livewire\Component;
use Throwable;

// #[Layout('components.layouts.app')]
class ForgotPassword extends Component
{
    public $email = '';
    public $errorMsg = '';
    protected $layout = 'layouts.app';

    public function submit() {
        $this->validate([
            'email' => 'required|email',
        ]);
        $user = User::where('email', $this->email)->first();
        
        if(!$user) {
            $this->errorMsg = 'Account not found.';
            return;
        }
        $url = route('account-reset-password', ['signed' => Str::random(32)]);
        
        PasswordResetTokens::where('email', $this->email)->forceDelete();
        $storedToken = PasswordResetTokens::create([
            'email' => $this->email,
            'token' => $url,
            'created_at' => now()
        ]);
        // send email to the user with the token $url

        return redirect()->route('account-recovery-pending')->with('recovery', 'pending');
    }

    public function render() {
        return view('livewire.auth.forgot-password');
    }
}
