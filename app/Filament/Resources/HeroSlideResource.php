<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HeroSlideResource\Pages;
use App\Models\HeroSlide;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;
use UnitEnum;

class HeroSlideResource extends Resource
{
    protected static ?string $model = HeroSlide::class;

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-photo';

    protected static string | UnitEnum | null $navigationGroup = 'Brand Narrative';

    protected static ?string $modelLabel = 'Hero Slide';

    protected static ?string $pluralModelLabel = 'Hero Slides';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Slide Image & Text')
                    ->description('High-resolution banner photo and overlay captions.')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Slide Headline')
                            ->placeholder('e.g. Sundry Blossom')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('subtitle')
                            ->label('Sub-headline / Caption')
                            ->placeholder('e.g. Handcrafted & Sustainable Goods')
                            ->maxLength(255),

                        Forms\Components\Placeholder::make('current_image_preview')
                            ->label(fn (string $operation): string => $operation === 'view' ? 'Slide Banner' : 'Current Slide Banner')
                            ->content(fn (?HeroSlide $record, string $operation): ?HtmlString => $record?->image_url ? (
                                $operation === 'view'
                                    ? new HtmlString('
                                        <div class="rounded-2xl overflow-hidden border border-slate-200 dark:border-slate-700 shadow-sm max-w-2xl bg-slate-900">
                                            <img src="' . e($record->image_url) . '" alt="Slide Banner" class="w-full h-52 object-cover">
                                        </div>
                                    ')
                                    : new HtmlString('
                                        <div class="inline-flex items-center gap-3 py-1.5 px-3 bg-slate-50 dark:bg-slate-800/60 rounded-xl border border-slate-200 dark:border-slate-700">
                                            <img src="' . e($record->image_url) . '" alt="Current Slide" class="w-16 h-10 rounded-lg object-cover border border-slate-300 dark:border-slate-600 shadow-xs">
                                            <div class="text-xs">
                                                <span class="font-medium text-slate-700 dark:text-slate-200 block truncate max-w-[220px]">' . e(basename($record->image)) . '</span>
                                                <a href="' . e($record->image_url) . '" target="_blank" class="text-[11px] text-amber-600 dark:text-amber-400 hover:underline">View original &rarr;</a>
                                            </div>
                                        </div>
                                    ')
                            ) : null)
                            ->visible(fn (?HeroSlide $record) => filled($record?->image))
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('image')
                            ->label('Banner Photo')
                            ->image()
                            ->imageEditor()
                            ->directory('hero-slides')
                            ->disk('public')
                            ->visibility('public')
                            ->maxSize(5120)
                            ->formatStateUsing(fn () => null)
                            ->dehydrated(fn ($state) => filled($state))
                            ->helperText('Drag & drop or browse a 1920x800 high-res banner photo.')
                            ->columnSpanFull()
                            ->hidden(fn (string $operation): bool => $operation === 'view')
                            ->required(fn (string $operation): bool => $operation === 'create'),
                    ])
                    ->columns(2),

                Section::make('Call to Action & Display Options')
                    ->schema([
                        Forms\Components\TextInput::make('link_url')
                            ->label('Button Link URL')
                            ->placeholder('e.g. /products or /inquiry')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('link_text')
                            ->label('Button Text')
                            ->placeholder('e.g. Explore Collections')
                            ->default('Explore Collections')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('sort_order')
                            ->label('Sort Order')
                            ->numeric()
                            ->default(0)
                            ->helperText('Lower numbers appear first (0, 1, 2, ...).'),

                        Forms\Components\Toggle::make('is_active')
                            ->label('Active / Visible')
                            ->default(true)
                            ->inline(false),
                    ])
                    ->columns(4),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Banner')
                    ->state(fn (HeroSlide $record) => $record->image_url)
                    ->square(),

                Tables\Columns\TextColumn::make('title')
                    ->label('Headline')
                    ->searchable()
                    ->weight('bold')
                    ->placeholder('-'),

                Tables\Columns\TextColumn::make('subtitle')
                    ->label('Subtitle')
                    ->limit(40)
                    ->placeholder('-'),

                Tables\Columns\TextColumn::make('link_url')
                    ->label('Target Link')
                    ->fontFamily('mono')
                    ->placeholder('-'),

                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Order')
                    ->sortable()
                    ->alignCenter(),

                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Active')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('sort_order', 'asc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHeroSlides::route('/'),
            'create' => Pages\CreateHeroSlide::route('/create'),
            'edit' => Pages\EditHeroSlide::route('/{record}/edit'),
        ];
    }
}
