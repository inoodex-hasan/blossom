<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OurStoryResource\Pages;
use App\Models\OurStory;
use BackedEnum;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
use UnitEnum;

class OurStoryResource extends Resource
{
    protected static ?string $model = OurStory::class;

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-book-open';

    protected static string | UnitEnum | null $navigationGroup = 'Brand Narrative';

    protected static ?string $navigationLabel = 'Brand Story';

    protected static ?string $modelLabel = 'Brand Story';

    protected static ?string $pluralModelLabel = 'Brand Story';

    protected static ?int $navigationSort = 1;

    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Group::make()
                    ->schema([
                        Section::make('Story Identity & Overview')
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label('Story Title')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function (string $operation, $state, $set) {
                                        $set('slug', Str::slug($state));
                                    }),

                                Forms\Components\TextInput::make('slug')
                                    ->label('Slug / URL Key')
                                    ->required()
                                    ->maxLength(255)
                                    ->unique(OurStory::class, 'slug', ignoreRecord: true)
                                    ->disabled(fn (string $operation): bool => $operation === 'view')
                                    ->helperText('Auto-generated from title, or customized if needed.'),

                                Forms\Components\Textarea::make('short_description')
                                    ->label('Short Summary')
                                    ->rows(3)
                                    ->maxLength(500)
                                    ->columnSpanFull(),
                            ])
                            ->columns(2),

                        Section::make('Full Narrative Content')
                            ->schema([
                                Forms\Components\RichEditor::make('content')
                                    ->label('Mission Story')
                                    ->required()
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
                    ])
                    ->columnSpan(['lg' => 2]),

                Group::make()
                    ->schema([
                        Section::make('Hero Banner Image')
                            ->description('Photography representing the brand origin.')
                            ->schema([
                                Forms\Components\Placeholder::make('current_image_preview')
                                    ->label(fn (string $operation): string => $operation === 'view' ? 'Story Banner' : 'Current Banner')
                                    ->content(fn (?OurStory $record, string $operation): ?HtmlString => $record?->image_url ? (
                                        $operation === 'view'
                                            ? new HtmlString('
                                                <div class="rounded-xl overflow-hidden border border-slate-200 dark:border-slate-700 shadow-xs bg-slate-900">
                                                    <img src="' . e($record->image_url) . '" alt="Story Banner" class="w-full h-auto max-h-72 object-cover">
                                                </div>
                                            ')
                                            : new HtmlString('
                                                <div class="inline-flex items-center gap-3 py-1.5 px-3 bg-slate-50 dark:bg-slate-800/60 rounded-xl border border-slate-200 dark:border-slate-700">
                                                    <img src="' . e($record->image_url) . '" alt="Current Photo" class="w-10 h-10 rounded-lg object-cover border border-slate-300 dark:border-slate-600 shadow-xs">
                                                    <div class="text-xs">
                                                        <span class="font-medium text-slate-700 dark:text-slate-200 block truncate max-w-[180px]">' . e(basename($record->image)) . '</span>
                                                        <a href="' . e($record->image_url) . '" target="_blank" class="text-[11px] text-amber-600 dark:text-amber-400 hover:underline">View original &rarr;</a>
                                                    </div>
                                                </div>
                                            ')
                                    ) : null)
                                    ->visible(fn (?OurStory $record) => filled($record?->image))
                                    ->columnSpanFull(),

                                Forms\Components\FileUpload::make('image')
                                    ->label('Banner Photo')
                                    ->image()
                                    ->imageEditor()
                                    ->directory('our-stories')
                                    ->disk('public')
                                    ->visibility('public')
                                    ->maxSize(5120)
                                    ->formatStateUsing(fn () => null)
                                    ->dehydrated(fn ($state) => filled($state))
                                    ->helperText('Drag & drop or browse a new photo to replace the current banner.')
                                    ->columnSpanFull()
                                    ->hidden(fn (string $operation): bool => $operation === 'view')
                                    ->required(fn (string $operation): bool => $operation === 'create'),
                            ]),
                    ])
                    ->columnSpan(['lg' => 1]),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Banner')
                    ->state(fn (OurStory $record) => $record->image_url)
                    ->square(),

                Tables\Columns\TextColumn::make('title')
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('short_description')
                    ->label('Summary')
                    ->limit(60),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->date('M d, Y'),
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
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
            'index' => Pages\ListOurStories::route('/'),
            'view' => Pages\ViewOurStory::route('/{record}'),
            'edit' => Pages\EditOurStory::route('/{record}/edit'),
        ];
    }
}
