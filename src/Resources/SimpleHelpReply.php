<?php

namespace Qihucms\SiteHelp\Resources;

use App\Http\Resources\User\User;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class SimpleHelpReply extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'help' => new SimpleHelp($this->help),
            'content' => $this->content,
            'reply' => $this->reply,
            'created_at' => Carbon::parse($this->created_at)->diffForHumans(),
            'updated_at' => Carbon::parse($this->updated_at)->diffForHumans(),
        ];
    }
}
