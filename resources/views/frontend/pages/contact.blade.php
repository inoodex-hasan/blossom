@extends('frontend.layout.master')

@section('title', 'Contact Us - ' . ($siteSettings['site_name'] ?? 'Sundry Blossom'))

@section('content')
<section class="relative pt-20 pb-10 sm:pb-12 px-5 sm:px-6 text-center overflow-hidden">
    <div class="absolute inset-0 -z-10">
        <div class="absolute top-0 left-0 w-72 h-72 bg-[#F4A261] opacity-5 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-[#1B3B5A] opacity-5 rounded-full blur-3xl translate-x-1/3 translate-y-1/3"></div>
    </div>
    
    <div class="max-w-4xl mx-auto relative">
        <h1 class="text-3xl sm:text-5xl font-serif text-[#1B3B5A] leading-tight">
            Let's <span class="text-[#0c23d7] relative inline-block">
                Connect
                <svg class="absolute -bottom-1 left-0 w-full" viewBox="0 0 100 10" fill="none">
                    <path d="M0 5 Q25 0 50 5 Q75 10 100 5" stroke="#F4A261" stroke-width="2" opacity="0.3"/>
                </svg>
            </span>
        </h1>
        <p class="mt-4 sm:mt-6 text-sm sm:text-base text-slate-600 font-serif max-w-2xl mx-auto leading-relaxed">
            Have a question about our products, custom orders, or partnership opportunities? 
            <br class="hidden sm:block">Reach out to our team. We are here to help.
        </p>
    </div>
</section>

<section class="pb-16 sm:pb-24 px-5 sm:px-6 relative">
    <div class="max-w-5xl mx-auto">
        <div class="grid lg:grid-cols-12 gap-6 lg:gap-8">
   
            <div class="lg:col-span-5 space-y-4">
                <!-- Phone Card -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 cursor-default">
                    <div class="flex items-start gap-5">
                        <div class="w-12 h-12 rounded-xl bg-[#1B3B5A]/10 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-[#1B3B5A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-[12px] font-bold font-serif tracking-wider text-[#1B3B5A] uppercase">Call Us</h3>
                            <p class="text-sm font-normal text-[#1B3B5A] mt-1">
                                <a href="tel:{{ $siteSettings['contact_phone'] ?? '+8804767775689' }}" class="hover:underline">
                                    {{ $siteSettings['contact_phone'] ?? '+880 4767 775689' }}
                                </a>
                            </p>
                            {{-- <p class="text-xs text-slate-400 mt-0.5">{{ $siteSettings['contact_hours'] ?? 'Mon - Fri, 9am - 6pm' }}</p> --}}
                        </div>
                    </div>
                </div>

                <!-- Email Card -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 cursor-default">
                    <div class="flex items-start gap-5">
                        <div class="w-12 h-12 rounded-xl bg-[#1B3B5A]/10 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-[#1B3B5A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-[12px] font-bold font-serif tracking-wider text-[#1B3B5A] uppercase">Email Us</h3>
                            <p class="text-sm font-normal text-[#1B3B5A] mt-1">
                                <a href="mailto:{{ $siteSettings['contact_email'] ?? 'sundryblossom@gmail.com' }}" class="hover:underline">
                                    {{ $siteSettings['contact_email'] ?? 'sundryblossom@gmail.com' }}
                                </a>
                            </p>
                            <p class="text-xs text-slate-400 mt-0.5">{{ $siteSettings['contact_response_time'] ?? 'We reply within 24 hours' }}</p>
                        </div>
                    </div>
                </div>
                 <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 cursor-default">
                    <div class="flex items-start gap-5">
                        <div class="w-12 h-12 rounded-xl bg-[#1B3B5A]/10 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-[#1B3B5A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-[12px] font-bold font-serif tracking-wider text-[#1B3B5A] uppercase">Address</h3>
                            <p class="text-sm font-normal text-[#1B3B5A] mt-1">
                                <a href="" class="hover:underline">
                                  New York, NY 10001
                                </a>
                            </p>
                            <p class="text-xs text-slate-400 mt-0.5"></p>
                        </div>
                    </div>
                </div>

                {{-- <!-- Address / Location Card -->
                @if(!empty($siteSettings['contact_address']))
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 cursor-default">
                    <div class="flex items-start gap-5">
                        <div class="w-12 h-12 rounded-xl bg-[#1B3B5A]/10 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-[#1B3B5A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-[12px] font-bold font-serif tracking-wider text-[#1B3B5A] uppercase">Location</h3>
                            <p class="text-sm font-normal text-[#1B3B5A] mt-1">{{ $siteSettings['contact_address'] }}</p>
                            <p class="text-xs text-slate-400 mt-0.5">Visits by appointment</p>
                        </div>
                    </div>
                </div>
                @endif --}}
            </div>

            <div class="lg:col-span-7">
                <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-lg border border-slate-100 relative overflow-hidden">
                    <div class="absolute -top-20 -right-16 w-32 h-32 bg-[#F4A261]/10 rounded-full blur-2xl"></div>
                    <div class="absolute -bottom-16 -left-16 w-32 h-32 bg-[#1B3B5A]/5 rounded-full blur-2xl"></div>
                    
                    <div class="relative">
                        <div class="mb-5">
                            <h3 class="text-xl font-serif text-[#1B3B5A]">Send a Message</h3>
                            <p class="text-xs font-serif text-slate-400 mt-1">Fill out the form below and we will get back to you shortly.</p>
                        </div>

                        <div id="contact-feedback" class="hidden mb-4 p-3 rounded-lg text-sm font-medium"></div>

                        <form id="contact-form" action="{{ route('contact.store') }}" method="POST" class="space-y-4">
                            @csrf
                            @honeypot

                            <div>
                                <label class="block text-[10px] font-bold tracking-wider text-[#1B3B5A] uppercase mb-1">
                                    Your Name *
                                </label>
                                <input type="text" name="name" id="name" placeholder="John Doe" required 
                                    class="w-full px-4 py-2.5 bg-slate-50/80 border border-slate-200 rounded-lg text-sm focus:bg-white focus:ring-2 focus:ring-[#0EA5E9]/30 focus:border-[#0EA5E9] outline-none transition-all placeholder:text-slate-400">
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                                <div>
                                    <label class="block text-[10px] font-bold tracking-wider text-[#1B3B5A] uppercase mb-1">
                                        Email Address *
                                    </label>
                                    <input type="email" name="email" id="email" placeholder="you@example.com" required 
                                        class="w-full px-4 py-2.5 bg-slate-50/80 border border-slate-200 rounded-lg text-sm focus:bg-white focus:ring-2 focus:ring-[#0EA5E9]/30 focus:border-[#0EA5E9] outline-none transition-all placeholder:text-slate-400">
                                </div>
                                <div>
                                    <label class="block text-[10px] font-bold tracking-wider text-[#1B3B5A] uppercase mb-1">
                                        Phone Number
                                    </label>
                                    <input type="tel" name="phone" id="phone" placeholder="+880 1XX-XXXXXXX" 
                                        class="w-full px-4 py-2.5 bg-slate-50/80 border border-slate-200 rounded-lg text-sm focus:bg-white focus:ring-2 focus:ring-[#0EA5E9]/30 focus:border-[#0EA5E9] outline-none transition-all placeholder:text-slate-400">
                                </div>
                            </div>

                            <div>
                                <label class="block text-[10px] font-bold tracking-wider text-[#1B3B5A] uppercase mb-1">
                                    Your Message *
                                </label>
                                <textarea name="message" id="message" rows="4" placeholder="How can we help you today?" required 
                                    class="w-full px-4 py-2.5 bg-slate-50/80 border border-slate-200 rounded-lg text-sm focus:bg-white focus:ring-2 focus:ring-[#0EA5E9]/30 focus:border-[#0EA5E9] outline-none transition-all resize-none placeholder:text-slate-400"></textarea>
                            </div>

                            <button type="submit" id="contact-submit-btn"
                                class="w-full bg-[#0EA5E9] hover:bg-[#0284C7] text-white py-3 rounded-lg font-semibold flex items-center justify-center gap-2 text-xs tracking-wider uppercase transition-colors duration-300 shadow-md">
                                <span class="flex items-center gap-2">
                                    Send Message
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                    </svg>
                                </span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var form = document.getElementById('contact-form');
        var submitBtn = document.getElementById('contact-submit-btn');
        var feedback = document.getElementById('contact-feedback');

        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                if (submitBtn) {
                    submitBtn.disabled = true;
                    submitBtn.classList.add('opacity-75', 'cursor-not-allowed');
                    submitBtn.innerHTML = '<span>Sending Message...</span>';
                }

                if (feedback) {
                    feedback.classList.add('hidden');
                    feedback.className = 'hidden mb-4 p-3 rounded-lg text-sm font-medium';
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
                        var successMsg = result.body.message || 'Thank you! Your message has been sent successfully.';
                        if (feedback) {
                            feedback.textContent = successMsg;
                            feedback.className = 'mb-4 p-3 rounded-lg text-sm font-medium bg-emerald-50 text-emerald-800 border border-emerald-200';
                            feedback.classList.remove('hidden');
                        }
                        form.reset();

                        if (window.showSuccessAlert) {
                            window.showSuccessAlert('Message Sent Successfully!', successMsg);
                        }
                        if (window.showToast) {
                            window.showToast('Message Delivered', 'We will respond within 24 hours.', 'success');
                        }
                    } else {
                        var errorMsg = result.body.message || 'An error occurred. Please check the fields and try again.';
                        if (result.body.errors) {
                            var firstErr = Object.values(result.body.errors)[0];
                            if (firstErr) errorMsg = Array.isArray(firstErr) ? firstErr[0] : firstErr;
                        }
                        if (feedback) {
                            feedback.textContent = errorMsg;
                            feedback.className = 'mb-4 p-3 rounded-lg text-sm font-medium bg-rose-50 text-rose-800 border border-rose-200';
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
                        feedback.className = 'mb-4 p-3 rounded-lg text-sm font-medium bg-rose-50 text-rose-800 border border-rose-200';
                        feedback.classList.remove('hidden');
                    }
                })
                .finally(function() {
                    if (submitBtn) {
                        submitBtn.disabled = false;
                        submitBtn.classList.remove('opacity-75', 'cursor-not-allowed');
                        submitBtn.innerHTML = '<span class="flex items-center gap-2">Send Message <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg></span>';
                    }
                });
            });
        }
    });
</script>
@endsection
@endsection