<html>
<head>
    <title>Radiare</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body style="background:#EFFBF4;">
<div id="app">
    @yield('content')
</div>
<script>
    function register() {
        let name = $("#name").val();
        let password = $("#password").val();
        let confirm_password = $("#confirm_password").val();
        let email = $("#email").val();
        let phone = $("#phone").val();
        let user_role = $("#user_role").val();

        if (name === "") {
            alert("Please enter Name");
            document.getElementById("name").focus();
            return false;
        } else if(password === "") {
            alert("Please enter password");
            document.getElementById("password").focus();
            return false;
        } else if(confirm_password === "") {
            alert("Please confirm your password");
            document.getElementById("email").focus();
            return false;
        } else if(password !== confirm_password) {
            alert("Passwords do not match");
            document.getElementById("password").focus();
            return false;
        } else if(email === "") {
            alert("Please enter Email Address");
            document.getElementById("email").focus();
            return false;
        } else if(phone === "") {
            alert("Please enter phone number");
            document.getElementById("phone").focus();
            return false;
        } else if(user_role === "") {
            alert("Please select user role");
            document.getElementById("user_role").focus();
            return false;
        }

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'POST',
            url:'/register',
            data:{"_token": "{{ csrf_token() }}",name:name,password:password,email:email,phone:phone,user_role:user_role},
            success:function(data) {
                if(data.status==='AE'){
                    alert(data.message);
                    return false;
                } else {
                    alert(data.message);
                    $( "#new" ).removeClass( "active in" );
                    $( "#register_tab" ).removeClass( "active" );
                    $( "#login_tab" ).addClass( "active" );
                    $( "#user" ).addClass( "active in" );

                    // reset all fields
                    $("#name").val('');
                    $("#password").val('');
                    $("#confirm_password").val('');
                    $("#email").val('');
                    $("#phone").val('');
                    $("#user_role").val('');
                }
            },
        });
    }

    function login() {
        let login_email = $("#login_email").val();
        let login_password = $("#login_password").val();

        if (login_email === "") {
            alert("Please enter your email address");
            document.getElementById("login_email").focus();
            return false;
        } else if(login_password === "") {
            alert("Please enter password");
            document.getElementById("login_password").focus();
            return false;
        }

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'POST',
            url:'/logincheck',
            data:{"_token": "{{ csrf_token() }}",login_email:login_email,login_password:login_password},
            success:function(data) {
                //alert(data);
                if(data.status==='success') {
                    window.location='/home';
                } else {
                    alert(data.message);
                }
            },
        });
    }

    function delete_user(id)
    {
        let msg= confirm("Are you sure you want to delete this user?");
        if(msg===true)
        {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:'POST',
                url:'/delete_confirm',
                data:{"_token": "{{ csrf_token() }}",id:id},
                success:function(data) {
                    //alert(data);
                    if(data.status==='success') {
                        location.reload();
                    } else {
                        alert(data.message);
                    }
                },
            });
        }
    }
</script>
<script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>
</html>
