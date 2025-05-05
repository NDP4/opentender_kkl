<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'announcement_date',
        'type',
        'selected_biro_ids',
    ];

    protected $casts = [
        'announcement_date' => 'datetime',
        'selected_biro_ids' => 'array',
    ];

    public function selectedBiros()
    {
        return User::whereIn('id', $this->selected_biro_ids ?? [])->get();
    }

    public function presentationConfirmations(): HasMany
    {
        return $this->hasMany(PresentationConfirmation::class);
    }

    public function isWinnerAnnouncement(): bool
    {
        return $this->type === 'winner';
    }

    public function isPresentationAnnouncement(): bool
    {
        return $this->type === 'presentation';
    }

    public function getWinnerBiro()
    {
        if (!$this->isWinnerAnnouncement() || empty($this->selected_biro_ids)) {
            return null;
        }

        return User::find($this->selected_biro_ids[0]);
    }

    public function isUserSelected(User $user): bool
    {
        return in_array($user->id, $this->selected_biro_ids ?? []);
    }
}
