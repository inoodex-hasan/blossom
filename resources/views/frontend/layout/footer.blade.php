<!-- Footer -->
<footer class="bg-slate-800 text-white">
    <div class="max-w-7xl mx-auto px-5 sm:px-10 py-8 sm:py-16 lg:py-20">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 sm:gap-12 items-start">
            <div>
                <h2 class="text-xl sm:text-5xl font-serif italic leading-snug text-white/90">
                    Contact us for inquiries <br>and partnerships.
                </h2>
            </div>
            <div class="space-y-4 sm:space-y-6">
                <div>
                    <h3 class="text-xs font-bold tracking-wider text-white/50 uppercase">Phone</h3>
                    <p class="mt-1 text-sm text-white/80">
                        <a href="tel:{{ $siteSettings['contact_phone'] ?? '+8804767775689' }}" class="hover:underline">
                            {{ $siteSettings['contact_phone_display'] ?? ($siteSettings['contact_phone'] ?? '04767775689') }}
                        </a>
                    </p>
                </div>
                <div>
                    <h3 class="text-xs font-bold tracking-wider text-white/50 uppercase">Email</h3>
                    <p class="mt-1 text-sm text-white/80">
                        <a href="mailto:{{ $siteSettings['contact_email'] ?? 'sundryblossom@gmail.com' }}" class="hover:underline">
                            {{ $siteSettings['contact_email'] ?? 'sundryblossom@gmail.com' }}
                        </a>
                    </p>
                </div>
                @if(!empty($siteSettings['contact_hours']))
                <div>
                    <h3 class="text-xs font-bold tracking-wider text-white/50 uppercase">Working Hours</h3>
                    <p class="mt-1 text-sm text-white/80">{{ $siteSettings['contact_hours'] }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="border-t border-white/10 py-5 sm:py-6 px-5 flex flex-col sm:flex-row items-center justify-between gap-3 max-w-7xl mx-auto">
        <p class="text-xs text-white/40">&copy; {{ date('Y') }} {{ $siteSettings['site_name'] ?? 'Sundry Blossom' }}. All rights reserved.</p>
        <div class="flex items-center gap-4">
            <p class="text-xs text-white/40">Developed by <a href="https://inoodex.com/" target="_blank" class="text-white/60 hover:text-white transition underline">Inoodex</a></p>
            <a href="#" onclick="scrollToTop(event)" id="scroll-top" aria-label="Scroll to top" class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center hover:bg-white/20 transition">
                <svg class="w-4 h-4 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path></svg>
            </a>
        </div>
    </div>
</footer>

<style>
    @keyframes modal-pop-in {
        0% { opacity: 0; transform: scale(0.92); }
        100% { opacity: 1; transform: scale(1); }
    }
    @keyframes overlay-fade-in {
        0% { opacity: 0; }
        100% { opacity: 1; }
    }
    #inquiry-modal.flex {
        animation: overlay-fade-in 0.2s ease-out;
    }
    #inquiry-modal.flex #inquiry-modal-body {
        animation: modal-pop-in 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    #inquiry-modal-body {
        scrollbar-width: thin;
        scrollbar-color: #94a3b8 #f1f5f9;
    }
    #inquiry-modal-body::-webkit-scrollbar {
        width: 8px;
    }
    #inquiry-modal-body::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 8px;
    }
    #inquiry-modal-body::-webkit-scrollbar-thumb {
        background-color: #94a3b8;
        border-radius: 8px;
    }
    #inquiry-modal-body::-webkit-scrollbar-thumb:hover {
        background-color: #64748b;
    }
    #inquiry-modal {
        -webkit-backdrop-filter: blur(4px);
        backdrop-filter: blur(4px);
        width: 100vw;
        height: 100vh;
    }
</style>

<!-- Inquiry Modal -->
<div id="inquiry-modal" class="hidden fixed inset-0 p-3 sm:p-6 bg-black/60 z-50 items-center justify-center" onclick="if(event.target===this)closeInquiryModal()">
    <div id="inquiry-modal-body" class="bg-white rounded-xl shadow-2xl w-full max-w-md relative max-h-[75vh] sm:max-h-[88vh] overflow-y-auto">

        <button id="close-modal" onclick="closeInquiryModal()" type="button" aria-label="Close modal" class="absolute top-3 right-3 text-white/80 hover:text-white cursor-pointer p-1.5 rounded-full hover:bg-white/10 transition z-10">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        <!-- Header -->
        <div class="bg-gradient-to-br from-[#0EA5E9] to-[#0284c7] px-5 sm:px-6 py-5 rounded-t-xl text-white">
            <h3 class="text-xl font-bold font-serif text-white">Contact us for inquiries <br/>and partnerships.</h3>
            <p class="mt-2 text-sm text-white/80 font-serif leading-relaxed max-w-sm">
                Fill out the fields below and we'll get back to you shortly with next steps.
            </p>
        </div>

        <div id="modal-feedback" class="hidden mx-5 mt-4 p-3 rounded-lg text-sm font-medium"></div>

        <form id="inquiry-form" action="{{ route('inquiry.store') }}" method="POST" class="px-5 sm:px-6 py-4 space-y-3">
            @csrf
            @honeypot

            <!-- Section: Contact details -->
            <div class="bg-[#0EA5E9] text-white font-serif text-xs font-bold tracking-wide px-3 py-1.5 rounded">Contact Details</div>

            <div>
                <label class="block text-xs font-semibold font-serif text-slate-700 mb-1">Full Name *</label>
                <input type="text" name="name" id="inquiry-name" placeholder="John Doe" required
                    class="w-full px-3.5 py-2 border border-slate-300 rounded-md text-sm focus:ring-2 focus:ring-[#0EA5E9]/30 focus:border-[#0EA5E9] outline-none transition placeholder:text-slate-400">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold font-serif text-slate-700 mb-1">Email *</label>
                    <input type="email" name="email" id="inquiry-email" placeholder="you@example.com" required
                        class="w-full px-3.5 py-2 border border-slate-300 rounded-md text-sm focus:ring-2 focus:ring-[#0EA5E9]/30 focus:border-[#0EA5E9] outline-none transition placeholder:text-slate-400">
                </div>
                <div>
                    <label class="block text-xs font-semibold font-serif text-slate-700 mb-1">Phone *</label>
                    <input type="tel" name="phone" id="inquiry-phone" placeholder="+880 1XX-XXXXXXX" required
                        class="w-full px-3.5 py-2 border border-slate-300 rounded-md text-sm focus:ring-2 focus:ring-[#0EA5E9]/30 focus:border-[#0EA5E9] outline-none transition placeholder:text-slate-400">
                </div>
            </div>

            <!-- Section: Business information -->
            <div class="bg-[#0EA5E9] text-white text-xs font-serif font-bold tracking-wide px-3 py-1.5 rounded !mt-4">Business Information</div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold font-serif text-slate-700 mb-1">Address</label>
                    <input type="text" name="address" id="inquiry-address" placeholder="Street, City, Country"
                        class="w-full px-3.5 py-2 border border-slate-300 rounded-md text-sm focus:ring-2 focus:ring-[#0EA5E9]/30 focus:border-[#0EA5E9] outline-none transition placeholder:text-slate-400">
                </div>
                <div>
                    <label class="block text-xs font-semibold font-serif text-slate-700 mb-1">Company Details</label>
                    <input type="text" name="company_details" id="inquiry-company-details" placeholder="Industry, size, website..."
                        class="w-full px-3.5 py-2 border border-slate-300 rounded-md text-sm focus:ring-2 focus:ring-[#0EA5E9]/30 focus:border-[#0EA5E9] outline-none transition placeholder:text-slate-400">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold font-serif text-slate-700 mb-1">Message *</label>
                <textarea name="message" id="inquiry-message" rows="3" placeholder="How can we help you?" required
                    class="w-full px-3.5 py-2 border border-slate-300 rounded-md text-sm focus:ring-2 focus:ring-[#0EA5E9]/30 focus:border-[#0EA5E9] outline-none transition resize-none placeholder:text-slate-400"></textarea>
            </div>
        </form>

        <!-- Footer -->
        <div class="px-5 pb-5 flex justify-center">
            <button type="submit" form="inquiry-form" id="modal-submit-btn"
                class="px-8 bg-[#0EA5E9] hover:bg-[#0284c7] shadow-lg shadow-[#0EA5E9]/30 cursor-pointer text-white py-2.5 rounded-xl font-semibold flex items-center gap-2 text-sm transition-all">
                <span>Submit Inquiry</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </button>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var form = document.getElementById('inquiry-form');
        var submitBtn = document.getElementById('modal-submit-btn');
        var feedback = document.getElementById('modal-feedback');

        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                if (submitBtn) {
                    submitBtn.disabled = true;
                    submitBtn.classList.add('opacity-75', 'cursor-not-allowed');
                    submitBtn.innerHTML = '<span>Submitting...</span>';
                }

                if (feedback) {
                    feedback.classList.add('hidden');
                    feedback.className = 'hidden mx-5 mt-4 p-3 rounded-lg text-sm font-medium';
                }

                var formData = new FormData(form);

                fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]') ? document.querySelector('meta[name="csrf-token"]').getAttribute('content') : ''
                    },
                    body: formData
                })
                .then(function(res) {
                    return res.json().then(function(data) {
                        return { status: res.status, ok: res.ok, body: data };
                    });
                })
                .then(function(result) {
                    if (result.ok) {
                        var successMsg = result.body.message || 'Thank you! Your inquiry has been submitted.';
                        if (feedback) {
                            feedback.textContent = successMsg;
                            feedback.className = 'mx-5 mt-4 p-3 rounded-lg text-sm font-medium bg-emerald-50 text-emerald-800 border border-emerald-200';
                            feedback.classList.remove('hidden');
                        }
                        form.reset();

                        setTimeout(function() {
                            closeInquiryModal();
                        }, 400);

                        if (window.showSuccessAlert) {
                            window.showSuccessAlert('Inquiry Received!', successMsg);
                        }
                        if (window.showToast) {
                            window.showToast('Inquiry Submitted', 'Our team will contact you shortly.', 'success');
                        }
                    } else {
                        var errorMsg = result.body.message || 'An error occurred. Please check the fields and try again.';
                        if (result.body.errors) {
                            var firstErr = Object.values(result.body.errors)[0];
                            if (firstErr) errorMsg = Array.isArray(firstErr) ? firstErr[0] : firstErr;
                        }
                        if (feedback) {
                            feedback.textContent = errorMsg;
                            feedback.className = 'mx-5 mt-4 p-3 rounded-lg text-sm font-medium bg-rose-50 text-rose-800 border border-rose-200';
                            feedback.classList.remove('hidden');
                        }
                        if (window.showErrorAlert) {
                            window.showErrorAlert('Submission Error', errorMsg);
                        }
                    }
                })
                .catch(function(err) {
                    if (feedback) {
                        feedback.textContent = 'Connection error. Please try again.';
                        feedback.className = 'mx-5 mt-4 p-3 rounded-lg text-sm font-medium bg-rose-50 text-rose-800 border border-rose-200';
                        feedback.classList.remove('hidden');
                    }
                })
                .finally(function() {
                    if (submitBtn) {
                        submitBtn.disabled = false;
                        submitBtn.classList.remove('opacity-75', 'cursor-not-allowed');
                        submitBtn.innerHTML = '<span>Submit Inquiry</span><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>';
                    }
                });
            });
        }
    });
</script>
