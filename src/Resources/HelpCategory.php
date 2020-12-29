<?php

namespace Qihucms\SiteHelp\Resources;

use App\Http\Resources\User\User;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class HelpCategory extends JsonResource
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
            'name' => $this->name,
            'ico' => empty($this->ico) ? null : Storage::url($this->ico),
            'desc' => $this->desc,
        ];
    }
}
