<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'applicant' => $this->applicant,
            'applicant_experience' => $this->applicant ? $this->applicant->applicant_experience :NULL,
            'applicant_education' => $this->applicant ? $this->applicant->applicant_education :NULL,
            'user_id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'roles' => $this->roles->pluck('name'),
            'roles_permissions' => $this->getPermissionsViaRoles()->pluck('name') ?? [],
        ];
    }
}
