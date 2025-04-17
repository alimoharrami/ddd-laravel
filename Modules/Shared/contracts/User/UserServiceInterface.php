<?php

namespace App\Shared\Contracts\User;

use Modules\Shared\DTOs\User\UserAddressDTO;
use Modules\Shared\DTOs\User\UserDTO;


interface UserServiceInterface
{
    /**
     * get user dto with user id
     *
     * @param int $userId
     * @return UserDTO|null
     */
    public function getUserDTO(int $userId): ?UserDTO;

    /**
     * get many users DTOs
     *
     * @param array $userIds
     * @return UserDTO[]
     */
    public function getUserDTOs(array $userIds): array;

    /**
     * get user address dto with user id
     *
     * @param int $userId
     * @return UserAddressDTO|null
     */
    public function getUserAddressDTO(int $userId): ?UserAddressDTO;
}
