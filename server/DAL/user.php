<?php


class User {
    public $userId;//TODO: add jwt for security
    public $username;
    public $age;
    public $gender;
    public $role;
    public $rating;

    function __construct($username, $age, $gender, $role, $rating=0) {
        $this->username = $username;
        $this->age = $age;
        $this->gender = $gender;
        $this->role = $role;
        $this->rating = $rating;
    }

    function updateRating($rating){
        $this->rating += $rating;
    }

}
