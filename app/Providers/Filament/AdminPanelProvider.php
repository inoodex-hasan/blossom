<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\View\PanelsRenderHook;
use Filament\Widgets\AccountWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->profile(\App\Filament\Pages\Auth\EditProfile::class, isSimple: false)
            ->brandName(fn () => \App\Models\SiteSetting::get('site_name', 'Sundry Blossom'))
            ->brandLogo(function () {
                $logo = \App\Models\SiteSetting::get('site_logo');
                if ($logo) {
                    return new \Illuminate\Support\HtmlString('<img src="' . asset('storage/' . $logo) . '" alt="' . e(\App\Models\SiteSetting::get('site_name', 'Sundry Blossom')) . '" class="h-9 w-auto max-w-[180px] object-contain" />');
                }
                return new \Illuminate\Support\HtmlString('<span style="font-size: 1.85rem; font-weight: 700; font-family: serif; letter-spacing: -0.02em; color: #0EA5E9;">' . e(\App\Models\SiteSetting::get('site_name', 'Sundry Blossom')) . '</span>');
            })
            ->brandLogoHeight('2.75rem')
            ->favicon(fn () => ($icon = \App\Models\SiteSetting::get('site_favicon')) ? asset('storage/' . $icon) : asset('favicon.ico'))
            ->renderHook(
                PanelsRenderHook::SIMPLE_LAYOUT_START,
                function (): string {
                    $brand = \App\Models\SiteSetting::get('site_name', 'Sundry Blossom');
                    $hasLogo = (bool) \App\Models\SiteSetting::get('site_logo');

                    $brandCss = $hasLogo
                        ? ".fi-simple-page .fi-logo::after { content: '" . addslashes($brand) . "'; margin-left: 0.6rem; font-weight: 700; font-size: 1.05rem; color: #02386A; letter-spacing: -0.01em; white-space: nowrap; }"
                        : '';

                    return <<<HTML
                    <style id="sb-auth-design">
                        html,
                        body.fi-body {
                            background: linear-gradient(135deg, #38bdf8 0%, #0ea5e9 38%, #0284c7 68%, #075985 100%) !important;
                        }
                        body.fi-body {
                            min-height: 100vh !important;
                        }
                        .fi-simple-layout {
                            position: relative;
                        }
                        .fi-simple-layout::before,
                        .fi-simple-layout::after {
                            content: "";
                            position: fixed;
                            pointer-events: none;
                            z-index: 0;
                            border-radius: 50%;
                        }
                        .fi-simple-layout::before {
                            top: -12%;
                            left: -10%;
                            width: 46vw;
                            height: 46vw;
                            min-width: 320px;
                            min-height: 320px;
                            background: radial-gradient(circle at 35% 35%, rgba(255, 255, 255, 0.4), rgba(255, 255, 255, 0) 70%);
                        }
                        .fi-simple-layout::after {
                            bottom: -18%;
                            right: -12%;
                            width: 55vw;
                            height: 55vw;
                            min-width: 360px;
                            min-height: 360px;
                            background: radial-gradient(circle at 60% 40%, rgba(3, 105, 161, 0.55), rgba(3, 105, 161, 0) 70%);
                        }
                        .fi-simple-main-ctn::before,
                        .fi-simple-main-ctn::after {
                            content: "";
                            position: fixed;
                            pointer-events: none;
                            z-index: 0;
                            border-radius: 999px;
                            border-style: solid;
                            border-color: rgba(255, 255, 255, 0.14);
                        }
                        .fi-simple-main-ctn::before {
                            top: 14%;
                            left: 6%;
                            width: 240px;
                            height: 110px;
                            border-width: 26px;
                            transform: rotate(-24deg);
                        }
                        .fi-simple-main-ctn::after {
                            bottom: 12%;
                            right: 7%;
                            width: 200px;
                            height: 90px;
                            border-width: 22px;
                            border-color: rgba(255, 255, 255, 0.12);
                            transform: rotate(18deg);
                        }
                        .fi-simple-main {
                            position: relative;
                            z-index: 1;
                            background: rgba(15, 23, 42, 0.3) !important;
                            border: 1px solid rgba(255, 255, 255, 0.25) !important;
                            border-radius: 1.5rem !important;
                            backdrop-filter: blur(18px) !important;
                            -webkit-backdrop-filter: blur(18px) !important;
                            box-shadow: 0 25px 60px -15px rgba(2, 45, 90, 0.5) !important;
                        }
                        .fi-simple-page {
                            position: relative;
                            z-index: 1;
                            background: transparent !important;
                            border: none !important;
                            border-radius: 0 !important;
                            box-shadow: none !important;
                            backdrop-filter: none !important;
                        }
                        .fi-simple-page .fi-simple-header-heading,
                        .fi-simple-page label,
                        .fi-simple-page .fi-fo-field-label,
                        .fi-simple-page .fi-fo-field-label-content,
                        .fi-simple-page .fi-checkbox-label,
                        .fi-simple-page .fi-checkbox label {
                            color: #ffffff !important;
                        }
                        .fi-simple-page .fi-fo-field-label-required-mark {
                            color: #fde047 !important;
                        }
                        .fi-simple-page .fi-fo-text-input,
                        .fi-simple-page .fi-input-wrp {
                            background: rgba(255, 255, 255, 0.97) !important;
                            border: 1px solid rgba(255, 255, 255, 0.7) !important;
                            border-radius: 0.75rem !important;
                            box-shadow: 0 1px 2px rgba(2, 45, 90, 0.15) !important;
                        }
                        .fi-simple-page input[type="email"],
                        .fi-simple-page input[type="password"],
                        .fi-simple-page input[type="text"] {
                            font-size: 16px !important;
                            background: transparent !important;
                            border: none !important;
                            color: #0f172a !important;
                            box-shadow: none !important;
                            outline: none !important;
                        }
                        .fi-simple-page input::placeholder {
                            color: #94a3b8 !important;
                        }
                        .fi-simple-page .fi-fo-text-input:focus-within {
                            border-color: #0ea5e9 !important;
                            box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.4) !important;
                        }
                        .fi-simple-page .fi-checkbox-label,
                        .fi-simple-page .fi-checkbox {
                            color: #ffffff !important;
                        }
                        .fi-simple-page a {
                            color: #e0f2fe !important;
                        }
                        .fi-simple-page a:hover {
                            color: #ffffff !important;
                        }
                        .fi-simple-page .fi-logo {
                            height: auto !important;
                            min-height: 2.75rem;
                            display: inline-flex;
                            align-items: center;
                            background: #ffffff;
                            border: 1px solid rgba(0, 0, 0, 0.06);
                            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12);
                            border-radius: 0.75rem;
                            padding: 0.45rem 0.9rem;
                        }
                        .fi-simple-page .fi-logo img {
                            max-height: 36px;
                        }
                        .fi-simple-page button[type="submit"] {
                            background-color: #0ea5e9 !important;
                            color: #ffffff !important;
                            border-radius: 0.75rem !important;
                            font-weight: 700 !important;
                            box-shadow: 0 10px 20px -8px rgba(14, 165, 233, 0.55) !important;
                        }
                        .fi-simple-page button[type="submit"]:hover {
                            background-color: #0284c7 !important;
                            color: #ffffff !important;
                        }
                        .fi-simple-page .fi-checkbox-input {
                            color: #0ea5e9 !important;
                            border-color: rgba(255, 255, 255, 0.7) !important;
                        }
                        {$brandCss}
                    </style>
                    HTML;
                },
            )
            ->colors([
                'primary' => Color::Sky,
                'gray' => Color::Slate,
            ])
            ->navigationGroups([
                'Catalog',
                'Brand Narrative',
                'Leads & Inquiries',
                'Store Configuration',
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                \App\Filament\Widgets\DashboardHeaderWidget::class,
                \App\Filament\Widgets\StatsOverviewWidget::class,
                \App\Filament\Widgets\LatestInquiriesWidget::class,
                \App\Filament\Widgets\LatestContactMessagesWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
