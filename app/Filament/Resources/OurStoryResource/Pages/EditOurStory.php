<?php

namespace App\Filament\Resources\OurStoryResource\Pages;

use App\Filament\Resources\OurStoryResource;
use Filament\Resources\Pages\EditRecord;

class EditOurStory extends EditRecord
{
    protected static string $resource = OurStoryResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
