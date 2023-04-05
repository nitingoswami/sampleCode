<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'user_id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'token' => $this->createToken('auth_token')->accessToken,
            'roles' => $this->roles->pluck('name'),
            'roles_permissions' => $this->getPermissionsViaRoles()->pluck('name') ?? [],
        ];
    }
}
