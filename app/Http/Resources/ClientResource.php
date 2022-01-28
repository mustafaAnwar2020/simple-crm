<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=> $this->id,
            'contact_name'=> $this->contact_name,
            'contact_phone'=> $this->contact_phone,
            'contact_email'=> $this->contact_email,
            'company_name'=> $this->company_name,
            'company_address'=> $this->company_address,
            'company_zip'=> $this->company_zip,
            'company_vat'=> $this->company_vat,
            'created_at'=> $this->created_at,
            'updated_at'=> $this->updated_at
        ];
    }
}
