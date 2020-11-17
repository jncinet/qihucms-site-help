<?php

namespace Qihucms\SiteHelp\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SiteHelpReply extends Model
{
    protected $fillable = [
        'site_help_id', 'user_id', 'content', 'status'
    ];

    /**
     * @return BelongsTo
     */
    public function help(): BelongsTo
    {
        return $this->belongsTo('Qihucms\SiteHelp\Models\SiteHelp', 'site_help_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo('App\Models\User');
    }
}