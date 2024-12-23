<?php

namespace App\Livewire\Dashboard;

use App\Models\Passphrase;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Livewire\Attributes\On;
use Livewire\Component;

class GeneratePassphrase extends Component {
    public $size;
    public $min = 1;
    public $max = 100;
    public $errorMessage = '';
    public $passphrase = [];

    #[On('update-size')] 
    public function updateSize($size) {
        $this->size = $size;
    }

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
                $history = Passphrase::create([
                    'user_id' => Auth::id(),
                    'passphrase' =>  json_encode($this->passphrase),
                ]);
                if($history) {
                    $data = [
                        'passphrase' => $this->passphrase,
                        'created_at' => Carbon::now()->toDateTimeString(),
                    ];
                    $this->dispatch('append-passphrase', $data);
                }
            } catch (\Exception $e) {
                //handle error
                // echo 'Error reading file: ' . $e->getMessage();
            }
        } else {
            echo 'File does not exist.';
        }
    }

    public function mount($size = 12) {
        $this->size = $size;
    }


    public function render()
    {
        return view('livewire.dashboard.generate-passphrase');
    }
}
