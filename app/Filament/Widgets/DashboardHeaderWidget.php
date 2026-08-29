<?php

namespace App\Filament\Widgets;

use App\Models\ContactMessage;
use App\Models\Inquiry;
use App\Models\Product;
use Filament\Widgets\Widget;

class DashboardHeaderWidget extends Widget
{
    protected string $view = 'filament.widgets.dashboard-header';

    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 0;

    public function getViewData(): array
    {
        return [
            'user' => auth()->user(),
            'productsCount' => Product::count(),
            'pendingInquiries' => Inquiry::where('status', 'pending')->count(),
            'unreadMessages' => ContactMessage::where('is_read', false)->count(),
        ];
    }
}
