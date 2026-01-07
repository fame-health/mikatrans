<div class="bg-white p-6 rounded-2xl shadow-md max-w-lg mx-auto">

@if(session()->has('success'))
    <div class="mb-4 text-green-600">
        <strong>{{ session('success') }}</strong>
    </div>
@endif


    <h3 class="text-lg font-bold mb-4">Form Booking Travel</h3>

    <form wire:submit.prevent="submitBooking">
        @if($step == 1)
            <!-- Step 1: Customer Info -->
            <div class="mb-3">
                <label>Nama Penumpang</label>
                <input type="text" wire:model="nama_penumpang" class="w-full px-3 py-2 border rounded-lg">
                @error('nama_penumpang') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <label>Nomor HP</label>
                <input type="text" wire:model="nomor_hp" class="w-full px-3 py-2 border rounded-lg">
                @error('nomor_hp') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <label>Tanggal Booking</label>
                <input type="date" wire:model="tanggal_booking" class="w-full px-3 py-2 border rounded-lg">
                @error('tanggal_booking') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <label>Jadwal Berangkat</label>
                <select wire:model="jadwal_berangkat" class="w-full px-3 py-2 border rounded-lg">
                    <option value="">Pilih Jadwal</option>
                    @foreach(\App\Models\BookingTravel::getSchedules() as $schedule)
                        <option value="{{ $schedule }}">
                            {{ $schedule == 'PAGI' ? 'Pagi - 10.00 WIB' : 'Malam - 21.00 WIB' }}
                        </option>
                    @endforeach
                </select>
                @error('jadwal_berangkat') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <label>Alamat Penjemputan</label>
                <textarea wire:model="alamat_penjemputan" class="w-full px-3 py-2 border rounded-lg" rows="3"></textarea>
                @error('alamat_penjemputan') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <label>Tujuan</label>
                <select wire:model="tujuan" class="w-full px-3 py-2 border rounded-lg">
                    <option value="">Pilih Tujuan</option>
                    <option value="Tembilahan">Tembilahan</option>
                    <option value="Pekanbaru">Pekanbaru</option>
                </select>
                @error('tujuan') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mt-4 text-right">
                <button type="button" wire:click="nextStep" class="gradient-accent px-4 py-2 rounded-lg">Next →</button>
            </div>
        @endif

        @if($step == 2)
            <!-- Step 2: Pilih Kursi -->
            <div class="mb-3">
                <label>No Kursi</label>
                <select wire:model="no_kursi" class="w-full px-3 py-2 border rounded-lg" @if(!$availableSeats) disabled @endif>
                    <option value="">Pilih Kursi</option>
                    @foreach($availableSeats as $seat)
                        <option value="{{ $seat }}">Kursi {{ $seat }}</option>
                    @endforeach
                </select>
                @error('no_kursi') <span class="text-red-500">{{ $message }}</span> @enderror

                @if(!$availableSeats)
                    <p class="text-sm text-gray-500 mt-1">Semua kursi telah terisi.</p>
                @endif

                <div wire:loading wire:target="tanggal_booking,jadwal_berangkat" class="text-sm text-gray-500 mt-1">
                    Memuat kursi tersedia...
                </div>
            </div>

            <div class="mt-4 flex justify-between">
                <button type="button" wire:click="$set('step', 1)" class="px-4 py-2 border rounded-lg">← Back</button>
                <button type="submit" class="gradient-accent px-4 py-2 rounded-lg">Submit</button>
            </div>
        @endif
    </form>
</div>
