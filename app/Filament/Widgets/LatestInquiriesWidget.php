<?php

namespace App\Filament\Widgets;

use App\Models\Inquiry;
use Filament\Actions\Action;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestInquiriesWidget extends BaseWidget
{
    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Inquiry::query()->latest()->limit(5)
            )
            ->heading('Recent Inquiries & Trade Leads')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Client Name')
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('company_name')
                    ->label('Company')
                    ->placeholder('-'),

                Tables\Columns\TextColumn::make('email')
                    ->copyable(),

                Tables\Columns\TextColumn::make('phone')
                    ->placeholder('-'),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'contacted' => 'info',
                        'closed' => 'success',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Date')
                    ->date('M d, Y'),
            ])
            ->actions([
                Action::make('open')
                    ->label('View')
                    ->icon('heroicon-o-eye')
                    ->url(fn (Inquiry $record): string => route('filament.admin.resources.inquiries.view', ['record' => $record])),
            ])
            ->paginated(false);
    }
}
