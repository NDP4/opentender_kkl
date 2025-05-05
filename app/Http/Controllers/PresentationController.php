<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\PresentationConfirmation;
use App\Models\Proposal;
use Illuminate\Http\Request;

class PresentationController extends Controller
{
    public function index()
    {
        $announcement = Announcement::latest()->first();
        $presentationConfirmation = null;

        if ($announcement) {
            $presentationConfirmation = PresentationConfirmation::where('user_id', auth()->id())
                ->where('announcement_id', $announcement->id)
                ->first();
        }

        return view('biro.announcements', compact('announcement', 'presentationConfirmation'));
    }

    public function confirm(Request $request)
    {
        $request->validate([
            'announcement_id' => 'required|exists:announcements,id',
            'status' => 'required|in:confirmed,declined'
        ]);

        // Check if user has an accepted proposal
        $latestProposal = auth()->user()->proposals()->latest()->first();

        if (!$latestProposal || $latestProposal->status !== 'accepted') {
            return redirect()->back()
                ->with('error', 'Maaf, Anda tidak dapat mengkonfirmasi kehadiran karena proposal Anda belum diterima.');
        }

        $confirmation = PresentationConfirmation::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'announcement_id' => $request->announcement_id
            ],
            [
                'status' => $request->status,
                'is_winner' => false // Default to false, will be updated when winner is selected
            ]
        );

        return redirect()->route('biro.announcements')
            ->with('success', 'Status kehadiran berhasil diperbarui');
    }
}
