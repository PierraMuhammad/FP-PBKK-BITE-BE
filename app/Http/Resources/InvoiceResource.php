<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[
            'id' => $this->id,
            'user_id' => $this->user_id,
            'product_id' => $this->product,
            'quantity' => $this->quantity,
            'total' => $this->total,
            'status' => $this->status

            // 'id' => $this->id,
            // 'user_id' => $this->user_id,
            // 'status' => $this->status,
            // 'total' => $this->total,
            // 'product' => $this->product
        ];
    }
}
