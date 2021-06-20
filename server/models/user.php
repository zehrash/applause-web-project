<?php


class User {
    public $userId;
    public $username;
    public $age;
    public $gender;
    public $role;
    public $rating;
    public $password;

    function __construct($userId, $username, $age, $gender, $role, $rating=0, $password) {

        $this->userId = $userId;
        $this->username = $username;
        $this->age = $age;
        $this->gender = $gender;
        $this->role = $role;
        $this->password = $password;
        $this->rating = $rating;
    }

    function updateRating($rating){
        $this->rating += $rating;
    }


}
?>