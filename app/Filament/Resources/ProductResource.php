<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
use UnitEnum;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-cube';

    protected static string | UnitEnum | null $navigationGroup = 'Catalog';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Basic Information')
                    ->description('General collection title, slug, and photo.')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Product Name')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (string $operation, $state, $set) {
                                if ($operation === 'create') {
                                    $set('slug', Str::slug($state));
                                }
                            }),

                        Forms\Components\TextInput::make('slug')
                            ->label('URL Slug')
                            ->maxLength(255)
                            ->unique(Product::class, 'slug', ignoreRecord: true)
                            ->visible(fn (string $operation): bool => $operation !== 'create')
                            ->disabled(fn (string $operation): bool => $operation === 'view')
                            ->helperText('Auto-generated URL identifier.'),

                        Forms\Components\Placeholder::make('current_image_preview')
                            ->label(fn (string $operation): string => $operation === 'view' ? 'Collection Thumbnail' : 'Current Photo')
                            ->content(fn (?Product $record, string $operation): ?HtmlString => $record?->image_url ? (
                                $operation === 'view'
                                    ? new HtmlString('
                                        <div class="rounded-2xl overflow-hidden border border-slate-200 dark:border-slate-700 shadow-sm max-w-sm bg-slate-900">
                                            <img src="' . e($record->image_url) . '" alt="Collection Thumbnail" class="w-full h-48 object-cover">
                                        </div>
                                    ')
                                    : new HtmlString('
                                        <div class="inline-flex items-center gap-3 py-1.5 px-3 bg-slate-50 dark:bg-slate-800/60 rounded-xl border border-slate-200 dark:border-slate-700">
                                            <img src="' . e($record->image_url) . '" alt="Current Photo" class="w-10 h-10 rounded-lg object-cover border border-slate-300 dark:border-slate-600 shadow-xs">
                                            <div class="text-xs">
                                                <span class="font-medium text-slate-700 dark:text-slate-200 block truncate max-w-[220px]">' . e(basename($record->image)) . '</span>
                                                <a href="' . e($record->image_url) . '" target="_blank" class="text-[11px] text-amber-600 dark:text-amber-400 hover:underline">View original &rarr;</a>
                                            </div>
                                        </div>
                                    ')
                            ) : null)
                            ->visible(fn (?Product $record) => filled($record?->image))
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('image')
                            ->label('Upload / Replace Photo')
                            ->image()
                            ->imageEditor()
                            ->directory('products')
                            ->disk('public')
                            ->visibility('public')
                            ->maxSize(5120)
                            ->formatStateUsing(fn () => null)
                            ->dehydrated(fn ($state) => filled($state))
                            ->helperText('Drag & drop or browse to replace the current photo.')
                            ->columnSpanFull()
                            ->hidden(fn (string $operation): bool => $operation === 'view'),

                        Forms\Components\Textarea::make('description')
                            ->label('Short Description')
                            ->rows(3)
                            ->columnSpanFull()
                            ->helperText('Brief teaser displayed on product collection cards.'),
                    ])
                    ->columns(2),

                Section::make('Collection Narrative')
                    ->description('Detailed backstory, artisan craftsmanship, and materials.')
                    ->schema([
                        Forms\Components\RichEditor::make('long_description')
                            ->label('Detailed Story')
                            ->toolbarButtons([
                                'bold',
                                'italic',
                                'link',
                                'bulletList',
                                'orderedList',
                                'blockquote',
                                'h2',
                                'h3',
                                'undo',
                                'redo',
                            ])
                            ->columnSpanFull(),
                    ]),

                Section::make('Bullet Lists & Specifications')
                    ->description('Tags for key highlights, styling care, and trade partnership terms.')
                    ->schema([
                        Forms\Components\TagsInput::make('highlights')
                            ->label('Key Highlights')
                            ->placeholder('Type item and press Enter')
                            ->helperText('Main selling points and varieties.')
                            ->columnSpanFull(),

                        Forms\Components\TagsInput::make('style_guidance')
                            ->label('Style Guidance & Care')
                            ->placeholder('Type item and press Enter')
                            ->helperText('Care instructions and usage recommendations.')
                            ->columnSpanFull(),

                        Forms\Components\TagsInput::make('partnerships')
                            ->label('Trade Partnerships')
                            ->placeholder('Type item and press Enter')
                            ->helperText('B2B wholesale terms, lead times, custom options.')
                            ->columnSpanFull(),
                    ])
                    ->columns(1)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Thumbnail')
                    ->state(fn (Product $record) => $record->image_url)
                    ->square(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Collection')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('slug')
                    ->fontFamily('mono')
                    ->copyable()
                    ->color('gray'),

                Tables\Columns\TextColumn::make('highlights')
                    ->label('Highlights Count')
                    ->badge()
                    ->color('info')
                    ->state(fn (Product $record) => count($record->highlights ?? []) . ' items'),

                Tables\Columns\TextColumn::make('created_at')
                    ->date('M d, Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'view' => Pages\ViewProduct::route('/{record}'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
