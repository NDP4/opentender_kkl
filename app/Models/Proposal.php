<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Proposal extends Model
{
    protected $fillable = [
        'user_id',
        'nama_biro',
        'email_biro',
        'nomor_telepon',
        'alamat_kantor',
        'nomor_npwp',
        'informasi_kkl',
        'detail_informasi',
        'status',
        'review_notes'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function files(): HasMany
    {
        return $this->hasMany(ProposalFile::class);
    }
}
