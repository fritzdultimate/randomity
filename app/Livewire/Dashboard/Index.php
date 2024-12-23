<?php

namespace App\Livewire\Dashboard;

use Illuminate\Support\Facades\Auth;
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

    public function generate() {
        if($this->size < $this->min || $this->size > $this->max) {
            $this->errorMessage = "Minimum and maximum size of phrase to generate are $this->min and $this->max respectively";

            return;
        }
        $filePath = storage_path('app/data/bip-0039/english.txt');
        if (File::exists($filePath)) {
            $wordList = [];
            try {
                $lines = File::lines($filePath);
                foreach ($lines as $line) {
                    array_push($wordList, $line);
                }
                $this->passphrase = collect($wordList)->random($this->size)->toArray();
            } catch (\Exception $e) {
                //handle error
                // echo 'Error reading file: ' . $e->getMessage();
            }
        } else {
            echo 'File does not exist.';
        }
    }
    public function render() {
        return view('livewire.dashboard.index');
    }
}
