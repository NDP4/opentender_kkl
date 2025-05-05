<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProposalFile extends Model
{
    protected $fillable = [
        'proposal_id',
        'type',
        'file_path',
        'original_name',
        'mime_type'
    ];

    public function proposal(): BelongsTo
    {
        return $this->belongsTo(Proposal::class);
    }
}
