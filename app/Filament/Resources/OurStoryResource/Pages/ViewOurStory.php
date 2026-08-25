<?php

namespace App\Filament\Resources\OurStoryResource\Pages;

use App\Filament\Resources\OurStoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewOurStory extends ViewRecord
{
    protected static string $resource = OurStoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
