<?php

require_once "connect.php";


class UserContext extends Database
{
    public function __construct()
    {

    }

    public function Add($oauth_uid, $email)
    {
        $sql = "INSERT INTO users (oauth_uid, email) VALUES (:oauth_uid,:email)";
        $pdostm = parent::getDb()->prepare($sql);
        $pdostm->bindParam(':oauth_uid', $oauth_uid);
        $pdostm->bindParam(':email', $email);
        $numRowsAffected = $pdostm->execute();
        $id = parent::getDb()->lastInsertId();
        return $id;
    }

    public function CheckUserExist($oauth_uid)
    {
        $sql = "select * from users where oauth_uid = :oauth_uid";
        $pdostm = parent::getDb()->prepare($sql);
        $pdostm->bindParam(':oauth_uid', $oauth_uid);
        $pdostm->execute();
        $user = $pdostm->fetch(PDO::FETCH_OBJ);
        return $user;
    }

    //just adding the address and restaurant id
    public function AddRestaurant($restaurantId, $name, $address)
    {
        $sql = "INSERT INTO restaurants (zomato_id, name, address) VALUES (:zomato_id,:name,:address)";
        $pdostm = parent::getDb()->prepare($sql);
        $pdostm->bindParam(':zomato_id', $restaurantId);
        $pdostm->bindParam(':name', $name);
        $pdostm->bindParam(':address', $address);
        $numRowsAffected = $pdostm->execute();
        $id = parent::getDb()->lastInsertId();
        return $id;
    }

    public function CheckRestaurantExist($id)
    {
        $sql = "select * from restaurants where zomato_id = :id";
        $pdostm = parent::getDb()->prepare($sql);
        $pdostm->bindParam(':id', $id);
        $pdostm->execute();
        $user = $pdostm->fetch(PDO::FETCH_OBJ);
        return $user;
    }

    public function CheckRestaurantExistForUser($userId, $restaurantid)
    {
        $sql = "select * from users_restaurants where user_id = :id and restaurant_id= :restaurantid";
        $pdostm = parent::getDb()->prepare($sql);
        $pdostm->bindParam(':id', $userId);
        $pdostm->bindParam(':restaurantid', $restaurantid);
        $pdostm->execute();
        $user = $pdostm->fetch(PDO::FETCH_OBJ);
        return $user;
    }

    public function AddFavRestaurantForUser($userId, $restaurantid)
    {
        $sql = "INSERT INTO users_restaurants (user_id, restaurant_id) VALUES (:user_id,:restaurant_id)";
        $pdostm = parent::getDb()->prepare($sql);
        $pdostm->bindParam(':user_id', $userId);
        $pdostm->bindParam(':restaurant_id', $restaurantid);
        $numRowsAffected = $pdostm->execute();
        $id = parent::getDb()->lastInsertId();
        return $id;
    }

    public function ListAllFavRestaurants($userid)
    {
        $sql = "SELECT r.* from restaurants r JOIN users_restaurants ur on r.id = ur.restaurant_id where ur.user_id = :id";
        $pdostm = parent::getDb()->prepare($sql);
        $pdostm->bindParam(':id', $userid);
        $pdostm->execute();
        $restaurants = $pdostm->fetchAll(PDO::FETCH_OBJ);
        return $restaurants;
    }

    public function AddCityToUser($userid, $city)
    {
        $sql = "INSERT INTO users_cities (user_id, city_id) VALUES (:user_id,:city_id)";
        $pdostm = parent::getDb()->prepare($sql);
        $pdostm->bindParam(':user_id', $userid);
        $pdostm->bindParam(':city_id', $city);
        $numRowsAffected = $pdostm->execute();
        return $numRowsAffected;
    }

    public function ListAllUserCity($userid)
    {
        $sql = "SELECT * from users_cities where user_id = :id";
        $pdostm = parent::getDb()->prepare($sql);
        $pdostm->bindParam(':id', $userid);
        $pdostm->execute();
        $cities = $pdostm->fetchAll(PDO::FETCH_OBJ);
        return $cities;
    }

    public function GetRandomCity($userid)
    {
        $sql = "SELECT * FROM users_cities WHERE user_id=:id  ORDER BY RAND() LIMIT 1;";
        $pdostm = parent::getDb()->prepare($sql);
        $pdostm->bindParam(':id', $userid);
        $pdostm->execute();
        $cities = $pdostm->fetch(PDO::FETCH_OBJ);
        return $cities;
    }

    public function DeleteCityFromUser($cityUserId)
    {
        $sql = "Delete d from users_cities d  where id = :id;";
        $pdostm = parent::getDb()->prepare($sql);
        $pdostm->bindParam(':id', $cityUserId);
        $count = $pdostm->execute();
        return $count;

    }
}