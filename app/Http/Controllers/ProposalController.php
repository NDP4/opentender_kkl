<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use App\Models\ProposalFile;
use App\Notifications\ProposalSubmitted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProposalController extends Controller
{
    public function step1()
    {
        $user = Auth::user();
        $proposal = Proposal::where('user_id', $user->id)
            ->where('status', 'draft')
            ->first();

        return view('proposal.step1', [
            'nama_biro' => $proposal ? $proposal->nama_biro : $user->name,
            'email_biro' => $proposal ? $proposal->email_biro : $user->email,
            'nomor_telepon' => $proposal ? $proposal->nomor_telepon : '',
            'alamat_kantor' => $proposal ? $proposal->alamat_kantor : '',
            'nomor_npwp' => $proposal ? $proposal->nomor_npwp : '',
            'informasi_kkl' => $proposal ? $proposal->informasi_kkl : '',
            'detail_informasi' => $proposal ? $proposal->detail_informasi : ''
        ]);
    }

    public function submitStep1(Request $request)
    {
        $validated = $request->validate([
            'nama_biro' => 'required|string|max:255',
            'email_biro' => 'required|email',
            'nomor_telepon' => 'required|string|max:20',
            'alamat_kantor' => 'required|string',
            'nomor_npwp' => 'required|string|max:255',
            'informasi_kkl' => 'required|in:sosial_media,rekanan,mahasiswa,lainnya',
            'detail_informasi' => 'required|string|max:255',
        ]);

        $proposal = Proposal::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'status' => 'draft'
            ],
            $validated
        );

        session(['proposal_id' => $proposal->id]);

        return redirect()->route('proposal.step2');
    }

    public function step2()
    {
        if (!session()->has('proposal_id')) {
            return redirect()->route('proposal.step1')
                ->with('error', 'Harap lengkapi data pada Step 1 terlebih dahulu.');
        }

        $proposal = Proposal::findOrFail(session('proposal_id'));

        return view('proposal.step2', [
            'proposal' => $proposal
        ]);
    }

    public function submitStep2(Request $request)
    {
        if (!session()->has('proposal_id')) {
            return redirect()->route('proposal.step1')
                ->with('error', 'Harap lengkapi data pada Step 1 terlebih dahulu.');
        }

        $request->validate([
            'scan_ktp' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'foto_kantor' => 'required|file|mimes:jpg,jpeg,png|max:2048',
            'scan_akta' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'company_profile' => 'required|file|mimes:pdf|max:2048',
            'penawaran' => 'required|file|mimes:pdf|max:2048',
            'agree_terms' => 'required|accepted',
        ]);

        $proposal = Proposal::findOrFail(session('proposal_id'));
        $biroName = Str::slug($proposal->nama_biro);
        $fileTypes = [
            'scan_ktp' => 'ktp',
            'foto_kantor' => 'kantor',
            'scan_akta' => 'akta',
            'company_profile' => 'companyprofile',
            'penawaran' => 'penawaran'
        ];

        foreach ($fileTypes as $inputName => $fileType) {
            if ($request->hasFile($inputName)) {
                $file = $request->file($inputName);
                $extension = $file->getClientOriginalExtension();
                $fileName = $biroName . '_' . $fileType . '.' . $extension;

                // Delete existing file if exists
                $existingFile = ProposalFile::where('proposal_id', $proposal->id)
                    ->where('type', $inputName)
                    ->first();

                if ($existingFile) {
                    Storage::delete($existingFile->file_path);
                    $existingFile->delete();
                }

                // Store new file
                $path = $file->storeAs(
                    "proposal-files/{$proposal->id}",
                    $fileName,
                    'public'  // Ensure files are stored in public disk
                );

                ProposalFile::create([
                    'proposal_id' => $proposal->id,
                    'type' => $inputName,
                    'file_path' => $path,
                    'original_name' => $fileName,
                    'mime_type' => $file->getMimeType(),
                ]);
            }
        }

        $proposal->update(['status' => 'submitted']);
        session()->forget('proposal_id');

        // Send email notification
        $user = Auth::user();
        $user->notify(new ProposalSubmitted($proposal));

        return redirect()->route('dashboard')
            ->with('success', 'Proposal berhasil disubmit! Silakan cek email Anda untuk informasi lebih lanjut.');
    }

    public function destroy(Proposal $proposal)
    {
        if ($proposal->user_id !== auth()->id()) {
            abort(403);
        }

        if (in_array($proposal->status, ['reviewing', 'accepted'])) {
            return back()->with('error', 'Tidak dapat menghapus proposal yang sedang direview atau sudah diterima.');
        }

        // Delete related files from storage
        foreach ($proposal->files as $file) {
            Storage::disk('public')->delete($file->file_path);
        }

        // Delete proposal and related data (files will be deleted via cascade)
        $proposal->delete();

        return redirect()->route('dashboard')
            ->with('success', 'Proposal berhasil dihapus.');
    }
}
