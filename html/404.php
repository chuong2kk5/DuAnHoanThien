<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Not Found</title>
</head>
<style>
    .container {
        text-align: center;
    }

    .number-container {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 20px;
        margin-top: 20px;
    }

    .number {
        font-size: 7rem;
        font-weight: bold;
        color: #4A90E2;
        text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
        transition: transform 0.3s ease;
    }

    .number:hover {
        transform: scale(1.2);
    }

    p {
        font-size: 1.5rem;
        color: #666;
        text-align: center;
    }

    a.back {
        text-align: center;
        display: inline-block;
        margin-top: 20px;
        padding: 10px 20px;
        background-color: #4A90E2;
        color: whitesmoke;
        text-decoration: none;
        border-radius: 5px;
    }

    a.back:hover {
        background-color: #0056b3;
        color: #ffffff;
        text-decoration: none;

    }
</style>

<body>
    <?php include "../include/header.php"; ?>
    <?php include "../include/navbar.php"; ?>
    <div class="number-container">
        <h1 class="number">4</h1>
        <h1 class="number">0</h1>
        <h1 class="number">4</h1>
    </div>
    <p>Sorry, the page you are looking for does not exist.</p>
    <div style="text-align: center;">
    <a class="back" href="../html/index.php">Go to Homepage</a>

    </div>


    <?php include "../include/footer.php"; ?>


</body>

</html>