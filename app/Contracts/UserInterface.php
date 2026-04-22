<?php

namespace App\Contracts;

interface UserInterface
{
    public function getEmail();
    public function getLastName();
    public function getFirstName();
    public function getMiddleName();
    public function getBirthday();
    public function getPhone();
    public function getAddress();
    public function getFullName();
    public function setPassword(string $password);

}
