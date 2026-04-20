<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Document extends Model
{
    protected $fillable = [
        'user_id',
        'client_id',
        'project_id',
        'title',
        'original_filename',
        'stored_path',
        'mime_type',
        'size',
        'is_technical',
    ];

    protected $casts = [
        'is_technical' => 'boolean',
    ];

    public function uploader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function softwareRequirementSpecs(): HasMany
    {
        return $this->hasMany(SoftwareRequirementSpec::class);
    }
}
