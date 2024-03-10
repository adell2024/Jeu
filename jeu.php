<?php

class Jeu
{
    private $aDeviner = 30;
    private $message = -1;
    private $value = null;
    public function __construct()
    {
    }

    public function deviner($chiffre = null)
    {
        if (isset($chiffre)) {
            $tries = Session::get("usertries");
            $tries = $tries + 1;
            Session::set("usertries", $tries);
            $this->value = (int)$_GET['chiffre'];
            if ($this->value > $this->aDeviner) {
                $this->message = 1;
            } elseif ($this->value < $this->aDeviner) {
                $this->message = 2;
            } else {
                $this->message = 0;
            }
            $this->value = $_GET['chiffre'];
        }
    }

    public function getMessage()
    {
        return $this->message;
    }
    public function getValue()
    {
        return $this->value;
    }
}
