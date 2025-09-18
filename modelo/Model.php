<?php

class Model
{
    protected DB $db;

    public function __construct()
    {
        $this->db = DB::getInstance();
    }
}
