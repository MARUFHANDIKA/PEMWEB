<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\StoreSetting;

class ContactController extends Controller
{
    public function index()
    {
        $setting = StoreSetting::first();
        return view('contact', compact('setting'));
    }
}
