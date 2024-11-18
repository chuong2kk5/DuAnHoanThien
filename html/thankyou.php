<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
   

    .thank-you-container {
        text-align: center;
        color: black;
        animation: fadeIn 2s ease-in-out;
    }

    .thank-you-text {
        font-size: 2.5rem;
        font-weight: bold;
        text-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        margin: 0;
    }

    .message {
        font-size: 1.2rem;
        margin-top: 10px;
        opacity: 0.8;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: scale(0.9);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    .confetti {
        position: absolute;
        width: 100%;
        height: 100%;
        pointer-events: none;
        overflow: hidden;
    }

    .confetti span {
        position: absolute;
        width: 10px;
        height: 10px;
        background-color: white;
        opacity: 0.7;
        animation: fall 3s infinite;
        border-radius: 50%;
    }

    @keyframes fall {
        from {
            transform: translateY(-100vh) rotate(0deg);
            opacity: 1;
        }

        to {
            transform: translateY(100vh) rotate(720deg);
            opacity: 0;
        }
    }
</style>

<body>
    <div class="header">
         <?php include('../include/navbar.php'); ?>
    </div>
   
    <br>
    <br>
    <br>
    <br>

    <div class="thank-you-container">
        <h1 class="thank-you-text">Cảm ơn bạn đã mua sắm với chúng tôi! 💖</h1>
        <p class="message">Đơn hàng của bạn đang được xử lý</p>
        <p class="message">Chúng tôi sẽ xử lý đơn hàng của bạn trong thời gian sớm nhất.</p>
        <div class="confetti"></div>
    </div>

    <br>
    <br>
    <br>
    <br>

    <?php include('../include/footer.php'); ?>

</body>



<script>
    const confettiContainer = document.querySelector('.confetti');
    for (let i = 0; i < 100; i++) {
        const confetti = document.createElement('span');
        confetti.style.left = `${Math.random() * 100}%`;
        confetti.style.animationDelay = `${Math.random() * 3}s`;
        confetti.style.backgroundColor = `hsl(${Math.random() * 360}, 100%, 70%)`;
        confettiContainer.appendChild(confetti);
    }

</script>

</html>