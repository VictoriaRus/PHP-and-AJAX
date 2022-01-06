<?php
header('Content-Type: application/json; charset=utf-8');

class Registration
{
    public $login;
    public $password;
    public $confirm_password;
    public $email;
    public $name;
    public $response;

    // Конструктор
    public function __construct($login, $password, $confirm_password, $email, $name)
    {
        $this->login = $login;
        $this->password = $password;
        $this->confirm_password = $confirm_password;
        $this->email = $email;
        $this->name = $name;
        $this->response = [];
    }

    public function full_fields($login, $password, $confirm_password, $email, $name)
    {
        $error_fields = [];
        $response = [];

        if ($login === '') {
            $error_fields[] = "login";
        }
        if ($password === '') {
            $error_fields[] = "password";
        }
        if ($confirm_password === '') {
            $error_fields[] = "confirm_password";
        }
        if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error_fields[] = "email";
        }
        if ($name === '') {
            $error_fields[] = "name";
        }

        if (!empty($error_fields)) {
            $response = [
                "status" => false,
                "type" => 1,
                "message" => 'Заполните правильно поля',
                "fields" => $error_fields
            ];

            echo json_encode($response);
            die();
            return $response;
        } else {
            $response = [
                "status" => true,
                "type" => 4,
                "message" => 'Все поля заполнены',
                "fields" => $error_fields
            ];
            return $response;
        }
    }

    public function check_unique_login($login)
    {
        $check_login = $login;

        $database = file_get_contents("database/data.json");
        $array = json_decode($database, true);

        foreach ($array as $data) {
            if ($data['login'] === $check_login) {
                $response = [
                    "status" => false,
                    "type" => 1,
                    "message" => "Такой логин уже существует",
                    "fields" => ['login']
                ];

                echo json_encode($response);
                die();
                return $response;
            }
        }
    }

    public function check_unique_email($email)
    {
        $check_email = $email;
        $database = file_get_contents("database/data.json");
        $array = json_decode($database, true);

        foreach ($array as $data) {
            if ($data['email'] === $check_email) {
                $response = [
                    "status" => false,
                    "type" => 1,
                    "message" => "Такой email уже существует",
                    "fields" => ['email']
                ];

                echo json_encode($response);
                die();
                return $response;
            }
        }
    }

    public function registration($login, $password, $confirm_password, $email, $name)
    {
        if ($password === $confirm_password) {

            if (file_exists('database/data.json')) {
                $file = file_get_contents('database/data.json'); // Открыть файл data.json     
                $taskList = json_decode($file, TRUE); // Декодировать в массив                     
                unset($file); // Очистить переменную $file
                $password = md5($password);
                $confirm_password = md5($confirm_password);
                $taskList[] = array('login' => $login, 'password' => $password, 'confirm_password' => $confirm_password, 'email' => $email, 'name' => $name); // Представить новую переменную как элемент массива, в формате 'ключ'=>'имя переменной'
                file_put_contents('database/data.json', json_encode($taskList, JSON_UNESCAPED_UNICODE));  // Перекодировать в формат и записать в файл.       
                unset($taskList);
            }

            $response = [
                "status" => true,
                "message" => "Регистрация прошла успешно!",
            ];
            echo json_encode($response);
            return $response;
        } else {
            $response = [
                "status" => false,
                "message" => "Пароли не совпадают",
            ];
            echo json_encode($response);
            return $response;
        }
    }
}
