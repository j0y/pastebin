<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Snippet extends Model
{
    const ACCESS_PUBLIC = 'public';
    const ACCESS_UNLISTED = 'unlisted';
    const ACCESS_PRIVATE = 'private';

    /**
     *  Setup model event hooks
     */
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = uniqid();
        });
    }

    protected $fillable = [
        'title',
        'code',
        'access',
        'syntax'
    ];

    static public function accessStates()
    {
        return [
            self::ACCESS_PUBLIC,
            self::ACCESS_UNLISTED,
            self::ACCESS_PRIVATE
        ];
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
