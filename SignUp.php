<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function () {
            showPass();
            function showPass() {
                $('.show').off('click');
                $('.show').on('click', function () {
                    let passContainer = $(this).closest('.pass-container'); // 
                    let passInput = passContainer.find('.btn-show'); // lấy input từ pass có class là btn-show
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
            
            // canvas
            var canvas = $('canvas')[0];
            // var canvas = document.querySelector('canvas');
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;

            var pen = canvas.getContext('2d');

            var mouse = {
                x: window.innerWidth / 2,
                y: window.innerHeight / 2
            }

            var circleArray = [];
            var colors = ['#E37B40', '#46B29D', '#DE5B49', '#324D5C', '#F0CA4D'];

            function Circle(x, y, r, dx, dy) {
                this.x = x;
                this.y = y;
                this.r = r;
                this.color = colors[Math.floor(Math.random() * colors.length)];
                this.draw = function () {
                    pen.beginPath();
                    pen.arc(this.x, this.y, this.r, 0, Math.PI * 2);
                    pen.fillStyle = this.color;
                    pen.fill();
                }
                this.update = function () {
                    this.x = this.x + dx;
                    this.y = this.y + dy;
                    // (mouse.x): vi tri bat dau cua truc x - (this.x) vi tri hien tai cua no
                    if (mouse.x - this.x < 30 && mouse.x - this.x > -30 && mouse.y - this.y < 30 && mouse.y - this.y > -30) {
                        if (this.r < 10) {
                            this.r += 1; // ban kinh se to ra trong khoang (-100, 100)
                        }
                    } else {
                        if (this.r > 0) {
                            this.r -= 1; // neu ban kinh > 0 thi se giam ban kinh cua no
                        }
                    }
                    this.draw();
                }
            }

            function begin() {
                requestAnimationFrame(begin); //duoc goi lai lien tuc
                pen.clearRect(0, 0, canvas.width, canvas.height); // xoa duong di
                if (mouseIn == true) {
                    var x = mouse.x;
                    var y = mouse.y;
                    var r = 1; // ban kinh

                    var dx = (Math.random() - 0.5) * 3; // tao khoang cach giua cac hinh tron moi tao ra
                    var dy = (Math.random() - 0.5) * 3; // (tao so am de tao lui co the qua trai va qua phai)

                    circleArray.push(new Circle(x, y, r, dx, dy)); // them
                }

                for (var i = 0; i < circleArray.length; i++) {
                    if (circleArray[i].r <= 0) {
                        circleArray.splice(i, 1); // xoa phan tu
                    }
                    circleArray[i].update();
                }
                // console.log(circleArray);
            }
            var mouseIn = false;
            function preventMouseEnter() {
                window.addEventListener('mousemove', function (e) {
                    mouse.x = e.pageX;
                    mouse.y = e.pageY;
                    mouseIn = true;
                });
                window.addEventListener('mouseout', function (e) {
                    mouseIn = false;
                });
            }
            preventMouseEnter();
            begin();

        });
    </script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        main {
            min-height: 100vh;
            background: url('./img/starryNight.jpg');
            /* object-fit: contain; */
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
            /* border: 1px solid #000; */
            position: relative;
        }

        .logo {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
        }



        @keyframes show {
            0% {
                transform: translateX(100%);
            }

            100% {
                transform: translateX(0);
            }
        }
        canvas {
            width: 100%;
            height: 100vh;
        }
    </style>

</head>

<body>
<script>
    function function_alert() {
        alert("Sign Up success");
    }
</script>
            
            
    <main class="">

    <!-- <img src="" alt=""> -->
        <div class="wrap-form">
            <div class="logo">
                <canvas></canvas>
            </div>
            <form action="SignUpFunction.php" method="post">
                <div class="tittle">
                    Đăng ký
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
                    <input type="password" placeholder="Mật khẩu" class="pass btn-show" name="psw">
                    <i class='bx bx-show show'></i>
                </div>
                <div class="pass-container">
                    <i class='bx bxs-lock-alt'></i>
                    <input type="password" placeholder="Nhập lại mật khẩu" class="pass2nd btn-show" name="rpsw">
                    <i class='bx bx-show show'></i>
                </div>
                <button type="submit" onclick="function_alert()" class="btn-signin btn">Đăng ký</button>
                <div class="btn-signup">Bạn đã có tài khoản? <a href="login.php">Đăng nhập</a></div>
            </form>
        </div>
    </main>
</body>

</html>