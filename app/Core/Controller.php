<?php

namespace App\Core;

class Controller
{
    public function view($page, $data = []): void
    {
        extract($data);
        require_once __DIR__."/../View/$page.view.php";
        // require_once "../app/views/$view.php";
    }
}
