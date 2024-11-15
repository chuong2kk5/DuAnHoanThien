<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "../admin/config.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $recaptchaSecret = '6LcdoTgqAAAAALEc6TKoLRsOIxic-oe6AcybW6zR';
    $recaptchaResponse = $_POST['g-recaptcha-response'];

    // Xác thực reCAPTCHA
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$recaptchaSecret&response=$recaptchaResponse");
    $responseKeys = json_decode($response, true);

    if (intval($responseKeys["success"]) !== 1) {
        echo "
            <script>
                Swal.fire({
                    title: 'Oops...',
                    text: 'reCAPTCHA verification failed. Please try again.',
                    icon: 'error'
                }).then(function() {
                    window.location.href = '" . $_SERVER['PHP_SELF'] . "';
                });
            </script>";
        exit();
    }

    if (isset($_POST['username']) && isset($_POST['password']) && !isset($_POST['email'])) {
        // Logic đăng nhập
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        $stmt = $conn->prepare("SELECT user_id, password, email FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($user_id, $hashed_password, $email);
            $stmt->fetch();

            if (password_verify($password, hash: $hashed_password)) {
                $_SESSION['user_id'] = $user_id;
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;
                header("Location: ../html/index.php");
                exit();
            } else {
                echo "
                   <script>
                        Swal.fire({
                            title: 'Oops...',
                            text: 'Wrong username or password.',
                            icon: 'error'
                        }).then(function() {
                            window.location.href = '" . $_SERVER['PHP_SELF'] . "';
                        });
                    </script>";
                exit();
            }
        } else {
            echo "
               <script>
                    Swal.fire({
                        title: 'Oops...',
                        text: 'Username not found.',
                        icon: 'error'
                    }).then(function() {
                        window.location.href = '" . $_SERVER['PHP_SELF'] . "';
                    });
                </script>";
            $stmt->close();
            exit();
        }
    }

    if (isset($_POST['username_signup']) && isset($_POST['email_signup']) && isset($_POST['password_signup']) && isset($_POST['role'])) {
        // Logic đăng ký
        $username = trim($_POST['username_signup']);
        $email = trim($_POST['email_signup']);
        $password = trim($_POST['password_signup']);
        $role = trim($_POST['role']);

        if ($username && $email && $password &&  $role) {
            $stmt = $conn->prepare("SELECT user_id FROM users WHERE username = ? OR email = ?");
            $stmt->bind_param("ss", $username, $email);
            $stmt->execute();
            $stmt->store_result();
           

            if ($stmt->num_rows > 0) {
                echo "
                    <script>
                        Swal.fire({
                            title: 'Oops...',
                            text: 'Username or email already exists.',
                            icon: 'error'
                        });
                    </script>";
            } else {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $username, $email, $hashed_password, $role);

                if ($stmt->execute()) {
                    echo "
                        <script>
                            Swal.fire({
                                title: 'Good job!',
                                text: 'Sign up successful.',
                                icon: 'success'
                            }).then(function() {
                                window.location.href = 'login.php';
                            });
                        </script>";
                } else {
                    echo "
                        <script>
                            Swal.fire({
                                title: 'Oops...',
                                text: 'Please try again.',
                                icon: 'error'
                            });
                        </script>";
                }
            }
            $stmt->close();
        }
    }

}
