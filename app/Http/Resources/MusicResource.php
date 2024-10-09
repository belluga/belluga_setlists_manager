<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MusicResource extends JsonResource {
    public function toArray($request): array {
        return [
            "name" => $this->name,
            "tone" => $this->tone,
            "composer" => $this->composer,
            "interpreter" => $this->interpreter,
            "genres" => $this->genres,
            "play_settings" => $this->play_settings,
            "raw_content" => $this->raw_content,
            "owner" => UserResource::make($this->owner)
        ];
    }
}
