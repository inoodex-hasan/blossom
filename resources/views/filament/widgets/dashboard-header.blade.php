<x-filament-widgets::widget>
    <div style="background: linear-gradient(135deg, #1B3B5A 0%, #0F253B 100%); border-radius: 1rem; padding: 1.5rem; color: #ffffff; position: relative; overflow: hidden; box-shadow: 0 10px 25px -5px rgba(15, 37, 59, 0.15); border: 1px solid rgba(255, 255, 255, 0.08);">
        <!-- Background Ambient Glow -->
        <div style="position: absolute; top: -50px; right: -50px; width: 220px; height: 220px; background: radial-gradient(circle, rgba(245, 158, 11, 0.25) 0%, rgba(245, 158, 11, 0) 70%); border-radius: 9999px; pointer-events: none;"></div>
        
        <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 1.25rem; position: relative; z-index: 1;">
            <!-- Welcome Info -->
            <div style="max-width: 550px;">
                <div style="display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(255, 255, 255, 0.1); padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600; letter-spacing: 0.05em; text-transform: uppercase; margin-bottom: 0.6rem; border: 1px solid rgba(255, 255, 255, 0.15);">
                    <span style="display: inline-block; width: 6px; height: 6px; border-radius: 9999px; background: #10B981;"></span>
                    Sundry Blossom Management
                </div>
                <h2 style="font-size: 1.5rem; font-weight: 700; font-family: Georgia, serif; line-height: 1.25; margin: 0 0 0.4rem 0; color: #ffffff;">
                    Welcome back, {{ $user?->name ?? 'Admin' }}
                </h2>
                <p style="font-size: 0.875rem; color: #CBD5E1; margin: 0; line-height: 1.4;">
                    Your store overview for <strong style="color: #FCD34D;">{{ now()->format('l, F j, Y') }}</strong>.
                    @if($pendingInquiries > 0)
                        You have <span style="background: rgba(239, 68, 68, 0.25); color: #FCA5A5; padding: 0.1rem 0.45rem; border-radius: 0.375rem; font-weight: 600;">{{ $pendingInquiries }} pending trade {{ Str::plural('inquiry', $pendingInquiries) }}</span> awaiting response.
                    @else
                        All trade inquiries are up to date!
                    @endif
                </p>
            </div>

            <!-- Quick Action Shortcuts -->
            <div style="display: flex; flex-wrap: wrap; gap: 0.6rem; align-items: center;">
                <a href="{{ route('filament.admin.resources.products.create') }}" 
                   style="display: inline-flex; align-items: center; gap: 0.4rem; background: #F59E0B; color: #ffffff; font-size: 0.8125rem; font-weight: 600; padding: 0.55rem 1rem; border-radius: 0.625rem; text-decoration: none; box-shadow: 0 2px 6px rgba(245, 158, 11, 0.3); transition: all 0.15s ease;">
                    <svg style="width: 14px; height: 14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>Add Product</span>
                </a>

                <a href="{{ route('filament.admin.resources.inquiries.index') }}" 
                   style="display: inline-flex; align-items: center; gap: 0.4rem; background: rgba(255, 255, 255, 0.12); color: #ffffff; font-size: 0.8125rem; font-weight: 500; padding: 0.55rem 1rem; border-radius: 0.625rem; text-decoration: none; border: 1px solid rgba(255, 255, 255, 0.18); transition: all 0.15s ease;">
                    <svg style="width: 14px; height: 14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <span>Inquiries ({{ $pendingInquiries }})</span>
                </a>

                <a href="/" target="_blank" 
                   style="display: inline-flex; align-items: center; gap: 0.4rem; background: rgba(255, 255, 255, 0.08); color: #94A3B8; font-size: 0.8125rem; font-weight: 500; padding: 0.55rem 0.85rem; border-radius: 0.625rem; text-decoration: none; border: 1px solid rgba(255, 255, 255, 0.1); transition: all 0.15s ease;">
                    <svg style="width: 14px; height: 14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                    <span>View Store</span>
                </a>
            </div>
        </div>
    </div>
</x-filament-widgets::widget>
