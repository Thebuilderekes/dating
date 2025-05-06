<?php
class Controller
{
    public function view($view, $data = []): void
    {
        extract($data);
        require_once __DIR__ . "/../views/$view.php";
        //require_once "../app/views/$view.php";
    }
}
