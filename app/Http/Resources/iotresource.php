<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class iotresource extends JsonResource
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
            'uuid' => $this->uuid,
            'major' => $this->major,
            'minor' => $this->minor,
            'rssi' => $this->rssi,
            'mac_address' => $this->mac_address,

        ];
    }
}
