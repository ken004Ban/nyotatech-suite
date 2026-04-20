<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SoftwareRequirementSpec extends Model
{
    protected $fillable = [
        'project_id',
        'document_id',
        'title',
        'product_name',
        'stakeholders',
        'functional_requirements',
        'non_functional_requirements',
        'assumptions',
        'generated_at',
    ];

    protected $casts = [
        'generated_at' => 'datetime',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function document(): BelongsTo
    {
        return $this->belongsTo(Document::class);
    }
}
