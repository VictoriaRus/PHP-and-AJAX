<?php
header('Content-Type: application/json; charset=utf-8');

class Auth
{
    public $login;
    public $password;
    public $response;
    
    public function __construct($login, $password)
    {
        $this->login = $login;
        $this->password = $password;
        $this->response = [];
    }

    public function get_error_fields($login, $password)
    {
        $error_fields = [];
        $response = [];

        if ($login === '') {
            $error_fields[] = "login";
        }
        if ($password === '') {
            $error_fields[] = "password";
        }

        if (!empty($error_fields)) {
            $response = [
                "status" => false,
                "type" => 1,
                "message" => 'Проверте правильность полей',
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

    public function user_authorization($login, $password)
    {
        $response = [];
        $password = md5($password);

        $string = file_get_contents("database/data.json");
        $array = json_decode($string, true);
        $flag = false;

        $find_email = '0';
        $find_name = '0';
        foreach ($array as $data) {
            if ($data['login'] === $login && $data['password'] === $password) {

                for ($i = 0; $i < count($array); $i++) {
                    for ($j = 0; $j < count($array[$i]); $j++) {
                        if ($array[$i]['login'] === $login) {
                            $find_name = $array[$i]['name'];
                            $find_email = $array[$i]['email'];
                        }
                    }
                }

                $_SESSION['user'] = [
                    "login" => $login,
                    "name" => $find_name,
                    "email" => $find_email
                ];

                $response = [
                    "status" => true
                ];
                echo json_encode($response);
                //exit();
                return $response;
            } else {
                $flag = true;
            }
        }

        if ($flag === true) {
            $response = [
                "status" => false,
                "message" => 'Не верный логин или пароль'
            ];
            echo json_encode($response);
            return $response;
        }
    }
}//конец class
