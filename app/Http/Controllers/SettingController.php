<?php

namespace App\Http\Controllers;

use App\Models\ContactSetting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function edit()
    {
        $settings = ContactSetting::first();
        return view('admin.settings.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'phone' => 'required|string',
            'address' => 'required|string'
        ]);

        $settings = ContactSetting::first();
        $settings->update($validated);

        return redirect()->route('admin.settings.edit')
            ->with('success', 'Informasi kontak berhasil diperbarui.');
    }
}
