<?php

namespace Qihucms\SiteHelp\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class Help extends JsonResource
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
            'category' => new HelpCategory($this->category),
            'replies' => new HelpReplyCollection($this->replies),
            'title' => $this->title,
            'desc' => $this->desc,
            'thumbnail' => empty($this->thumbnail) ? null : Storage::url($this->thumbnail),
            'content' => $this->content,
            'useful' => $this->useful,
            'created_at' => Carbon::parse($this->created_at)->diffForHumans(),
            'updated_at' => Carbon::parse($this->updated_at)->diffForHumans(),
        ];
    }
}
