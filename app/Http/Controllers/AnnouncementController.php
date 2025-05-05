<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Announcement;
use App\Models\Proposal;
use App\Models\PresentationConfirmation;
use App\Notifications\AnnouncementNotification;
use App\Notifications\PresentationRejected;
use App\Notifications\WinnerAnnouncementNotification;
use App\Notifications\TenderResultNotification;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::latest()->get();
        return view('admin.announcements.index', compact('announcements'));
    }

    public function create()
    {
        return view('admin.announcements.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'announcement_date' => 'required|date',
            'type' => 'required|in:presentation,winner',
            'selected_biros' => 'required|array',
            'selected_biros.*' => 'exists:users,id'
        ]);

        $announcement = Announcement::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'announcement_date' => $validated['announcement_date'],
            'type' => $validated['type'],
            'selected_biro_ids' => $validated['selected_biros']
        ]);

        if ($validated['type'] === 'winner') {
            $winnerId = $validated['selected_biros'][0];

            // Update presentation confirmation to mark winner
            PresentationConfirmation::where('user_id', $winnerId)
                ->latest()
                ->first()
                ->update(['is_winner' => true]);

            // Notify winner
            $winnerUser = User::find($winnerId);
            $winnerUser->notify(new WinnerAnnouncementNotification($announcement));

            // Notify other participants about not being selected
            $otherBiros = User::whereHas('presentationConfirmations', function ($query) {
                $query->where('status', 'confirmed');
            })->where('id', '!=', $winnerId)->get();

            foreach ($otherBiros as $user) {
                $user->notify(new TenderResultNotification($announcement));
            }
        } else {
            // For presentation announcement
            // Notify selected biros
            $selectedUsers = User::whereIn('id', $validated['selected_biros'])->get();
            foreach ($selectedUsers as $user) {
                $user->notify(new AnnouncementNotification($announcement));
            }

            // Notify rejected biros
            $rejectedUsers = User::whereHas('proposals', function ($query) {
                $query->where('status', 'accepted');
            })->whereNotIn('id', $validated['selected_biros'])->get();

            foreach ($rejectedUsers as $user) {
                $user->notify(new PresentationRejected());
            }
        }

        return redirect()->route('admin.announcements.index')
            ->with('success', 'Pengumuman berhasil dibuat dan dikirim ke semua biro.');
    }

    public function show(Announcement $announcement)
    {
        return view('admin.announcements.show', compact('announcement'));
    }
}
