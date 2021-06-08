<?php


class User {
    public $userId;//TODO: add jwt for security
    public $username;
    public $age;
    public $gender;
    public $role;
    public $rating;
    public $password;

    function __construct($username, $age, $gender, $role, $rating=0, $password) {
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