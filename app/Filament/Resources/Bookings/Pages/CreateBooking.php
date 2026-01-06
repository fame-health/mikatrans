<?php

namespace App\Filament\Resources\Bookings\Pages;

use App\Filament\Resources\Bookings\BookingResource;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Document;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;

class CreateBooking extends CreateRecord
{
    protected static string $resource = BookingResource::class;

    protected function afterCreate(): void
    {
        $record = $this->record;
        $directory = storage_path('app/public/documents');

        if (!file_exists($directory)) {
            mkdir($directory, 0777, true, true);
        }

        try {
            if ($record->payment_status === 'dp_paid') {
                // Generate Kwitansi DP
                $pdf = Pdf::loadView('pdf.kwintansi_dp', ['booking' => $record]);
                $fileName = 'kwitansi_dp_' . $record->booking_code . '.pdf';
                $pdf->save($directory . '/' . $fileName);

                Document::create([
                    'booking_id' => $record->id,
                    'type' => 'receipt',
                    'file_name' => $fileName,
                    'file_path' => 'public/documents/' . $fileName,
                    'generated_by' => Auth::id(),
                ]);

                Notification::make()
                    ->title('Berhasil')
                    ->body('Kwitansi DP berhasil dibuat.')
                    ->success()
                    ->send();
            }

            if ($record->payment_status === 'fully_paid') {
                // Generate Kwitansi Lunas
                $pdf = Pdf::loadView('pdf.kwintansi_lunas', ['booking' => $record]);
                $fileName = 'kwitansi_lunas_' . $record->booking_code . '.pdf';
                $pdf->save($directory . '/' . $fileName);

                Document::create([
                    'booking_id' => $record->id,
                    'type' => 'receipt',
                    'file_name' => $fileName,
                    'file_path' => 'public/documents/' . $fileName,
                    'generated_by' => Auth::id(),
                ]);

                // Generate Surat Jalan
                $pdf2 = Pdf::loadView('pdf.surat_jalan', ['booking' => $record]);
                $fileName2 = 'surat_jalan_' . $record->booking_code . '.pdf';
                $pdf2->save($directory . '/' . $fileName2);

                Document::create([
                    'booking_id' => $record->id,
                    'type' => 'travel_permit',
                    'file_name' => $fileName2,
                    'file_path' => 'public/documents/' . $fileName2,
                    'generated_by' => Auth::id(),
                ]);

                Notification::make()
                    ->title('Berhasil')
                    ->body('Kwitansi Lunas & Surat Jalan berhasil dibuat.')
                    ->success()
                    ->send();
            }
        } catch (\Exception $e) {
            Notification::make()
                ->title('Gagal')
                ->body('Terjadi kesalahan saat generate PDF: ' . $e->getMessage())
                ->danger()
                ->send();
        }
    }
}
