<?php

namespace Qihucms\SiteHelp\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SiteHelp extends Model
{
    protected $fillable = [
        'site_help_category_id', 'title', 'desc', 'thumbnail', 'content', 'useful', 'status'
    ];

    protected $casts = [
        'useful' => 'integer'
    ];

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo('Qihucms\SiteHelp\Models\SiteHelpCategory', 'site_help_category_id');
    }

    /**
     * @return HasMany
     */
    public function replies() : HasMany
    {
        return $this->hasMany('Qihucms\SiteHelp\Models\SiteHelpReply', 'site_help_id');
    }
}