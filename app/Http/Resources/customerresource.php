<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class customerresource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'iot_uuid' => $this->iot_uuid,
            'mac' => $this->mac,
            'counter' => $this->iot_uuid->count(),
        ];
    }
}
