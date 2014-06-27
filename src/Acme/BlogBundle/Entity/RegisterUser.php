<?php
namespace Acme\BlogBundle\Entity;



use Acme\SecurityBundle\Entity\User;

class RegisterUser extends User{

    private $passwordConfirm;

    public function setPasswordConfirm($passwordConfirm)
    {
        $this->passwordConfirm = $passwordConfirm;

        return $this;
    }

    public function getPasswordConfirm()
    {
        return $this->passwordConfirm;
    }

}