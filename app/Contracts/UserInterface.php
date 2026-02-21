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
    public function getRole();
    public function fullName();
    public function isAdmin();
    public function password();
}
