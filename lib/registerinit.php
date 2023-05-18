<?php
// echo "<pre>";
require_once 'init.php';

if ($request->isPost) {
    $user->load($request->post());
    // $user->validateRegister();
    // var_dump($user);
    if ($user->validateRegister()) {
        if ($user->save()) {
            header("Location: http://localhost/info-system/index.php");
        }
    }
}

// var_dump($user);



