<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SetlistResource extends JsonResource {
    public function toArray($request): array {
        return [
            "name" => $this->name,
            "description" => $this->description,
            "shared_with" => $this->shared_with,
            "owner" => $this->owner
        ];
    }
}
