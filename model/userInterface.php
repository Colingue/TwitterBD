<?php

interface UserInterface
{
    public function findAll();

    public function save(Array $user);
}

?>