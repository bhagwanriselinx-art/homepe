<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enquiry;

class EnquiryController extends Controller
{
    public function store(Request $request)
    {
        // ✅ Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'message' => 'nullable|string',
            'property_name' => 'nullable|string|max:255',
        ]);

        // ✅ Save Data
        Enquiry::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'message' => $request->message,
            'property_name' => $request->property_name,
        ]);

        // ✅ Response for AJAX
        return response()->json([
            'status' => true,
            'message' => 'Enquiry submitted successfully!'
        ]);
    }
}