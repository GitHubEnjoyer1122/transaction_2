<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet" />
    <title>Login</title>
</head>

<body>
    <div class='center-par'>
        <form action="loginAuth" method='post' class='form'>
            @csrf
            <i class='form-icon ri-user-line'></i>
            <div>
                <!-- <img src="icon/user-fill.png" alt="" class='normal-icon'> -->
                <i class="ri-user-fill"></i>
                <input type="text" name='username' placeholder='Username'>
            </div>

            <div>
                <!-- <img src="icon/user-fill.png" alt="" class='normal-icon'> -->
                <i class="ri-lock-fill"></i>
                <input type="password" name='password' placeholder='Password'>
            </div>

            <button type="submit">Login</button>
        </form>
    </div>

    <script src="js/main.js"></script>
</body>

</html>