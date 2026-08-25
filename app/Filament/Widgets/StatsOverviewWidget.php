<?php

namespace App\Filament\Widgets;

use App\Models\ContactMessage;
use App\Models\HeroSlide;
use App\Models\Inquiry;
use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $productsCount = Product::count();
        $inquiriesCount = Inquiry::count();
        $pendingInquiries = Inquiry::where('status', 'pending')->count();
        $messagesCount = ContactMessage::count();
        $unreadMessages = ContactMessage::where('is_read', false)->count();
        $activeSlides = HeroSlide::where('is_active', true)->count();

        return [
            Stat::make('All Products', $productsCount)
                ->description('Active catalog lines')
                ->descriptionIcon('heroicon-m-cube')
                ->color('primary')
                ->chart([3, 5, 6, 8, 10, max(12, $productsCount)]),

            Stat::make('Total Inquiries', $inquiriesCount)
                ->description($pendingInquiries > 0 ? "{$pendingInquiries} awaiting response" : 'All inquiries handled')
                ->descriptionIcon('heroicon-m-briefcase')
                ->color($pendingInquiries > 0 ? 'warning' : 'success')
                ->chart([2, 4, 3, 6, 5, max(7, $inquiriesCount)]),

            Stat::make('Contact Messages', $messagesCount)
                ->description($unreadMessages > 0 ? "{$unreadMessages} unread in inbox" : 'Inbox up to date')
                ->descriptionIcon('heroicon-m-envelope')
                ->color($unreadMessages > 0 ? 'danger' : 'success')
                ->chart([1, 3, 2, 4, 6, max(8, $messagesCount)]),

            Stat::make('Homepage Slides', $activeSlides)
                ->description('Active hero banners')
                ->descriptionIcon('heroicon-m-photo')
                ->color('info'),
        ];
    }
}
