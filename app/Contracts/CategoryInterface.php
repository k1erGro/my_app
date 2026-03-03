<?php

namespace App\Contracts;

interface CategoryInterface
{
    public function getName();
    public function getSlug();
    public function getParentId();

    public function parent();
    public function children();
}
