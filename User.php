<?php

class User extends Data
{
    public $table = 'user';
    public $database = 'site';

    public $name;
    public $surname;
    public $patronymic;
    public $login;
    public $email;
    public $password;
    public $password_repeat;
    public $rules;

    public $validName;
    public $validSurname;
    public $validPatronymic = NULL;
    public $validLogin;
    public $validEmail;
    public $validPassword;
    public $validPassword_repeat;
    public $validRules;

    public $id;
    public $block_time = NULL;
    public $is_block = 0;
    public $token = NULL;
    public $id_role = 2;

    public $loginAdmin = 'admin';
    public $passwordAdmin = 'admin';
    
    public $isGuest = false;
    public $isAdmin = false;
    public $role;

    public $request;
    public $mysql;

    public function __construct($request, $mysql) {
        $this->request = $request;
        $this->mysql = $mysql;
        if ($this->token = $this->request->getToken()) {
            $this->identity();
            // var_dump($this);
        }
    }

    public function load($mas) {
        // foreach ($mas as $key => $val) {
        //     if (property_exists($this, $key)) {
        //         $this->$key = $val;
        //     }    
        // }

        parent::load($mas);

        if ($this->isAdmin()) {
            $this->isAdmin = true;
            $this->role = 'admin';
        } else {
            $this->role = 'author';
        }
    }

    public function validateRegister() {

        if (empty($this->name)) {
            $this->validName = 'Заполните поле!';
        }
        if (empty($this->surname)) {
            $this->validSurname = 'Заполните поле!';
        }
        if (empty($this->login)) {
            $this->validLogin = 'Заполните поле!';
        }
        if (empty($this->email)) {
            $this->validEmail = 'Заполните поле!';
        }
        if (empty($this->password)) {
            $this->validPassword = 'Заполните поле!';
        } elseif (mb_strlen($this->password) < 6) {
            $this->validPassword = 'Пароль должен содержать не менее 6 символов!';
        }
        if (empty($this->password_repeat)) {
            $this->validPassword_repeat = 'Заполните поле!';
        } elseif ($this->password_repeat != $this->password) {
            $this->validPassword_repeat = 'Пароли не совпадают!';
        }
        if ($this->rules != 'accept') {
            $this->validRules = 'Необходимо согласиться с правилами регистрации!';
        }

        return $this->validateData();

        // foreach (get_object_vars($this) as $key => $val) {
        //     if (str_contains($key, 'valid') && !empty($val)) {
        //         return false;
        //         // echo "$key => $val <br>";
        //     }
        // }

        // return true;
    }

    public function save() {
        return $this->mysql->query("INSERT INTO user(`name`, `surname`, `patronymic`, `login`, `email`, `password`, `token`, `id_role`) VALUES ('$this->name', '$this->surname', '$this->patronymic', '$this->login', '$this->email', '$this->password', '$this->token', '2')");
    }

    public function validateLogin() {
        if (empty($this->login)) {
            $this->validLogin = 'Заполните поле!';
        }
        if (empty($this->password)) {
            $this->validPassword = 'Заполните поле!';
        }

        return $this->validateData();

        // foreach (get_object_vars($this) as $key => $val) {
        //     if (str_contains($key, 'valid') && !empty($val)) {
        //         return false;
        //         // echo "$key => $val <br>";
        //     }
        // }

        // return true;
    }

    public function login() {
        // echo "<pre>";
        $dataMas = $this->mysql->querySelect("SELECT * FROM user WHERE `login` = '$this->login' and `password` = '$this->password' ORDER BY id ASC");
        // var_dump($this);
        if (empty($dataMas)) {
            $this->isGuest = true;
            $this->validPassword = 'Неверные логин или пароль!';
            return false;
        } else {
            $this->load($dataMas[0]);
            $this->setToken();
            $this->mysql->query("UPDATE `user` SET `token` = '$this->token' WHERE `login` = '$this->login'");

        }

        // var_dump($this);
        return true;
    }

    public function isAdmin() {
        return ($this->login == $this->loginAdmin && $this->password == $this->passwordAdmin) ? true : false;
    }

    public function setToken() {
        $token = '';
        $symb = [...range(0, 9), ...range('a', 'z'), ...range('A', 'Z')];

        for ($i = 0; $i < 15; $i++ ) {
            $token .= $symb[array_rand($symb)];
        }
        $this->token = $token;
        return $token;
    }

    public function identity($userId = false) {
        if ($userId) {
            $dataMas = $this->mysql->querySelect("SELECT * FROM user WHERE `id` = '$userId'");
        } else {
            $dataMas = $this->mysql->querySelect("SELECT * FROM user WHERE `token` = '$this->token'");
        }
        if (!empty($dataMas)) {
            $this->load($dataMas[0]);
            return true;
        }
        return false;
    }

    public function logout() {
        if ($this->token) {
            $this->mysql->query("UPDATE `user` SET `token` = '' WHERE `login` = '$this->login'");
        }
    }
}

$userData = [
    'name' => 'Nastya',
    'surname' => 'Mishka',
    'email' => 'mulo',
    'login' => 'myLogin',
    'password' => 'myPasswrd',
    'password_repeat' => 'myPassword',

];

// $user = new User();

// echo '<pre>';

// $user->load($userData);

// // var_dump($user);

// var_dump($user->validateRegister());

// var_dump($user);