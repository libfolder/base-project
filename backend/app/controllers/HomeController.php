<?php

declare(strict_types=1);

namespace controllers;

use Base;

class HomeController extends BaseController
{
    public function index(Base $f3): void
    {
        $this->render('home.htm', ['title' => 'Game Backend']);
    }
}
