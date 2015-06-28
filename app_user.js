$(function () {
    var token = localStorage.getItem('token');
    if (!token) {
        window.location.href = 'index.html';
    }
    else {
        $.ajax({
            url: 'auth.php',
            type: 'POST',
            dataType: 'json',
            headers: {Authorization : 'Bearer '+token}
        })
            .done(function(data) {
                if (data.success) {
                    setUserInfo(data.data);
                    $('#cloak').hide();
                    $('#body_container').show();
                }
                else {
                    window.location.href = 'index.html';
                }
            })
            .fail(function() {
                window.location.href = 'index.html';
            });
    }

    $('#logout').click(function () {
        localStorage.removeItem('token');
        window.location.href = 'index.html';
    });
});

function setUserInfo(data) {
    $('#user_name').html(data.userName)
}