<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Snippet extends Model
{
    const ACCESS_PUBLIC = 'public';
    const ACCESS_UNLISTED = 'unlisted';
    const ACCESS_PRIVATE = 'private';

    static public function accessStates()
    {
        return [
            self::ACCESS_PUBLIC,
            self::ACCESS_UNLISTED,
            self::ACCESS_PRIVATE
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
