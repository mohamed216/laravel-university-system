<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'user_id',
        'action',
        'entity_type',
        'entity_id',
        'description',
        'old_values',
        'new_values',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'old_values' => 'array',
        'new_values' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function entity()
    {
        if ($this->entity_type && $this->entity_id) {
            return $this->entity_type::find($this->entity_id);
        }
        return null;
    }

    public static function logAction($action, $description = null, $entity = null, $oldValues = null, $newValues = null)
    {
        $activity = static::create([
            'user_id' => auth()->id(),
            'action' => $action,
            'entity_type' => $entity ? get_class($entity) : null,
            'entity_id' => $entity?->id,
            'description' => $description,
            'old_values' => $oldValues,
            'new_values' => $newValues,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        return $activity;
    }

    public static function logLogin($user)
    {
        return static::logAction(
            'login',
            "User {$user->name} logged in",
            $user
        );
    }

    public static function logLogout($user)
    {
        return static::logAction(
            'logout',
            "User {$user->name} logged out",
            $user
        );
    }

    public static function logCreate($entity, $description = null)
    {
        return static::logAction(
            'create',
            $description ?? "Created " . class_basename($entity),
            $entity,
            null,
            $entity->toArray()
        );
    }

    public static function logUpdate($entity, $oldValues, $description = null)
    {
        return static::logAction(
            'update',
            $description ?? "Updated " . class_basename($entity),
            $entity,
            $oldValues,
            $entity->toArray()
        );
    }

    public static function logDelete($entity, $description = null)
    {
        return static::logAction(
            'delete',
            $description ?? "Deleted " . class_basename($entity),
            $entity,
            $entity->toArray(),
            null
        );
    }
}
