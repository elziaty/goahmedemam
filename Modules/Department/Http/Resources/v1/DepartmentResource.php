<?php

namespace Modules\Department\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;


class DepartmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
                "id"                => $this->id,
                "name"              => $this->name,
                "position"          =>(string) $this->position,
                "status"            => (string)$this->status,
            ];
    }

}
