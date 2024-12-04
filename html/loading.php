<?php
include_once '../admin/config.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    .dots-container {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: rgba(0, 0, 0, 0.8);
        z-index: 9999;
    }

    .dots-container {
        opacity: 1;
        transition: opacity 0.5s ease-in-out;
    }

    .dots-container.hidden {
        opacity: 0;
        pointer-events: none;
    }

    .dot {
        height: 20px;
        width: 20px;
        margin-right: 10px;
        border-radius: 10px;
        background-color: #b3d4fc;
        animation: pulse 1.5s infinite ease-in-out;
    }

    .dots-container.hidden {
        opacity: 0;
        pointer-events: none;
    }

    .dot:last-child {
        margin-right: 0;
    }

    .dot:nth-child(1) {
        animation-delay: -0.3s;
    }

    .dot:nth-child(2) {
        animation-delay: -0.1s;
    }

    .dot:nth-child(3) {
        animation-delay: 0.1s;
    }

    @keyframes pulse {
        0% {
            transform: scale(0.8);
            background-color: #b3d4fc;
            box-shadow: 0 0 0 0 rgba(178, 212, 252, 0.7);
        }

        50% {
            transform: scale(1.2);
            background-color: #6793fb;
            box-shadow: 0 0 0 10px rgba(178, 212, 252, 0);
        }

        100% {
            transform: scale(0.8);
            background-color: #b3d4fc;
            box-shadow: 0 0 0 0 rgba(178, 212, 252, 0.7);
        }
    }

    @media (max-width: 600px) {
        .dot {
            height: 15px;
            width: 15px;
            margin-right: 8px;
        }
    }
</style>

<body>

    <section id="loading" class="overlay">
        <div class="dots-container">
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </div>
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const loadingContainer = document.querySelector('.dots-container');

            setTimeout(() => {
                loadingContainer.classList.add('hidden');
                setTimeout(() => {
                    loadingContainer.style.display = 'none';
                }, 700);
            }, 340);
        });

    </script>
</body>

</html>