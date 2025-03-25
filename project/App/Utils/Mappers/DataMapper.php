<?php

namespace App\Utils\Mappers;

use App\Models\Category;
use App\Models\Report;
use App\Models\Store;
use App\Models\User;
use App\Models\Manager;
use App\Models\Employee;
use App\Models\Role;
use App\Models\MerchandisingData;


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
    public static function adminMapper($usersData)
    {
        return  new User($usersData); 
    }
    public static function roleMapper($role)
    {
        return  new Role($role); 
    }

    public static function DataMapper(array $dataArray, $class)
    {
        $datas = [];
        foreach ($dataArray as $data) {
            $classPath = 'App\Models\\' . $class;  
            $datas[] = new $classPath($data);
            exit;
        }

        return $datas;
    }

    public static function MerchandisingDataMapper(array $dataArray)
    {
        $datas = [];
        foreach ($dataArray as $data) {
            $instence = new MerchandisingData($data);
            $instence->setStoreName($data['name']);
            $datas[] = $instence;
        }
        return $datas;
    }
    public static function RepportMapper(array $dataArray)
    {
        $datas = [];
        foreach ($dataArray as $data) {
            $instence = new Report($data);
            $instence->setUserName($data['first_name'], $data['last_name']);
            $instence->setUserEmail($data['email']);
            $datas[] = $instence;
        }
        return $datas;
    }
    public static function categoriesMapper(array $dataArray)
    {
        $datas = [];
        foreach ($dataArray as $data) {
            $instence = new Category($data);
            $instence->setProductCount($data['product_count']);
            $datas[] = $instence;
        }
        return $datas;
    }



}
