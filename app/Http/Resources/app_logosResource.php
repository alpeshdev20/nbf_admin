<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class app_logosResource extends JsonResource
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
            'id' => $this->id,
            'file_path' => $this->file_path,
            'text_1' => $this->text_1,
            'text_2' => $this->text_2,
            'text_3' => $this->text_3
        ];
    }
}
