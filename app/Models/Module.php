<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Module extends Model
{
    protected $guarded = ['id'];

    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }
}
