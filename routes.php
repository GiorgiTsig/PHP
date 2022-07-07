<?php

$requestUri = $_SERVER['REQUEST_URI'];

switch ($requestUri) {
    case '/':
        require_once __DIR__ . '/templates/registration.php';
        break;
    case '/save_signup_record':
        require_once 'Form.php';
        $form = new Form();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = $form->create();
        }

        if (count($errors) > 0) {
            print_r(json_encode($errors));
            break;
        }

        echo 1;
        break;
    case '/delete_signup_record':
        require_once 'Form.php';
        $form = new Form();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $form->delete();
        }
        break;
    case '/users_table':
        require_once __DIR__ . '/templates/users_table.php';
}
