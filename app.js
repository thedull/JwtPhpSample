$(function () {
    $('form').submit(function (event) {
        var formData = $(this).serializeArray();
        authenticate(formData[0].value, formData[1].value);
        event.preventDefault();
    });
});

function authenticate(user, pass) {
    $.ajax({
        url: 'login.php',
        method: 'POST',
        type: 'json',
        data: {username: user, password: pass}
    })
        .done(function (data) {
            if (data.success) {
                $('#invalid_user').html('');
                localStorage.setItem('token', data.data.token);
                window.location.href = "user.html";
            }
            else {
                $('#invalid_user').html(
                    '<div class="alert alert-warning alert-dismissible" role="alert">  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Warning!</strong> Invalid user/password</div>');
            }
        });
}