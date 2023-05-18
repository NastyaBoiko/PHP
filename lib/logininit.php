<?php
require_once 'init.php';

if ($request->isPost) {
    $user->load($request->post());
    if ($user->validateLogin()) {
        // $user->login();
        // var_dump($user);
        if ($user->login()) {
            header("Location: http://localhost/info-system/index.php?token=$user->token");
        }
    }
} 
//Проверка, что пользователь заполняется по токену
/* else {
    $user->token = '9mYWda0R8kqCs6U';
    $user->identity();
    var_dump($user);
} */

