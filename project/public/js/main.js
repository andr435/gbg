$( document ).ready(function(){
    $( "#add_user" ).on( "click", function() {
        $.post('http://localhost:8080/public/api/user', 
            {   
                username: $('#username').val(), 
                email: $('#email').val(),
                password: $('#password').val(),
                birthday: $('#birthday').val(),
                phone: $('#phone').val(),
                url: $('#url').val()
            })
        .done(function(data) {
            json = $.parseJSON(data);
            if(json.hasOwnProperty('error')){
                alert(json['error']['message']);
            } else {
                alert("user added");
                location.reload();
            }
        })
        .fail(function() {
            alert( "error" );
        });
    });
});