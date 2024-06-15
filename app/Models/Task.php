<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Task extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'comment',
        'created_by',
        'assigned_to_user',
        'assigned_to_building',
        'status'
    ];

    /**
     * Get the user who created the task.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the user assigned to the task.
     */
    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to_user');
    }

    /**
     * Get the building assigned to the task.
     */
    public function assignedBuilding()
    {
        return $this->belongsTo(Building::class, 'assigned_to_building');
    }

    /**
     * Get the comments made to the task
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
