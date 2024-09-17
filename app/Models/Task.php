<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'due_date',
        'priority',
    ];

    public const PRIORITY_HIGH = 1;
    public const PRIORITY_MEDIUM = 2;
    public const PRIORITY_LOW = 3;

    public const PRIORITY = [
        self::PRIORITY_HIGH => 'High',
        self::PRIORITY_MEDIUM => 'Medium',
        self::PRIORITY_LOW => 'Low',
    ];

    public function getPriorityNameAttribute(): string
    {
        return self::PRIORITY[$this->priority] ?? 'Unknown priority';
    }
}
