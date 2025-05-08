<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // Simpan pesan dari form
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);
        Contact::create($request->only('name', 'email', 'message'));
        return back()->with('success', 'Pesan Anda berhasil dikirim!');
    }

    // Admin: tampilkan daftar pesan
    public function index()
    {
        $contacts = Contact::orderByDesc('created_at')->get();
        return view('admin.contacts.index', compact('contacts'));
    }
} 