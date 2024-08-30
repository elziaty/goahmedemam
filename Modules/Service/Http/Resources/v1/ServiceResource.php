<?php

namespace Modules\Service\Http\Resources\v1;

use App\Http\Resources\v1\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;


class ServiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
                "id"                        => $this->id,
                "name"                      => (string)$this->name,
                "description"               => (string)$this->description,
                "price_currency"            =>(string) businessCurrency($this->business_id).' '.$this->price,
                "price"                     =>(string) $this->price,
                "my_status"                 => __('status.'.$this->status),
                "status"                    => (string)$this->status,
                "position"                  => (string)$this->position,
                'created_at'        => $this->created_at->format('d M Y, h:i A'),
                'updated_at'        => $this->updated_at->format('d M Y, h:i A'),
            ];
    }

}
