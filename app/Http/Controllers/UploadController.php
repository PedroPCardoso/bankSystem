<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function store(Request $request)
    {

        $request->validate([
            'receipt.*' => 'mimes:doc,pdf,docx,zip,jpeg,png,jpg,gif,svg',

        ]);

        return $request->file('receipt')->store('receipts', 'public');
    }
}
