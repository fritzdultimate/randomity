<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Component;

// #[Layout('components.layouts.app')]
class Register extends Component
{
    public $email = '';
    public $password = '';
    public $password_confirmation = '';
    protected $layout = 'layouts.app';

    protected function extractName($email)
    {
        $name = explode('@', $email)[0];
        $nameParts = explode('.', $name);

        return $nameParts[0];
    }

    public function submit()
    {
        $this->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $this->extractName($this->email),
            'email' => $this->email,
            'password' => $this->password
        ]);
        // send email for verification

        return redirect()->route('registered');
    }
    public function render()
    {
        return view('livewire.auth.register');
    }
}
