<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\PresentationController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = auth()->user();
    $proposal = null;

    if ($user->role === 'biro') {
        $proposal = \App\Models\Proposal::with('files')
            ->where('user_id', $user->id)
            ->latest()
            ->first();
    }

    return view('dashboard', ['proposal' => $proposal]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Add routes for proposal submission
Route::middleware(['auth', 'role:biro'])->group(function () {
    Route::get('/proposal/step1', [ProposalController::class, 'step1'])->name('proposal.step1');
    Route::post('/proposal/step1', [ProposalController::class, 'submitStep1'])->name('proposal.submitStep1');
    Route::get('/proposal/step2', [ProposalController::class, 'step2'])->name('proposal.step2');
    Route::post('/proposal/step2', [ProposalController::class, 'submitStep2'])->name('proposal.submitStep2');
    Route::get('/announcements', [App\Http\Controllers\PresentationController::class, 'index'])->name('biro.announcements');
    Route::post('/presentation-confirm', [App\Http\Controllers\PresentationController::class, 'confirm'])->name('biro.confirm-presentation');
    Route::post('/confirm-presentation', [PresentationController::class, 'confirm'])->name('biro.confirm-presentation');
});

Route::middleware(['auth', 'verified', 'role:biro'])->group(function () {
    Route::get('/announcements', [PresentationController::class, 'index'])->name('biro.announcements');
    Route::post('/presentation/confirm', [PresentationController::class, 'confirm'])->name('biro.confirm-presentation');
});

Route::middleware('auth')->group(function () {
    Route::delete('/proposals/{proposal}', [ProposalController::class, 'destroy'])->name('proposal.destroy');
});

// Admin routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/proposal/{proposal}/review', [App\Http\Controllers\AdminController::class, 'reviewProposal'])->name('admin.review.proposal');
    Route::post('/admin/proposal/{proposal}/review', [App\Http\Controllers\AdminController::class, 'submitReview'])->name('admin.review.submit');
    Route::get('/admin/file/{file}/download', [App\Http\Controllers\AdminController::class, 'downloadFile'])->name('admin.download.file');

    // Announcement routes
    Route::get('/admin/announcements', [AnnouncementController::class, 'index'])->name('admin.announcements.index');
    Route::get('/admin/announcements/create', [AnnouncementController::class, 'create'])->name('admin.announcements.create');
    Route::post('/admin/announcements', [AnnouncementController::class, 'store'])->name('admin.announcements.store');

    // Settings routes
    Route::get('/admin/settings', [SettingController::class, 'edit'])->name('admin.settings.edit');
    Route::put('/admin/settings', [SettingController::class, 'update'])->name('admin.settings.update');
});

// Public Pages
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/terms', [PageController::class, 'terms'])->name('terms');
Route::get('/privacy', [PageController::class, 'privacy'])->name('privacy');

require __DIR__ . '/auth.php';
