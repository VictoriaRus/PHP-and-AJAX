$(document).ready(function () {

    //Авторизация
    $("#login-btn").click(
        function () {
            $(`input`).removeClass('alert-danger');
            let login = $('input[name="login"]').val();
            let password = $('input[name="password"]').val();
            $.ajax({
                url: '/singin.php',
                type: "POST",
                dataType: "json",
                data: {
                    login: login,
                    password: password
                },
                success: function (data) {
                    if (data.status === true) {
                        console.log(data);//сюда поподает сообещение от сервера
                        document.location.href = '/profile.php';
                    } else {
                        if (data.type === 1) {
                            data.fields.forEach(function (field) {
                                $(`input[name="${field}"]`).addClass('alert-danger');
                            });
                        }
                        $('.msg').removeClass('none').text(data.message);
                    }
                }
            });
        }
    );

    ///Регистрация
    $('#register-btn').click(function () {

        $(`input`).removeClass('alert-danger');

        let login = $('input[name="login"]').val();
        let password = $('input[name="password"]').val();
        let confirm_password = $('input[name="confirm_password"]').val();
        let email = $('input[name="email"]').val();
        let name = $('input[name="name"]').val();

        let formData = new FormData();
        formData.append('login', login);
        formData.append('password', password);
        formData.append('confirm_password', confirm_password);
        formData.append('email', email);
        formData.append('name', name);


        $.ajax({
            url: '/singup.php',
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            cache: false,
            data: formData,
            success(data) {

                if (data.status) {
                    document.location.href = '/index.php';
                } else {

                    if (data.type === 1) {
                        data.fields.forEach(function (field) {
                            $(`input[name="${field}"]`).addClass('alert-danger');
                        });
                    }

                    $('.msg').removeClass('none').text(data.message);

                }

            }
        });

    });



    /*
        $("#txtConfirmPassword").keyup(checkPasswordMatch);//проврека пароля
        //Регистрация
        function checkPasswordMatch() {
            var password = $("#txtNewPassword").val();
            var confirmPassword = $("#txtConfirmPassword").val();
    
            if (password != confirmPassword) {
                $("#divCheckPasswordMatch").html("Пароли не соответствуют!").css("color", "red");
            }
            else {
                $("#divCheckPasswordMatch").html("Пароли совпадают.").css("color", "green");
                //Отправка данных из формы
                $("#btn").click(
                    function () {
                        $(`input`).removeClass('alert-danger');
                        sendAjaxForm('result_form', 'ajax_form', 'singup.php');
                        return false;
                    }
                );
            }
        }
    
        ////Регистрация
        function sendAjaxForm(result_form, ajax_form, url) {
            $.ajax({
                url: url, //url страницы (singup.php)
                type: "POST", //метод отправки
                dataType: "html", //формат данных
                data: $("#" + ajax_form).serialize(),  // Сеарилизуем объект
                success: function (response) { //Данные отправлены успешно
                    result = $.parseJSON(response);
                    $('#result_form').html('Вы успешно зарегистрировались');
                    //$('#result_form').html('Логин: ' + result.login + '<br>Пароль: ' + result.password + '<br>Email: ' + result.email);
                    window.location = "/index.php";
                },
                error: function (response) { // Данные не отправлены
                    $('#result_form').html('Ошибка. Данные не отправлены.');
                }
            });
        }
    
    */


});



/*
let response = [
    {
        "login": "elberet",
        "password": "123",
        "confirm_password": "123",
        "email": "v_i_k_t_o_r_i_a_@inbox.ru",
        "name": "Vika"
    },
    {
        "login": "ТФ",
        "password": "99",
        "confirm_password": "99",
        "email": "Tolik@inbox.ru",
        "name": "Tolik"
    },
]
var keys = Object.keys(response[0]);
console.log("keys "+keys);
var entries = Object.entries(response[0]);
console.log("entries "+entries);

for (let i =0, lenTop = response.length;i < lenTop;i++)
 {
    var entriesDown = Object.entries(response[i]);
    for (let j = 0, lenDown = entriesDown.length;j <lenDown;j++)
    {   
        //console.log(entriesDown[j][1]);
        if (entriesDown[j][1] === 'Толик') 
        {   
            let result = entriesDown[j][1];
            console.log(result);
        }
        else {
            console.log('Не зарегестрирован');
        }
    }
    
}
*/
