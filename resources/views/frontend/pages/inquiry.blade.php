@extends('frontend.layout.master')

@section('title', 'Send Us an Inquiry - ' . ($siteSettings['site_name'] ?? 'Sundry Blossom'))

@section('content')
<section class="pt-20 pb-20 px-6 sm:px-10 lg:px-16">
    <div class="max-w-2xl mx-auto">
        <div class="text-center mb-8">
            <span class="text-xs font-bold tracking-widest text-[#0EA5E9] uppercase">Trade & Wholesale</span>
            <h1 class="text-3xl sm:text-4xl font-serif text-[#1B3B5A] mt-2">Send Us an Inquiry</h1>
            <p class="mt-2 text-sm text-slate-500 max-w-md mx-auto">Fill out the form below and our team will get back to you with custom catalog pricing and partnership terms.</p>
        </div>

        <div class="bg-white rounded-2xl p-6 sm:p-10 shadow-lg border border-slate-100">
            <div id="page-inquiry-feedback" class="hidden mb-6 p-4 rounded-xl text-sm font-medium"></div>

            <form id="page-inquiry-form" action="{{ route('inquiry.store') }}" method="POST" class="space-y-4">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold tracking-wider text-slate-700 mb-1">Full Name *</label>
                        <input type="text" name="name" id="inquiry-page-name" placeholder="John Doe" required 
                            class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-[#0EA5E9]/30 focus:border-[#0EA5E9] outline-none transition placeholder:text-slate-400">
                    </div>
                    <div>
                        <label class="block text-xs font-bold tracking-wider text-slate-700 mb-1">Company Name</label>
                        <input type="text" name="company_name" id="inquiry-page-company" placeholder="Acme Corp" 
                            class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-[#0EA5E9]/30 focus:border-[#0EA5E9] outline-none transition placeholder:text-slate-400">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold tracking-wider text-slate-700 mb-1">Email Address *</label>
                        <input type="email" name="email" id="inquiry-page-email" placeholder="you@example.com" required 
                            class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-[#0EA5E9]/30 focus:border-[#0EA5E9] outline-none transition placeholder:text-slate-400">
                    </div>
                    <div>
                        <label class="block text-xs font-bold tracking-wider text-slate-700 mb-1">Phone Number *</label>
                        <input type="tel" name="phone" id="inquiry-page-phone" placeholder="+880 1XX-XXXXXXX" required 
                            class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-[#0EA5E9]/30 focus:border-[#0EA5E9] outline-none transition placeholder:text-slate-400">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold tracking-wider text-slate-700 mb-1">Address / Country</label>
                    <input type="text" name="address" id="inquiry-page-address" placeholder="Street, City, Country" 
                        class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-[#0EA5E9]/30 focus:border-[#0EA5E9] outline-none transition placeholder:text-slate-400">
                </div>

                <div>
                    <label class="block text-xs font-bold tracking-wider text-slate-700 mb-1">Company Details / Website</label>
                    <input type="text" name="company_details" id="inquiry-page-company-details" placeholder="Industry, retail boutique, hospitality group, website..." 
                        class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-[#0EA5E9]/30 focus:border-[#0EA5E9] outline-none transition placeholder:text-slate-400">
                </div>

                <div>
                    <label class="block text-xs font-bold tracking-wider text-slate-700 mb-1">Message & Requirements *</label>
                    <textarea name="message" id="inquiry-page-message" rows="4" placeholder="Tell us about the products, quantities, or customization you are interested in..." required 
                        class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-[#0EA5E9]/30 focus:border-[#0EA5E9] outline-none transition resize-none placeholder:text-slate-400"></textarea>
                </div>

                <button type="submit" id="page-inquiry-submit-btn" 
                    class="w-full bg-[#0EA5E9] hover:bg-[#0284C7] text-white py-3.5 rounded-xl font-semibold flex items-center justify-center gap-2 text-xs uppercase tracking-wider transition-colors shadow-md shadow-sky-500/20">
                    <span>Submit Inquiry</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </button>
            </form>
        </div>
    </div>
</section>

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var form = document.getElementById('page-inquiry-form');
        var submitBtn = document.getElementById('page-inquiry-submit-btn');
        var feedback = document.getElementById('page-inquiry-feedback');

        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                if (submitBtn) {
                    submitBtn.disabled = true;
                    submitBtn.classList.add('opacity-75', 'cursor-not-allowed');
                    submitBtn.innerHTML = '<span>Submitting Inquiry...</span>';
                }

                if (feedback) {
                    feedback.classList.add('hidden');
                    feedback.className = 'hidden mb-6 p-4 rounded-xl text-sm font-medium';
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
                            feedback.className = 'mb-6 p-4 rounded-xl text-sm font-medium bg-emerald-50 text-emerald-800 border border-emerald-200';
                            feedback.classList.remove('hidden');
                        }
                        form.reset();

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
                            feedback.className = 'mb-6 p-4 rounded-xl text-sm font-medium bg-rose-50 text-rose-800 border border-rose-200';
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
                        feedback.className = 'mb-6 p-4 rounded-xl text-sm font-medium bg-rose-50 text-rose-800 border border-rose-200';
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
@endsection
@endsection
