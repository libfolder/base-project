<?php

declare(strict_types=1);

namespace Controllers;

use Base;

abstract class BaseController
{
    protected Base $f3;

    public function __construct()
    {
        $this->f3 = \Base::instance();
    }

    protected function render(string $template, array $data = []): void
    {
        $this->f3->set('content', $template);
        foreach ($data as $key => $value) {
            $this->f3->set($key, $value);
        }
        echo \Template::instance()->render('layout.htm');
    }

    protected function json(mixed $payload, int $status = 200): void
    {
        header('Content-Type: application/json; charset=UTF-8', true, $status);
        echo json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    protected function notFound(string $message = 'Not Found'): void
    {
        $this->json(['error' => $message], 404);
    }
}
