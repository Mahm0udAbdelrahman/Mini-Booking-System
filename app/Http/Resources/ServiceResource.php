<?php
namespace App\Http\Resources;

use App\Http\Resources\SlotResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
            "id"    => $this->id,
            'name'  => $this->name,
            'price' => $this->price,
            'slot'  => SlotResource::collection($this->timeSlots()->isAvailable()->get()),
        ];
    }
}
