<?php

namespace App\Filament\Resources\Bookings\Pages;

use App\Filament\Resources\Bookings\BookingResource;
use App\Models\Document;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ViewBooking extends ViewRecord
{
    protected static string $resource = BookingResource::class;

    protected function getHeaderActions(): array
    {
        $headerActions = [
            EditAction::make(),
        ];

        /* ================= GENERATE DP (POPUP) ================= */
        if ($this->record->payment_status === 'unpaid') {
            $headerActions[] = Action::make('generate_dp')
                ->label('Generate Kwitansi DP')
                ->color('primary')
                ->icon('heroicon-o-currency-dollar')
                ->modalHeading('Input Pembayaran DP')
                ->modalSubmitActionLabel('Generate Kwitansi')
                ->schema([
                    TextInput::make('total_price')
                        ->label('Total Harga')
                        ->prefix('Rp')
                        ->default($this->record->total_price)
                        ->disabled()
                        ->dehydrated(false),

                    TextInput::make('dp_amount')
                        ->label('Jumlah DP')
                        ->numeric()
                        ->prefix('Rp')
                        ->required()
                        ->minValue(1000)
                        ->rule(fn (callable $get) =>
                            'max:' . ((int) $get('total_price'))
                        )
                        ->afterStateUpdated(function (callable $get, callable $set, $state) {
                            $total = (int) $get('total_price');
                            $dp    = (int) $state;

                            $set('remaining_amount', max($total - $dp, 0));
                        }),

                    TextInput::make('remaining_amount')
                        ->label('Sisa Pembayaran')
                        ->prefix('Rp')
                        ->disabled()
                        ->dehydrated(false),
                ])
                ->action(function (array $data) {
                    $this->generateDocument('dp', $data);
                });
        }

        /* ================= GENERATE LUNAS & SURAT JALAN ================= */
        if (in_array($this->record->payment_status, ['unpaid', 'dp_paid'])) {
            $headerActions[] = Action::make('generate_lunas')
                ->label('Generate Lunas & Surat Jalan')
                ->color('success')
                ->icon('heroicon-o-currency-dollar')
                ->requiresConfirmation()
                ->action(fn () => $this->generateDocument('lunas_surat'));
        }

        /* ================= VIEW GENERATED DOCUMENTS ================= */
        $documents = Document::where('booking_id', $this->record->id)->get();

        foreach ($documents as $doc) {
            $label = match ($doc->type) {
                'receipt' => str_contains($doc->file_name, 'dp')
                    ? 'Kwitansi DP'
                    : 'Kwitansi Lunas',
                'travel_permit' => 'Surat Jalan',
                default => 'Dokumen',
            };

            $headerActions[] = Action::make('view_' . $doc->id)
                ->label($label)
                ->icon('heroicon-o-eye')
                ->url(Storage::url(str_replace('public/', '', $doc->file_path)))
                ->openUrlInNewTab()
                ->button();
        }

        return $headerActions;
    }

    /* ================= DOCUMENT GENERATOR ================= */
    protected function generateDocument(string $type, array $data = [])
    {
        try {
            $directory = storage_path('app/public/documents');
            if (!file_exists($directory)) {
                mkdir($directory, 0777, true);
            }

            /* ===== DP ===== */
            if ($type === 'dp') {
                $dpAmount = (int) $data['dp_amount'];

                $this->record->update([
                    'payment_status' => 'dp_paid',
                    'dp_amount'      => $dpAmount, // pastikan kolom ada
                ]);

                $pdf = Pdf::loadView('pdf.kwintansi_dp', [
                    'booking'  => $this->record,
                    'dpAmount' => $dpAmount,
                ]);

                $fileName = 'kwitansi_dp_' . $this->record->booking_code . '.pdf';
                $pdf->save($directory . '/' . $fileName);

                Document::create([
                    'booking_id'   => $this->record->id,
                    'type'         => 'receipt',
                    'file_name'    => $fileName,
                    'file_path'    => 'public/documents/' . $fileName,
                    'generated_by' => Auth::id(),
                ]);

                $message = 'Kwitansi DP berhasil dibuat.';
            }

            /* ===== LUNAS + SURAT JALAN ===== */
            if ($type === 'lunas_surat') {
                $this->record->update([
                    'payment_status' => 'fully_paid',
                ]);

                // Kwitansi Lunas
                $kwitansiPdf = Pdf::loadView('pdf.kwintansi_lunas', [
                    'booking' => $this->record,
                ]);

                $kwitansiFile = 'kwitansi_lunas_' . $this->record->booking_code . '.pdf';
                $kwitansiPdf->save($directory . '/' . $kwitansiFile);

                Document::create([
                    'booking_id'   => $this->record->id,
                    'type'         => 'receipt',
                    'file_name'    => $kwitansiFile,
                    'file_path'    => 'public/documents/' . $kwitansiFile,
                    'generated_by' => Auth::id(),
                ]);

                // Surat Jalan
                $suratPdf = Pdf::loadView('pdf.surat_jalan', [
                    'booking' => $this->record,
                ]);

                $suratFile = 'surat_jalan_' . $this->record->booking_code . '.pdf';
                $suratPdf->save($directory . '/' . $suratFile);

                Document::create([
                    'booking_id'   => $this->record->id,
                    'type'         => 'travel_permit',
                    'file_name'    => $suratFile,
                    'file_path'    => 'public/documents/' . $suratFile,
                    'generated_by' => Auth::id(),
                ]);

                $message = 'Kwitansi Lunas & Surat Jalan berhasil dibuat.';
            }

            $this->record->refresh();

            Notification::make()
                ->title('Berhasil')
                ->body($message)
                ->success()
                ->send();

        } catch (\Exception $e) {
            Notification::make()
                ->title('Gagal')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }
}

