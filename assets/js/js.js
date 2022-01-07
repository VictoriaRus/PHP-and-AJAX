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
    
    
});