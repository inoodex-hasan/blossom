<?php

namespace App\Filament\Pages;

use App\Models\SiteSetting;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use UnitEnum;

class ManageSiteSettings extends Page
{
    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string | UnitEnum | null $navigationGroup = 'Store Configuration';

    protected static ?string $navigationLabel = 'Site Settings';

    protected static ?string $title = 'Store & Contact Settings';

    protected string $view = 'filament.pages.manage-site-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill(SiteSetting::allAsArray());
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Brand Identity')
                    ->description('Public store name and branding tagline.')
                    ->schema([
                        Forms\Components\TextInput::make('site_name')
                            ->label('Brand Name')
                            ->default('Sundry Blossom')
                            ->required(),

                        Forms\Components\TextInput::make('site_tagline')
                            ->label('Tagline')
                            ->default('Handcrafted & Sustainable Goods'),
                    ])
                    ->columns(2),

                Section::make('Communication Channels')
                    ->description('Contact numbers, official email, working hours, and physical address.')
                    ->schema([
                        Forms\Components\TextInput::make('contact_phone')
                            ->label('Phone (Dial Link / Tel)')
                            ->default('+880 4767 775689'),

                        Forms\Components\TextInput::make('contact_phone_display')
                            ->label('Phone (Display Text)')
                            ->default('04767775689'),

                        Forms\Components\TextInput::make('contact_email')
                            ->label('Official Email Address')
                            ->email()
                            ->default('sundryblossom@gmail.com')
                            ->required(),

                        Forms\Components\TextInput::make('contact_hours')
                            ->label('Working Hours')
                            ->default('Mon - Fri, 9am - 6pm'),

                        Forms\Components\TextInput::make('contact_response_time')
                            ->label('Response Time Notice')
                            ->default('We reply within 24 hours'),

                        Forms\Components\TextInput::make('contact_address')
                            ->label('Physical Location / City')
                            ->default('Dhaka, Bangladesh'),
                    ])
                    ->columns(2),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $state = $this->form->getState();

        foreach ($state as $key => $value) {
            SiteSetting::set($key, $value);
        }

        Notification::make()
            ->title('Settings saved successfully')
            ->success()
            ->send();
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Save All Settings')
                ->submit('save'),
        ];
    }
}
