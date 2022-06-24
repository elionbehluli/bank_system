<?php

namespace App\Models;
use system\Model;

class Customer extends Model
{

    protected $id;
    protected $name;
    protected $email;
    protected $phone_number;
    protected $address;
    protected $card;
    protected $password;
    protected $branch_id;

    public $conn;

    public function __construct(){

        parent :: __construct();
        $this->conn = $this->databaseConnection;

    }

    //get methods
    public function getId(){
        return $this->id;
    }

    public function getName(){
        return $this->name;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getPhoneNmuber(){
        return $this->phone_number;
    }

    public function getAddress(){
        return $this->address;
    }

    public function getCard(){
        return $this->card;
    }

    public function getPassword(){
        return $this->password;
    }

    public function getBranchId() {
        return $this->branch_id;
    }

    //set methods
    public function setId(string $id) {
        $this->id = $id;
    }

    public function setName(string $name) {
        $this->name = $name;
    }

    public function setEmail(string $email) {
        $this->email = $email;
    }

    public function setPhoneNmuber(string $phone_number) {
        $this->phone_number = $phone_number;
    }

    public function setAddress(string $address) {
        $this->address = $address;
    }

    public function setCard(string $card) {
        $this->card = $card;
    }

    public function setPassword(string $password) {
        $this->password = $password;
    }

    public function setBranchId(string $branch_id) {
        $this->branch_id = $branch_id;
    }

    //crud

    public function create()
    {
        
    }

}

?>