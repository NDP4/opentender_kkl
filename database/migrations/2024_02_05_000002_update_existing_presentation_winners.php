<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Announcement;
use App\Models\PresentationConfirmation;

return new class extends Migration
{
    public function up(): void
    {
        $winnerAnnouncements = Announcement::where('type', 'winner')->get();

        foreach ($winnerAnnouncements as $announcement) {
            $selectedBiros = json_decode($announcement->selected_biro_ids);
            if (!empty($selectedBiros)) {
                PresentationConfirmation::where('user_id', $selectedBiros[0])
                    ->where('status', 'confirmed')
                    ->update(['is_winner' => true]);
            }
        }
    }

    public function down(): void
    {
        PresentationConfirmation::query()->update(['is_winner' => false]);
    }
};
