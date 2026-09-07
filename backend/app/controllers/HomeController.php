<?php

declare(strict_types=1);

namespace Controllers;

use Base;
use Models\User;

class HomeController extends BaseController
{
    public function index(Base $f3): void
    {
        $user = new User;
        $this->render('home.htm', ['title' => 'Game Backend']);
    }
}
