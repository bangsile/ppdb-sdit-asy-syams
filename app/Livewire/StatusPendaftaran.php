<?php

namespace App\Livewire;

use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class StatusPendaftaran extends Component
{
    public $siswa;

    public function mount()
    {
        $this->siswa = Siswa::with(['berkas'])->where('user_id', Auth::id())->get();
    }

    public function render()
    {
        return view('livewire.status-pendaftaran');
    }
}
