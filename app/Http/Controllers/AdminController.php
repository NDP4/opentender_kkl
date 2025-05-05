<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use App\Models\ProposalFile;
use App\Notifications\ProposalReviewed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function reviewProposal(Proposal $proposal)
    {
        if ($proposal->status !== 'submitted') {
            return redirect()->route('dashboard')
                ->with('error', 'Proposal ini tidak dalam status menunggu review.');
        }

        return view('admin.review-proposal', ['proposal' => $proposal]);
    }

    public function submitReview(Request $request, Proposal $proposal)
    {
        $validated = $request->validate([
            'status' => 'required|in:accepted,rejected',
            'review_notes' => 'required|string|max:1000',
        ]);

        $proposal->update([
            'status' => $validated['status'],
            'review_notes' => $validated['review_notes']
        ]);

        // Send notification to biro
        $user = $proposal->user;
        $user->notify(new ProposalReviewed(
            $proposal,
            $validated['status'],
            $validated['review_notes']
        ));

        return redirect()->route('dashboard')
            ->with('success', 'Review proposal berhasil disubmit dan notifikasi telah dikirim ke biro.');
    }

    public function downloadFile(ProposalFile $file)
    {
        if (!auth()->user()->role === 'admin') {
            abort(403);
        }

        $filePath = storage_path('app/public/' . $file->file_path);

        if (!file_exists($filePath)) {
            abort(404, 'File tidak ditemukan');
        }

        return response()->download($filePath, $file->original_name);
    }
}
