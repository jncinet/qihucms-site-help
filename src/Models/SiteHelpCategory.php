<?php

namespace Qihucms\SiteHelp\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SiteHelpCategory extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name', 'desc', 'ico', 'sort', 'status'
    ];

    /**
     * @return HasMany
     */
    public function help(): HasMany
    {
        return $this->hasMany('Qihucms\SiteHelp\Models\SiteHelp', 'site_help_category_id');
    }
}