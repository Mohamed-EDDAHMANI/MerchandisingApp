<?php

namespace App\Utils\Mappers;

use App\Models\Store;
use App\Models\User;
use App\Models\Manager;
use App\Models\Employee;
use App\Models\Role;


class dataMapper
{
    public static function StoreMapper(array $storeData)
    {
        $stores = [];
        foreach ($storeData as $store) {
            $stores[] = new Store($store);
        }
        ;
        return $stores;
    }

    public static function UserMapper(array $usersData)
    {
        $users = [];
        foreach ($usersData as $data) {
            $user = new User($data);
            
            if (!empty($data['manager_salary'])) {
                $user->setManager(new Manager($data));
            }

            if (!empty($data['employee_salary'])) {
                $user->setEmployee(new Employee($data));
            }

            $user->setRole(new Role($data));
            $user->setStore(new Store($data));

            $users[] = $user;
        }
        return $users;
    }

    public static function EmployeeMapper(array $employeeData)
    {
        $employees = [];
        foreach ($employeeData as $employee) {
            $employees[] = new Store($employee);
        }
        return $employees;
    }
    public static function ManagerMapper(array $managerData)
    {
        $managers = [];
        foreach ($managerData as $manager) {
            $managers[] = new Store($manager);
        }
        return $managers;
    }
}
