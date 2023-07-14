<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TenantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'logo'      => $this->logo ? url("storage/{$this->logo}") : null,
            'name'      => $this->name,
            'plan_id'   => $this->plan_id,
            'uuid'      => $this->uuid,
            'url'       => $this->url,
        ];

    }
}
