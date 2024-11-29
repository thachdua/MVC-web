<?php

class student
{
    public int $id;
    public string $name;
    public int $age;
    public string $university;

    function __construct($id, $name, $age, $university)
    {
        $this->id = $id;
        $this->name = $name;
        $this->age = $age;
        $this->university = $university;
    }
}
