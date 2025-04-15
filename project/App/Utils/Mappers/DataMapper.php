<?php

namespace App\Utils\Mappers;

use App\Models\Category;
use App\Models\Report;
use App\Models\Store;
use App\Models\User;
use App\Models\Manager;
use App\Models\Employee;
use App\Models\Role;
use App\Models\Product;
use App\Models\MerchandisingData;
use App\Models\Supplier;
use App\Models\Order;
use App\Models\Objectif;
use App\Models\Sale;


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
                $user->getEmployee()->setMontantTotal(isset($data['montant_total']) ? $data['montant_total'] : 0);
                $user->getEmployee()->setQuantityTotal(isset($data['quantity_total']) ? $data['quantity_total'] : 0);
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
        }
        return $datas;
    }

    public static function MerchandisingDataMapper(array $dataArray)
    {
        $datas = [];
        foreach ($dataArray as $data) {
            $instance = new MerchandisingData($data);
            $instance->setStoreName($data['store_name']);
            $datas[] = $instance;
        }
        return $datas;
    }
    public static function RepportMapper(array $dataArray)
    {
        $datas = [];
        foreach ($dataArray as $data) {
            $instance = new Report($data);
            $instance->setUserName($data['first_name'], $data['last_name']);
            $instance->setUserEmail($data['email']);
            $datas[] = $instance;
        }
        return $datas;
    }
    public static function categoriesMapper(array $dataArray)
    {
        $datas = [];
        foreach ($dataArray as $data) {
            $instance = new Category($data);
            $instance->setProductCount($data['product_count']);
            $datas[] = $instance;
        }
        return $datas;
    }
    public static function productsMapper(array $dataArray)
    {
        $datas = [];
        foreach ($dataArray as $data) {
            $instance = new Product($data);
            if (isset($data['product_count'])) {
                $instance->setProductCount($data['product_count']);
                $instance->setTotalSalesQuantity($data['total_sales_quantity']);
            }
    
            if (isset($data['category_name'])) {
                $instance->setCategoryName($data['category_name']);
            }
            $datas[] = $instance;
        }
        return $datas;
    }
    public static function supplierMapper(array $dataArray)
    {
        $datas = [];
        foreach ($dataArray as $data) {
            $instance = new Supplier($data);
            $datas[] = $instance;
        }
        return $datas;
    }

    public static function orderMapper(array $dataArray)
    {
        $datas = [];
        foreach ($dataArray as $data) {
            $instance = new Order($data);
            $instance->setProductName($data['product_name']);
            $instance->setSupplierName($data['supplier_name']);
            $datas[] = $instance;
        }
        return $datas;
    }
    public static function productMapper(array $dataArray)
    {
        $datas = [];
        foreach ($dataArray as $data) {
            $instance = new Order($data);
            $instance->setProductName($data['product_name']);
            $instance->setSupplierName($data['supplier_name']);
            $datas[] = $instance;
        }
        return $datas;
    }

    public static function objectifMapper(array $dataArray)
    {
        $datas = [];
        foreach ($dataArray as $data) {
            $instance = new Objectif($data);
            $instance->setTotal_quantity_sold($data['total_quantity_sold']);
            $instance->setTotal_sales_amount($data['total_sales_amount']);
            $instance->setAchievement_status($data['achievement_status']);
            $instance->setPercentage($data['percentage']);
            $datas[] = $instance;
        }
        return $datas;
    }



}
