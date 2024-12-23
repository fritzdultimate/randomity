<?php

namespace App\Livewire\Auth;

use App\Models\PasswordResetTokens;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class ResetPassword extends Component
{
    public $password = '';
    public $password_confirmation = '';
    public $currentUrl = '';
    public $errorMsg = '';


    public function mount()
    {
        $url = request()->fullUrl();
        $this->currentUrl = $url;

        $record = PasswordResetTokens::where('token', $url)->first();
        if (!$record) {
            return redirect()->route('link-expired');
        }
        $time = Carbon::parse($record->created_at);
        if ($time->addHours(1)->isPast()) {
            return redirect()->route('link-expired');
        }
    }

    public function submit()
    {
        $this->validate([
            'password' => 'required|min:6|confirmed',
        ]);
        $token = PasswordResetTokens::where('token', $this->currentUrl)->first();

        if(!$token) {
            return redirect()->route('link-expired');
        }
        $user = User::where('email', $token->email)->first();
        if(!$user) {
            $this->errorMsg = 'Something went wrong, please refresh the browser.';
        }

        User::where('email', $token->email)->update([
            'password' => Hash::make($this->password)
        ]);
        // send email for password change confirmation

        // Delete all other sessions of this user
        $currentSessionId = Session::getId();
        DB::table('sessions')
            ->where('user_id', $user->id)
            ->where('id', '!=', $currentSessionId)
            ->delete();

        
        return redirect()->route('password-changed')->with('password-success', 'changed');
    }

    public function render()
    {
        return view('livewire.auth.reset-password');
    }
}
