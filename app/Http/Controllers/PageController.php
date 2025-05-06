<?php

namespace App\Http\Controllers;

use App\Models\ContactSetting;

class PageController extends Controller
{
    protected function getContactSettings()
    {
        return ContactSetting::first();
    }

    public function about()
    {
        $contactSettings = $this->getContactSettings();
        return view('pages.about', compact('contactSettings'));
    }

    public function terms()
    {
        $contactSettings = $this->getContactSettings();
        return view('pages.terms', compact('contactSettings'));
    }

    public function privacy()
    {
        $contactSettings = $this->getContactSettings();
        return view('pages.privacy', compact('contactSettings'));
    }
}
