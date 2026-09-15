<?php

namespace App\Filament\Pages;

use App\Models\SiteSetting;
use App\Services\ImageService;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\HtmlString;
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
                Section::make('Brand Identity & Visual Assets')
                    ->description('Public store name, tagline, official logo, and browser favicon.')
                    ->schema([
                        Forms\Components\TextInput::make('site_name')
                            ->label('Brand Name')
                            ->default('Sundry Blossom')
                            ->required(),

                        Forms\Components\TextInput::make('site_tagline')
                            ->label('Tagline')
                            ->default('Handcrafted & Sustainable Goods'),

                        Forms\Components\Placeholder::make('current_logo_preview')
                            ->label('Current Brand Logo')
                            ->content(function () {
                                $logo = SiteSetting::get('site_logo');
                                if (!$logo) {
                                    return null;
                                }

                                return new HtmlString('
                                    <div class="inline-flex items-center gap-3 py-2 px-3 bg-slate-50 dark:bg-slate-800/60 rounded-xl border border-slate-200 dark:border-slate-700">
                                        <img src="' . asset('storage/' . $logo) . '" alt="Brand Logo" class="h-10 w-auto max-w-[120px] object-contain rounded border border-slate-300 dark:border-slate-600 bg-white p-1">
                                        <div class="text-xs">
                                            <span class="font-medium text-slate-700 dark:text-slate-200 block truncate max-w-[180px]">' . e(basename($logo)) . '</span>
                                            <a href="' . asset('storage/' . $logo) . '" target="_blank" class="text-[11px] text-amber-600 dark:text-amber-400 hover:underline">View original &rarr;</a>
                                        </div>
                                    </div>
                                ');
                            })
                            ->visible(fn () => filled(SiteSetting::get('site_logo'))),

                        Forms\Components\Placeholder::make('current_favicon_preview')
                            ->label('Current Browser Favicon')
                            ->content(function () {
                                $fav = SiteSetting::get('site_favicon');
                                if (!$fav) {
                                    return null;
                                }

                                return new HtmlString('
                                    <div class="inline-flex items-center gap-3 py-2 px-3 bg-slate-50 dark:bg-slate-800/60 rounded-xl border border-slate-200 dark:border-slate-700">
                                        <img src="' . asset('storage/' . $fav) . '" alt="Favicon" class="w-8 h-8 object-contain rounded border border-slate-300 dark:border-slate-600 bg-white p-0.5">
                                        <div class="text-xs">
                                            <span class="font-medium text-slate-700 dark:text-slate-200 block truncate max-w-[180px]">' . e(basename($fav)) . '</span>
                                            <a href="' . asset('storage/' . $fav) . '" target="_blank" class="text-[11px] text-amber-600 dark:text-amber-400 hover:underline">View original &rarr;</a>
                                        </div>
                                    </div>
                                ');
                            })
                            ->visible(fn () => filled(SiteSetting::get('site_favicon'))),

                        Forms\Components\FileUpload::make('site_logo')
                            ->label('Upload / Replace Brand Logo')
                            ->image()
                            ->imageEditor()
                            ->directory('site-settings')
                            ->disk('public')
                            ->visibility('public')
                            ->maxSize(5120)
                            ->formatStateUsing(fn () => null)
                            ->dehydrated(fn ($state) => filled($state))
                            ->saveUploadedFileUsing(fn (UploadedFile $file): string => app(ImageService::class)->storeAsWebp($file, 'site-settings', 800, 90))
                            ->helperText('Upload a high-resolution logo for header and admin (auto-converted to WebP).')
                            ->hintAction(
                                Action::make('remove_logo')
                                    ->label('Remove Current Logo')
                                    ->icon('heroicon-o-trash')
                                    ->color('danger')
                                    ->requiresConfirmation()
                                    ->visible(fn () => filled(SiteSetting::get('site_logo')))
                                    ->action(function () {
                                        SiteSetting::set('site_logo', null);
                                        Notification::make()->title('Brand logo removed')->success()->send();
                                    })
                            ),

                        Forms\Components\FileUpload::make('site_favicon')
                            ->label('Upload / Replace Favicon')
                            ->image()
                            ->directory('site-settings')
                            ->disk('public')
                            ->visibility('public')
                            ->maxSize(2048)
                            ->formatStateUsing(fn () => null)
                            ->dehydrated(fn ($state) => filled($state))
                            ->helperText('Upload a browser tab icon (.ico, .png, .svg, .webp).')
                            ->hintAction(
                                Action::make('remove_favicon')
                                    ->label('Remove Current Favicon')
                                    ->icon('heroicon-o-trash')
                                    ->color('danger')
                                    ->requiresConfirmation()
                                    ->visible(fn () => filled(SiteSetting::get('site_favicon')))
                                    ->action(function () {
                                        SiteSetting::set('site_favicon', null);
                                        Notification::make()->title('Favicon removed')->success()->send();
                                    })
                            ),
                    ])
                    ->columns(2),

                Section::make('SEO & Social Share Metadata')
                    ->description('Meta descriptions, search keywords, and Open Graph previews for Google, WhatsApp, LinkedIn, and Twitter.')
                    ->schema([
                        Forms\Components\Textarea::make('site_description')
                            ->label('Meta Description')
                            ->rows(3)
                            ->default('Sundry Blossom connects skilled artisans and sustainable craftsmanship with global trade partners. Explore our curated collections of handcrafted textiles, home decor, and natural goods.')
                            ->helperText('Search snippet displayed on Google search results (150-160 characters recommended).'),

                        Forms\Components\TextInput::make('site_keywords')
                            ->label('Meta Keywords')
                            ->default('handcrafted goods, sustainable textiles, artisan homeware, trade inquiry, ethical sourcing, Sundry Blossom')
                            ->helperText('Comma-separated SEO keywords.'),
                    ])
                    ->columns(1),

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
            if ($value !== null) {
                SiteSetting::set($key, is_array($value) ? (reset($value) ?: null) : $value);
            }
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
