<?php

namespace App\Filament\Resources\MixResource\Pages;

use App\Filament\Resources\MixResource;
use App\Models\Mix;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditMix extends EditRecord
{
    protected static string $resource = MixResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('show')
                ->url(route('mixes.show', ['mix' => $this->record])),

            Actions\Action::make('publish')
                ->action(function (Mix $record, $livewire) {
                    $record->update(['published_at' => now()]);

                    Notification::make()
                        ->success()
                        ->title('Successfully published')
                        ->send();
                })
                ->label('Publish'),

            Actions\DeleteAction::make(),
        ];
    }
}
