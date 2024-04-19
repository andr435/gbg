$( document ).ready(function(){
    $( ".show" ).on( "click", function() {
        $.get('http://localhost:8080/public/api/user/'+$(this).data('id'))
        .done(function(data) {
            json = $.parseJSON(data);
            if(json.hasOwnProperty('error')){
                alert(json['error']['message']);
            } else {
                $("#un").text(json['data']['username']);
                $("#email").text(json['data']['email']);
                $("#pwd").text(json['data']['password']);
                $("#date").text(json['data']['birthday']);
                $("#phone").text(json['data']['phone']);
                $("#url").text(json['data']['url']);
                $('#container').css({visibility: "visible", display: "block"});
                
            }
        })
        .fail(function() {
            alert( "error" );
        });
    });

    $('.close-reveal-modal').click(function(){
        $('#container').css({visibility: "hidden", display: "none"});
    });

    $( ".delete" ).on( "click", function() {
        if (confirm("Are you sure?")) {
            $.ajax({
                url: 'http://localhost:8080/public/api/user/'+$(this).data('id'),
                type: 'DELETE',
                success: function(data) {
                    json = $.parseJSON(data);
                    if(json.hasOwnProperty('error')){
                        alert(json['error']['message']);
                    } else {
                        location.reload();
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', status, error);
                }
            });
        }    
    });

});