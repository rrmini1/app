<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Stage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'content',
        'start',
        'finish',
        'price',
        'pay_status',
        'work_status',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }
}
