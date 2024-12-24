<?php

namespace App\Livewire\Dashboard;

use App\Models\Passphrase;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class History extends Component {
    public $passphraseHistory = [];
    public $viewingOnHistory = false;
    public $count = 10;
    #[Url()] 
    public $page = '';

    #[On('append-passphrase')] 
    public function updateSize($data) {
       // Add the newly generated passphrase to today's group
        if (!isset($this->passphraseHistory['today'])) {
            $this->passphraseHistory['today'] = [];
        }

        array_unshift($this->passphraseHistory['today'], $data);
    }

    public function deletePhrase($id) {
        Passphrase::where([
            'user_id' => Auth::id(),
            'id' => $id
        ])->forceDelete();
    }

    public function mount($count = 10, $history = false) {
        $this->count = $count;
        $this->viewingOnHistory = $history;
        // Fetch passphrases for the authenticated user
        $passphrases = Passphrase::where('user_id', Auth::id())
            ->select('passphrase', 'created_at', 'id')
            ->orderBy('created_at', 'desc')
            ->paginate($count);

        // group them by day
        $groupedPassphrases = $passphrases->map(function ($item) {
            return [
                'passphrase' => json_decode($item->passphrase, true),
                'created_at' => $item->created_at,
                'id' => $item->id
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
        $phrase = Passphrase::where('user_id', Auth::id())
            ->select('passphrase', 'created_at', 'id')
            ->orderBy('created_at', 'desc')
            ->paginate($this->count);

        // dd($passphrases);
        return view('livewire.dashboard.history', compact('phrase'));
    }
}
