<?php

namespace Modules\User\Shared;

use App\Shared\Contracts\User\UserServiceInterface;
use models\User;
use Modules\Shared\DTOs\User\UserAddressDTO;
use Modules\Shared\DTOs\User\UserDTO;
use Modules\User\Exceptions\UserNotFoundException;

class UserService implements UserServiceInterface
{
    public function getUserDTO(int $userId): ?UserDTO
    {
        $user = User::query()->find($userId);

        if (!$user) {
            throw new UserNotFoundException("User with ID {$userId} not found.");
        }

        return new UserDTO(
            id: $user->id,
            first_name: $user->first_name,
            last_name: $user->last_name,
            email: $user->email,
            phone: $user->phone,
        );
    }

    public function getUserDTOs(array $userIds): array
    {
        $users = User::query()->whereIn('id', $userIds)->get();

        return $users->map(function ($user) {
            return new UserDTO(
                id: $user->id,
                first_name: $user->first_name,
                last_name: $user->last_name,
                email: $user->email,
                phone: $user->phone,
            );
        })->toArray();
    }

    public function getUserAddressDTO(int $userId): ?UserAddressDTO
    {
        $user = User::query()->find($userId);

        if (!$user) {
            throw new UserNotFoundException("User with ID {$userId} not found.");
        }

        return new UserAddressDTO(
            id: $user->id,
            address: $user->address,
            postal_code: $user->postal_code,
        );
    }
}


