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
                    // Add the newly generated passphrase to today's group
                    if (!isset($this->passphraseHistory['today'])) {
                        $this->passphraseHistory['today'] = [];
                    }
                    // $this->passphraseHistory['today'][] = [
                    //     'passphrase' => $this->passphrase,
                    //     'created_at' => Carbon::now()->toDateTimeString(),
                    // ];

                    array_unshift($this->passphraseHistory['today'], [
                        'passphrase' => $this->passphrase,
                        'created_at' => Carbon::now()->toDateTimeString(),
                    ]);
                }
            } catch (\Exception $e) {
                //handle error
                // echo 'Error reading file: ' . $e->getMessage();
            }
        } else {
            echo 'File does not exist.';
        }
    }

    public function mount() {
        // Fetch encrypted passphrases for the authenticated user
        $passphrases = Passphrase::where('user_id', Auth::id())
            ->select('passphrase', 'created_at')
            ->orderBy('created_at', 'desc')
            ->get();
        // Decrypt passphrases and group them by day
        $groupedPassphrases = $passphrases->map(function ($item) {
            return [
                'passphrase' => json_decode($item->passphrase, true),
                'created_at' => $item->created_at,
            ];
        })->groupBy(function ($item) {
            $today = Carbon::now()->format('Y-m-d');
            $tomorrow = Carbon::parse($item['created_at'])->yesterday()->format('Y-m-d');
            $date = Carbon::parse($item['created_at'])->format('Y-m-d');
            if($today == $date) {
                return 'today';
            } elseif($tomorrow == $date) {
                return 'yesterday';
            }
            return Carbon::parse($item['created_at'])->format('jS M, Y');
        })->toArray();

        $this->passphraseHistory = $groupedPassphrases;
    }

    public function render() {
        return view('livewire.dashboard.index');
    }
}
