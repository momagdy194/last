<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class UserFullResource extends JsonResource
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
            'user_id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'email_verified' => $this->email_verified,
            'mobile' => $this->mobile,
            'mobile_verified' => $this->mobile_verified,
            'shipping_address' => new AddressResource( $this->shippingAddress),
            'biling_address' => new AddressResource($this->billingAddress ),
            'member_since' => $this->created_at->format('l jS \\of F Y'),
        ];
    }
}
