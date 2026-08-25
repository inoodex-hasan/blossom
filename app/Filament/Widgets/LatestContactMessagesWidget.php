<?php

namespace App\Filament\Widgets;

use App\Models\ContactMessage;
use Filament\Actions\Action;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestContactMessagesWidget extends BaseWidget
{
    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                ContactMessage::query()->latest()->limit(5)
            )
            ->heading('Recent Customer Messages')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Sender')
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('email')
                    ->copyable(),

                Tables\Columns\TextColumn::make('message')
                    ->label('Message Snippet')
                    ->limit(65)
                    ->placeholder('-'),

                Tables\Columns\IconColumn::make('is_read')
                    ->label('Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-envelope')
                    ->trueColor('success')
                    ->falseColor('warning'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Date')
                    ->date('M d, Y'),
            ])
            ->actions([
                Action::make('open')
                    ->label('View')
                    ->icon('heroicon-o-eye')
                    ->url(fn (ContactMessage $record): string => route('filament.admin.resources.contact-messages.view', ['record' => $record])),
            ])
            ->paginated(false);
    }
}
