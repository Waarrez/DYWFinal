<?php

namespace App\Form\RegisterForm;


use App\Entity\User;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

final class RegisterHandleForm
{
    public function handle(FormInterface $form, Request $request) {

        $user = new User();
        $form->handleRequest($request);
    }
}