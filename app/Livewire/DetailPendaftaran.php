<?php

namespace App\Livewire;

use App\Models\Pengaturan;
use App\Models\Siswa;
use App\Models\UangPangkal;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class DetailPendaftaran extends Component
{
    use WithFileUploads;

    public Siswa $siswa;
    public $pasFoto;
    public $aktaKelahiran;
    public $kartuKeluarga;
    public $uangPangkal;
    public $rekening;
    public $buktiBayar;

    public function mount($no_pendaftaran)
    {
        $siswa = Siswa::with(['berkas', 'orangtua'])->where('no_pendaftaran', $no_pendaftaran)->firstOrFail();
        if ($siswa->user_id !== auth()->id())
            abort(404);
        $this->siswa = $siswa;
        $this->uangPangkal = UangPangkal::get();
        $this->rekening = Pengaturan::first();
    }

    public function resetForm()
    {
        $this->reset(['pasFoto', 'aktaKelahiran', 'kartuKeluarga']);
        $this->resetErrorBag();
    }

    public function simpanFoto()
    {
        if ($this->pasFoto) {
            $this->validate([
                'pasFoto' => 'image|mimes:jpg,jpeg|max:1024'
            ], [
                'mimes' => 'Format file salah.',
                'max' => 'Ukuran file terlalu besar.',
                'image' => 'File harus berupa gambar.'
            ], [
                'pasFoto' => 'Pas foto',
            ]);
            // hapus file lama kalau ada
            if ($this->siswa->berkas && $this->siswa->berkas->pas_foto) {
                Storage::delete($this->siswa->berkas->pas_foto);
            }

            // simpan file baru dengan nama random
            $path = $this->pasFoto->store("berkas-siswa/{$this->siswa->no_pendaftaran}");

            // update path di database
            $this->siswa->berkas->update([
                'pas_foto' => $path
            ]);
        }
        $this->resetForm();
        $this->modal('gantifoto')->close();
        $this->dispatch('show-notification', type: 'success', message: 'Berhasil mengganti foto');
        return $this->dispatch('$refresh');
    }

    public function simpanBerkas()
    {
        if ($this->aktaKelahiran) {
            $this->validate([
                'aktaKelahiran' => 'mimes:pdf|max:1024'
            ], [
                'mimes' => 'Format file salah.',
                'max' => 'Ukuran file terlalu besar.',
            ]);

            // hapus file lama kalau ada
            if ($this->siswa->berkas && $this->siswa->berkas->akta_kelahiran) {
                Storage::delete($this->siswa->berkas->akta_kelahiran);
            }

            // simpan file baru dengan nama random
            $path = $this->aktaKelahiran->store("berkas-siswa/{$this->siswa->no_pendaftaran}");

            // update path di database
            $this->siswa->berkas->update([
                'akta_kelahiran' => $path
            ]);
        }
        if ($this->kartuKeluarga) {
            $this->validate([
                'kartuKeluarga' => 'mimes:pdf|max:1024'
            ], [
                'mimes' => 'Format file salah.',
                'max' => 'Ukuran file terlalu besar.',
            ]);

            // hapus file lama kalau ada
            if ($this->siswa->berkas && $this->siswa->berkas->kartu_keluarga) {
                Storage::delete($this->siswa->berkas->kartu_keluarga);
            }

            // simpan file baru dengan nama random
            $path = $this->kartuKeluarga->store("berkas-siswa/{$this->siswa->no_pendaftaran}");

            // update path di database
            $this->siswa->berkas->update([
                'kartu_keluarga' => $path
            ]);
        }
        $this->resetForm();
        $this->modal('berkas')->close();
        $this->dispatch('show-notification', type: 'success', message: 'Berhasil menyimpan berkas');
        return $this->dispatch('$refresh');
    }

    public function simpanBuktiBayar()
    {
        if ($this->buktiBayar) {
            $this->validate([
                'buktiBayar' => 'image|mimes:jpg,jpeg|max:1024'
            ], [
                'mimes' => 'Format file salah.',
                'max' => 'Ukuran file terlalu besar.',
                'image' => 'File harus berupa gambar.'
            ]);

            // hapus file lama kalau ada
            if ($this->siswa->berkas && $this->siswa->berkas->bukti_bayar) {
                Storage::delete($this->siswa->berkas->bukti_bayar);
            }

            // simpan file baru dengan nama random
            $path = $this->buktiBayar->store("berkas-siswa/{$this->siswa->no_pendaftaran}");

            // update path di database
            $this->siswa->berkas->update([
                'bukti_bayar' => $path
            ]);
            $this->resetForm();
            $this->modal('buktibayar')->close();
            $this->dispatch('show-notification', type: 'success', message: 'Berhasil mengupload bukti pembayaran');
            return $this->dispatch('$refresh');
        }
    }

    public function render()
    {
        return view('livewire.detail-pendaftaran');
    }
}
