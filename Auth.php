<?php
header("Content-Type: application/json; charset=utf-8");

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

    public static function clean($value = "")
    {
        $value = trim($value);
        $value = str_replace(" ", "", $value);
        $value = stripslashes($value);
        $value = strip_tags($value);
        $value = htmlspecialchars($value);

        return $value;
    }

    public static function check_length($value = "", $min, $max)
    {
        $result = (mb_strlen($value) < $min || mb_strlen($value) > $max);

        return $result;
    }

    public function get_error_fields($login, $password)
    {
        $login = self::clean($login);
        $password = self::clean($password);
        
        $error_fields = [];
        $response = [];

        if ($login === "" || self::check_length($login, 6, 30)) {
            $error_fields[] = "login";
        }
        if ($password === "" || self::check_length($password, 6, 30) || !ctype_alnum($password)) {
            $error_fields[] = "password";
        }

        if (!empty($error_fields)) {
            $response = [
                "status" => false,
                "type" => 1,
                "message" => "Проверте правильность полей",
                "fields" => $error_fields
            ];

            echo json_encode($response);
            die();

            return $response;
        } else {
            $response = [
                "status" => true,
                "type" => 4,
                "message" => "Все поля заполнены",
                "fields" => $error_fields
            ];

            return $response;
        }
    }

    public function user_authorization($login, $password)
    {
        $login = trim($login);
        $login = str_replace(" ", "", $login);
        $password = trim($password);
        $password = str_replace(" ", "", $password);

        $response = [];
        $password = md5($password);

        $string = file_get_contents("database/data.json");
        $array = json_decode($string, true);
        $flag = false;

        $find_email = "0";
        $find_name = "0";

        foreach ($array as $data) {

            if ($data["login"] === $login && $data["password"] === $password) {

                for ($i = 0; $i < count($array); $i++) {
                    for ($j = 0; $j < count($array[$i]); $j++) {
                        if ($array[$i]["login"] === $login) {
                            $find_name = $array[$i]["name"];
                            $find_email = $array[$i]["email"];
                        }
                    }
                }

                $_SESSION["user"] = [
                    "login" => $login,
                    "name" => $find_name,
                    "email" => $find_email
                ];

                $response = [
                    "status" => true
                ];
                echo json_encode($response);
                
                return $response;
            } else {
                $flag = true;
            }
        }

        if ($flag === true) {
            $response = [
                "status" => false,
                "message" => "Не верный логин или пароль"
            ];
            echo json_encode($response);
            
            return $response;
        }
    }
}
