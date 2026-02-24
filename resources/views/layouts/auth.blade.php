<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Auth</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body{
            min-height: 100vh;
            background-color: #e5e5e5;
            font-family: 'Segoe UI', sans-serif;
            padding: 3rem;
        }

        .auth-container{
            background: #f4efea;
            border-radius: 25px;
            overflow: hidden;
        }

        header{
            padding: 15px 25px;
            border-bottom: 3px solid #cbbba9;
            font-size: 22px;
            font-weight: 700;
            color: #3f3f46;
        }

        .left-side{
            padding: 60px;
            border-right: 3px solid #cbbba9;
        }

        .left-side h1{
            font-size: 38px;
            font-weight: 700;
            color: #1f2937;
        }

        .left-side p{
            color: #6b7280;
            margin-bottom: 30px;
        }

        .form-label{
            font-weight: 600;
            color: #374151;
        }

        .input-wrapper{
            position: relative;
        }

        .form-control{
            height: 50px;
            border-radius: 12px;
            border: 1px solid #ddd;
            padding-left: 45px;
            padding-right: 45px;
        }

        .left-icon{
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            color: #9ca3af;
        }

        .right-icon{
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            cursor: pointer;
            color: #9ca3af;
        }

        .btn-login{
            width: 100%;
            height: 50px;
            border-radius: 30px;
            background: #cbbba9;
            border: none;
            font-weight: 600;
            color: white;
            transition: 0.3s ease;
        }

        .btn-login:hover{
            background: #b8a692;
        }

        .bottom-text{
            font-size: 14px;
            color: #6b7280;
        }

        .bottom-text a{
            color: #1f2937;
            font-weight: 600;
            text-decoration: none;
        }

        .right-side{
            background: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .right-side img{
            max-width: 90%;
            height: auto;
        }

        .forgot-link {
            font-size: 14px;
            color: #6b7280;
            text-decoration: none;
            font-weight: 500;
            transition: 0.2s ease;
        }

        .forgot-link:hover {
            color: #1f2937;
            text-decoration: underline;
        }


        /* Responsive */
        @media(max-width: 991px){
            body{
                padding: 1rem;
            }

            .auth-container{
                border-radius: 15px;
            }

            .left-side{
                padding: 30px;
                border-right: none;
            }

            .right-side{
                display: none;
            }
        }
    </style>
</head>
<body>

    @yield('content')

    <script>
        function togglePassword() {
            const password = document.getElementById("password");
            const icon = document.getElementById("toggleIcon");

            if (password.type === "password") {
                password.type = "text";
                icon.classList.remove("bi-eye");
                icon.classList.add("bi-eye-slash");
            } else {
                password.type = "password";
                icon.classList.remove("bi-eye-slash");
                icon.classList.add("bi-eye");
            }
        }
    </script>


</body>
</html>
