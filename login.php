<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <title>Đăng nhập</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        main {
            min-height: 100vh;
            background: url('./img/AmletoColucci_LakeGarda.jpg');
            object-fit: contain;
            /* background-position: center; */
            background-size: cover;
        }

        form {
            background-color: #fff;
            width: 500px;
            display: flex;
            flex-direction: column;
            border-radius: 100px;
            box-shadow: 5px 5px 20px 5px rgba(0, 0, 0, 0.5);
            animation: form 2s ease-in-out infinite;
        }



        @keyframes form {
            0% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(15px);
            }

            100% {
                transform: translateY(0);
            }
        }

        img {
            height: 100vh;
        }

        input {
            width: 82%;
            padding: 10px;
            border: none;
            outline: none;
        }

        @media screen and (max-width: 600px) and (min-width: 300px){
            form {
                width: 300px;
                border-radius: 50px;
            }
            input {
                width: 77%;
            }            
        }
        /* input:focus-visible {
            outline: none;
        } */

        .userName-container,
        .pass-container {
            width: 80%;
            border: none;
            border-bottom: 2px solid #000;
            margin: 10px auto;
        }

        .show {
            float: right;
            padding: 10px 10px 10px 0;
        }

        .show:hover {
            cursor: pointer;
        }

        .bx {
            font-size: 20px;
        }

        .btn-signin {
            width: 80%;
            background-color: rgb(11, 198, 227);
            margin: 50px auto 10px auto;
            padding: 10px;
            color: #fff;
            text-transform: uppercase;
            font-size: 20px;
            font-weight: bold;
            transition: 1s;
            /* hiệu ứng chuyển tiếp */
            position: relative;
            /* để xét ::before và ::after */
            display: block;
            border: none;
            overflow: hidden;
            /* ẩn các phần tử thừa bên ngoài class này*/
            z-index: 1;
            /* cho hiện lên trên cùng */
        }

        .btn-signin::before,
        .btn-signin::after {
            position: absolute;
            content: '';
            width: 100%;
            height: 50%;
            background-color: rgb(195, 144, 49);
            transition: 1s;
            z-index: -1;
        }

        .btn-signin::before {
            top: 0;
            left: 100%;
        }

        .btn-signin::after {
            bottom: 0;
            right: 100%;
        }

        .btn-signin:hover::before {
            top: 0;
            left: 0;
        }

        .btn-signin:hover::after {
            bottom: 0;
            right: 0;
        }


        .btn-signin:hover {
            color: #fff;
        }

        .btn-signup {
            margin: 10px auto 30px auto;
        }

        .tittle {
            letter-spacing: 2px;
            margin: 30px auto;
            font-size: 40px;
            font-weight: 700;
            position: relative;
            display: inline-block;
            /* overflow: hidden; */
            transition: 2s;
            /* color: rgb(195, 144, 49); */
        }

        span {
            /* bottom: 0; */
            position: absolute;
            right: 50%;
            display: block;
            width: 10px;
            height: 10px;
            /* background-image: linear-gradient(to right, rgb(11, 198, 227) 50%, rgb(195, 144, 49) 50%); */
            background-color: #000;
            animation: run 5s ease-in-out infinite;
            border-radius: 50%;
        }

        @keyframes run {
            0% {
                right: 100%;
                /* transform: rotate(0); */
            }

            50% {
                right: 0;
                /* transform: rotate(180deg); */
            }

            100% {
                right: 100%;
                /* transform: rotate(360deg); */
            }
        }

        .wrap-form {
            display: flex;
            align-items: center;
            height: 100vh;
            justify-content: center;
            border: 1px solid #000;
        }



        @keyframes show {
            0% {
                transform: translateX(100%);
            }

            100% {
                transform: translateX(0);
            }
        }
        .error{
            background: #F2DEDE;
            color: #a94442;
            padding: 10px;
            width: 95%;
            border-radius: 5px;
            margin-left: 10px;
        }
    </style>
    <script>
        $(document).ready(function () {
            showPass();

            function showPass() {
                $('.show').off('click');
                $('.show').on('click', function () {
                    let passContainer = $(this).closest('.pass-container'); // 
                    let passInput = passContainer.find('.pass'); // lấy input từ pass
                    let isShown = passInput.attr('type') === 'password'; // lấy loại type 

                    if (isShown) { // nếu pass là dạng 'password' thì làm
                        passInput.attr('type', 'text');
                        $(this).removeClass('bx bx-show').addClass('bx bx-hide'); // thay icon
                    } else {
                        passInput.attr('type', 'password');
                        $(this).removeClass('bx bx-hide').addClass('bx bx-show');
                    }
                });
            }
        }
        )
    </script>
</head>

<body>
    <main class="">

        <div class="wrap-form">
            <form action="server.php" method="post">
                <div class="tittle">
                    Đăng nhập
                    <span></span>
                </div>
                <?php if(isset($_GET['error'])){?>
                    <p class="error"><?php echo $_GET['error']; ?></p>
                <?php } ?>
                <div class="userName-container">
                    <i class='bx bxs-user-circle'></i>
                    <input type="text" placeholder="Tên người dùng" class="user-name" name="username">
                </div>
                <div class="pass-container">
                    <i class='bx bxs-lock-alt'></i>
                    <input type="password" placeholder="Mật khẩu" class="pass" name="password">
                    <i class='bx bx-show show'></i>
                </div>
                <button type="submit" class="btn-signin btn">Đăng nhập</button>
                <div class="btn-signup">Hoặc <a href="Signup.php">Đăng ký</a></div>
            </form>
        </div>

    </main>
</body>

</html>