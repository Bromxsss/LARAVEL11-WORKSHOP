<?php

namespace App\Filament\Resources\BookingTransactionResource\Pages;

use Filament\Actions;
use Illuminate\Support\Facades\DB;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\BookingTransactionResource;
use App\Models\WorkshopParticipant;

class CreateBookingTransaction extends CreateRecord
{
    protected static string $resource = BookingTransactionResource::class;

    protected function afterCreate(): void 
    {
        DB::transaction(function () {
            // Create a new booking transaction
            $record = $this->record;
            $participants = $this->form->getState() ['participants'];

            // iterate over each participant and create a  record in the workshop_participants table
            foreach ($participants as $participant) {
                WorkshopParticipant::create([
                    'workshop_id' => $record->workshop_id,
                    'booking_transaction_id' => $record->id,
                    'name' => $participant ['name'],
                    'occupation' => $participant ['occupation'],
                    'email' => $participant ['email'],
                ]);
            }
        });
    }
}
