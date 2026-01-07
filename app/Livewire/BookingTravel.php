<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\BookingTravel as BookingModel;
use Illuminate\Support\Facades\Auth;

class BookingTravel extends Component
{
    public $step = 1; // step form
    public $nama_penumpang;
    public $nomor_hp;
    public $tanggal_booking;
    public $jadwal_berangkat;
    public $no_kursi;
    public $alamat_penjemputan;
    public $tujuan;
    public $status;

    public $availableSeats = [];

    public function mount()
    {
        $this->status = BookingModel::STATUS_PROCESSS;
    }

    public function render()
    {
        return view('livewire.booking-travel');
    }

    // Step 1: trigger load kursi setelah klik Next
    public function nextStep()
    {
        $this->validate([
            'nama_penumpang' => 'required|string|max:255',
            'nomor_hp' => 'required|string|max:20',
            'tanggal_booking' => 'required|date',
            'jadwal_berangkat' => 'required|in:' . implode(',', BookingModel::getSchedules()),
            'alamat_penjemputan' => 'required|string|max:500',
            'tujuan' => 'required|string|in:Tembilahan,Pekanbaru',
        ]);

        $this->loadAvailableSeats();
        $this->step = 2;
    }

    // Ambil kursi tersedia
    public function loadAvailableSeats()
    {
        if (!$this->tanggal_booking || !$this->jadwal_berangkat) {
            $this->availableSeats = [];
            return;
        }

        $usedSeats = BookingModel::where('tanggal_booking', $this->tanggal_booking)
            ->where('jadwal_berangkat', $this->jadwal_berangkat)
            ->pluck('no_kursi')
            ->toArray();

        $this->availableSeats = array_diff(range(1, 10), $usedSeats);
    }

    // Submit Step 2
    public function submitBooking()
    {
        $validated = $this->validate([
            'nama_penumpang' => 'required|string|max:255',
            'nomor_hp' => 'required|string|max:20',
            'tanggal_booking' => 'required|date',
            'jadwal_berangkat' => 'required|in:' . implode(',', BookingModel::getSchedules()),
            'no_kursi' => 'required|integer|min:1|max:10',
            'alamat_penjemputan' => 'required|string|max:500',
            'tujuan' => 'required|string|in:Tembilahan,Pekanbaru',
        ]);

        BookingModel::create([
            'user_id' => Auth::id(),
            'nama_penumpang' => $validated['nama_penumpang'],
            'nomor_hp' => $validated['nomor_hp'],
            'tanggal_booking' => $validated['tanggal_booking'],
            'jadwal_berangkat' => $validated['jadwal_berangkat'],
            'no_kursi' => $validated['no_kursi'],
            'alamat_penjemputan' => $validated['alamat_penjemputan'],
            'tujuan' => $validated['tujuan'],
            'status' => $this->status,
        ]);

        session()->flash('success', 'Booking berhasil dibuat!');
        $this->resetExcept('status');
        $this->step = 1;
        $this->availableSeats = [];
    }
}
