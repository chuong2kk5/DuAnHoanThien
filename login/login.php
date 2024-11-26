<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/4dd88e3847.js" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="stylesheet" href="style.css" />
    <title>Đăng kí tài khoản</title>
</head>

<body>
    <?php include "logic.php"; ?>
    <div class="container">
        <div class="forms-container">

            <div class="signin-signup">
                <!-- Sign in form -->
                <form action="login.php" method="POST" class="sign-in-form">
                    <h2 class="title">Đăng nhập</h2>

                    <input type="hidden" name="action" value="signin" />

                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input name="username" id="username" type="text" placeholder="Tên đăng nhập" required autofocus />
                    </div>

                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input name="password" id="password" type="password" placeholder="Mật khẩu" required />
                    </div>
                    <div class="g-recaptcha" data-sitekey="6LcdoTgqAAAAACvJOGXqJTgLFHccGFmpfFLXdbcF"></div>

                    <input type="submit" value="Đăng nhập" class="btn solid" />

                    <p class="social-text">Hoặc đăng nhập với</p>
                    <div class="social-media">
                        <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-icon" id="google-signin-btn">
                            <i class="fab fa-google"></i>
                        </a>
                        <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </form>

                <!-- Sign up form -->
                <form action="login.php" method="POST" class="sign-up-form">
                    <h2 class="title">Đăng kí</h2>

                    <input type="hidden" name="action" value="signup" />

                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input name="username_signup" type="text" placeholder="Tên đăng nhập" required autofocus />
                    </div>

                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input id="email_signup" name="email_signup" type="email" placeholder="Email" required />
                    </div>

                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input id="password_signup" name="password_signup" type="password" placeholder="Mật khẩu"
                            required />
                    </div>
<!-- ROLE class
                    <div class="role">
                        <i class="fas fa-user-tag"></i>
                        <select id="role" name="role" required>
                            <option value="customer" selected>Customer</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div> -->
                    <div class="g-recaptcha" data-sitekey="6LcdoTgqAAAAACvJOGXqJTgLFHccGFmpfFLXdbcF"></div>

                    <input type="submit" class="btn" value="Sign up" />
                </form>
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>Bạn chưa có tài khoản?</h3>
                    <p>Đăng kí tài khoản tại đây</p>
                    <button class="btn transparent" id="sign-up-btn">Đăng kí</button>
                </div>
                <img src="../image/bé-gai-1-removebg.png" class="image" alt="" />
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>Bạn đã có tài khoản?</h3>
                    <p>Đăng nhập tại đây</p>
                    <button class="btn transparent" id="sign-in-btn">Đăng nhập</button>
                </div>
                <img src="../image/bé-gai-1-removebg.png" class="image" alt="" />
            </div>
        </div>
    </div>

    <script>
        const sign_in_btn = document.querySelector("#sign-in-btn");
        const sign_up_btn = document.querySelector("#sign-up-btn");
        const container = document.querySelector(".container");

        sign_up_btn.addEventListener("click", () => {
            container.classList.add("sign-up-mode");
        });

        sign_in_btn.addEventListener("click", () => {
            container.classList.remove("sign-up-mode");
        });
    </script>

</body>

</html>