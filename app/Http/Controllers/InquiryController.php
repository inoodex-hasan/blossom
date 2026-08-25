<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    /**
     * Store a newly created partnership or trade inquiry.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'address' => 'nullable|string|max:500',
            'company_name' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'company_details' => 'nullable|string|max:2000',
            'message' => 'required|string|max:5000',
        ]);

        if (empty($validated['company_name']) && !empty($validated['company'])) {
            $validated['company_name'] = $validated['company'];
        }
        unset($validated['company']);

        $inquiry = Inquiry::create($validated);

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => "Thank you for your inquiry, {$inquiry->name}! We will get back to you shortly.",
                'data' => $inquiry,
            ], 201);
        }

        return back()->with('success', "Thank you for your inquiry, {$inquiry->name}! We will get back to you shortly.");
    }
}
