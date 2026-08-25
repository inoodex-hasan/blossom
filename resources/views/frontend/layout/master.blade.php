<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', ($siteSettings['site_name'] ?? 'Sundry Blossom') . ' - ' . ($siteSettings['site_tagline'] ?? 'Handcrafted & Sustainable Goods'))</title>
    <style>
        body { background-color: #fdf6f0; }
    </style>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              brand: {
                50: '#fdf6f0',
                100: '#f9e6d5',
                200: '#f2cba5',
                300: '#e9a96f',
                400: '#e08a45',
                500: '#c96f2f',
                600: '#b85a24',
                700: '#984420',
                800: '#7b3820',
                900: '#652f1e',
              },
              amber: {
                50: '#fffbeb',
                100: '#fef3c7',
                200: '#fde68a',
                300: '#fcd34d',
                400: '#fbbf24',
                500: '#f59e0b',
                600: '#d97706',
                700: '#b45309',
                800: '#92400e',
                900: '#78350f',
              }
            },
            fontFamily: {
              serif: ['Georgia', 'Cambria', '"Times New Roman"', 'Times', 'serif'],
            }
          }
        }
      }
    </script>
    <style>
        [x-cloak] { display: none !important; }
        
        /* SweetAlert2 Custom Styling */
        .swal2-popup.blossom-alert-popup {
            border-radius: 1.5rem !important;
            padding: 2rem !important;
            box-shadow: 0 25px 50px -12px rgba(15, 23, 42, 0.25) !important;
            border: 1px solid rgba(226, 232, 240, 0.8) !important;
        }
        .swal2-title.blossom-alert-title {
            font-family: Georgia, Cambria, 'Times New Roman', Times, serif !important;
            color: #1B3B5A !important;
            font-size: 1.5rem !important;
            font-weight: 700 !important;
        }
        .swal2-html-container.blossom-alert-body {
            color: #475569 !important;
            font-size: 0.95rem !important;
            line-height: 1.6 !important;
            margin-top: 0.5rem !important;
        }
        .swal2-confirm.blossom-alert-btn {
            background: linear-gradient(135deg, #0EA5E9, #0284C7) !important;
            border-radius: 0.75rem !important;
            padding: 0.75rem 2rem !important;
            font-size: 0.8125rem !important;
            font-weight: 700 !important;
            letter-spacing: 0.05em !important;
            text-transform: uppercase !important;
            box-shadow: 0 10px 15px -3px rgba(14, 165, 233, 0.3) !important;
            border: none !important;
        }
    </style>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @yield('styles')
</head>
<body class="text-slate-800 font-sans relative bg-brand-50 min-h-screen flex flex-col justify-between">
    <div class="fixed inset-0 -z-10">
        @yield('bg')
    </div>

    <div>
        @include('frontend.layout.header')

        @yield('hero')

        <main>
            @yield('content')
        </main>

        @yield('journey')
    </div>

    @include('frontend.layout.footer')

    <script>
        // SweetAlert2 Toast Notification
        window.showToast = function(title, message, icon) {
            icon = icon || 'success';
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 4500,
                timerProgressBar: true,
                background: '#ffffff',
                color: '#1B3B5A',
                iconColor: icon === 'success' ? '#10B981' : (icon === 'warning' ? '#F59E0B' : '#EF4444'),
                customClass: {
                    popup: 'rounded-2xl shadow-2xl border border-slate-100 p-4',
                    title: 'text-sm font-bold font-serif text-[#1B3B5A]',
                    htmlContainer: 'text-xs text-slate-500 font-sans'
                },
                didOpen: function(toast) {
                    toast.addEventListener('mouseenter', Swal.stopTimer);
                    toast.addEventListener('mouseleave', Swal.resumeTimer);
                }
            });

            Toast.fire({
                icon: icon,
                title: title,
                text: message
            });
        };

        // SweetAlert2 Beautiful Success Modal
        window.showSuccessAlert = function(title, message) {
            Swal.fire({
                icon: 'success',
                title: title || 'Message Sent Successfully!',
                text: message || 'Thank you for reaching out. We will get back to you shortly.',
                confirmButtonText: 'Great, Thank You',
                customClass: {
                    popup: 'blossom-alert-popup',
                    title: 'blossom-alert-title',
                    htmlContainer: 'blossom-alert-body',
                    confirmButton: 'blossom-alert-btn'
                },
                buttonsStyling: false
            });
        };

        // SweetAlert2 Beautiful Error Modal
        window.showErrorAlert = function(title, message) {
            Swal.fire({
                icon: 'error',
                title: title || 'Something Went Wrong',
                text: message || 'Please check your inputs and try again.',
                confirmButtonText: 'Try Again',
                customClass: {
                    popup: 'blossom-alert-popup',
                    title: 'blossom-alert-title',
                    htmlContainer: 'blossom-alert-body',
                    confirmButton: 'blossom-alert-btn'
                },
                buttonsStyling: false
            });
        };

        // Global Modal Controls
        function openInquiryModal() {
            var modal = document.getElementById('inquiry-modal');
            if (modal) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                modal.style.display = 'flex';
                document.body.style.overflow = 'hidden';
            }
        }

        function closeInquiryModal() {
            var modal = document.getElementById('inquiry-modal');
            if (modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                modal.style.display = 'none';
                document.body.style.overflow = '';
            }
        }

        // Global Mobile Menu Controls
        var isMobileMenuOpen = false;
        function toggleMobileMenu() {
            var mobileMenu = document.getElementById('mobile-menu');
            var bar1 = document.getElementById('bar1');
            var bar2 = document.getElementById('bar2');
            var bar3 = document.getElementById('bar3');

            isMobileMenuOpen = !isMobileMenuOpen;

            if (mobileMenu) {
                if (isMobileMenuOpen) {
                    mobileMenu.classList.remove('hidden');
                    if (bar1) bar1.style.transform = 'translateY(8px) rotate(45deg)';
                    if (bar2) bar2.style.opacity = '0';
                    if (bar3) bar3.style.transform = 'translateY(-8px) rotate(-45deg)';
                } else {
                    mobileMenu.classList.add('hidden');
                    if (bar1) bar1.style.transform = '';
                    if (bar2) bar2.style.opacity = '1';
                    if (bar3) bar3.style.transform = '';
                }
            }
        }

        function toggleProductsSubmenu(e) {
            if (e && e.stopPropagation) e.stopPropagation();
            var submenu = document.getElementById('products-submenu');
            var arrow = document.getElementById('products-arrow');
            if (submenu) submenu.classList.toggle('hidden');
            if (arrow) arrow.classList.toggle('rotate-180');
        }

        function scrollToTop(e) {
            if (e && e.preventDefault) e.preventDefault();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        // Global aliases
        window.openInquiryModal = openInquiryModal;
        window.closeInquiryModal = closeInquiryModal;
        window.toggleMobileMenu = toggleMobileMenu;
        window.toggleProductsSubmenu = toggleProductsSubmenu;
        window.scrollToTop = scrollToTop;

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeInquiryModal();
        });

        // Server-side flash sessions
        @if(session('success'))
            document.addEventListener('DOMContentLoaded', function() {
                window.showSuccessAlert('Success!', "{{ session('success') }}");
                window.showToast('Success', "{{ session('success') }}", 'success');
            });
        @endif

        @if(session('error'))
            document.addEventListener('DOMContentLoaded', function() {
                window.showErrorAlert('Notice', "{{ session('error') }}");
            });
        @endif
    </script>
    @yield('scripts')
</body>
</html>
