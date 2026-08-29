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
        $contactedInquiries = Inquiry::where('status', 'contacted')->count();
        $closedInquiries = Inquiry::where('status', 'closed')->count();
        $messagesCount = ContactMessage::count();
        $unreadMessages = ContactMessage::where('is_read', false)->count();
        $activeSlides = HeroSlide::where('is_active', true)->count();

        return [
            Stat::make('All Products', $productsCount)
                ->description('Handcrafted catalog lines')
                ->descriptionIcon('heroicon-m-cube')
                ->color('primary')
                ->chart([3, 6, 8, 9, 12, max(14, $productsCount)])
                ->url(route('filament.admin.resources.products.index')),

            Stat::make('Total Inquiries', $inquiriesCount)
                ->description($pendingInquiries > 0 ? "{$pendingInquiries} awaiting response" : ($inquiriesCount > 0 ? 'All handled' : 'No inquiries yet'))
                ->descriptionIcon($pendingInquiries > 0 ? 'heroicon-m-clock' : 'heroicon-m-check-circle')
                ->color($pendingInquiries > 0 ? 'warning' : 'success')
                ->chart([1, 4, 3, 7, 5, max(8, $inquiriesCount)])
                ->url(route('filament.admin.resources.inquiries.index')),

            Stat::make('Contact Messages', $messagesCount)
                ->description($unreadMessages > 0 ? "{$unreadMessages} unread in inbox" : 'Inbox up to date')
                ->descriptionIcon('heroicon-m-envelope')
                ->color($unreadMessages > 0 ? 'danger' : 'success')
                ->chart([2, 3, 5, 4, 8, max(9, $messagesCount)])
                ->url(route('filament.admin.resources.contact-messages.index')),

            Stat::make('Homepage Slides', $activeSlides)
                ->description('Live hero banners')
                ->descriptionIcon('heroicon-m-photo')
                ->color('info')
                ->chart([1, 2, 2, 3, max(3, $activeSlides)])
                ->url(route('filament.admin.resources.hero-slides.index')),
        ];
    }
}
