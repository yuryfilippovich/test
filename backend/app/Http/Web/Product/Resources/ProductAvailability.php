<?php
namespace App\Http\Web\Product\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductAvailability extends JsonResource
{
    /**
     * @inheritDoc
     */
    public function toArray($request): array
    {
        return [
            'shop' => $this->getShop(),
            'address' => $this->getAddress(),
            'available' => $this->getAvailable(),
        ];
    }
}
