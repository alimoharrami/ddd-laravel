<?php
namespace Modules\Shared\DTOs\User;

class UserAddressDTO
{
    public int $id;
    public ?string $address;
    public ?string $postal_code;

    public function __construct(int $id, ?string $address, ?string $postal_code)
    {
        $this->id = $id;
        $this->address = $address;
        $this->postal_code = $postal_code;
    }
}
