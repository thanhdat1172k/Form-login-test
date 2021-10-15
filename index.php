<!DOCTYPE HTML>
<html>

<head>
    <style>
        .error {
            color: #FF0000;
        }
    </style>
</head>

<body>

    <?php
    // define variables and set to empty values
    $emailErr = $passErr = "";
    $email = $pass = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (empty($_POST["email"]) || empty($_POST["password"])) {
            if (empty($_POST["email"])) $emailErr = "Email is required";
            if (empty($_POST["password"])) $passErr = "Password is required";
        } else {
            $email = test_input($_POST["email"]);
            // check if e-mail address is well-formed
            $check = filter_var($email, FILTER_VALIDATE_EMAIL);
            //$check = preg_match ("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+\.[A-Za-z]{2,6}$/", $email);
            if (!$check) {
                $emailErr = "Invalid email format";
            } else {
                echo "Welcome " . $_POST['email'] . "<br />"; //$_REQUEST['email'];
                echo "Password is: " . $_POST['password'], "<br />"; //$_REQUEST['password'];
                exit();
            }
        }
    }

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>

    <h1>LOGIN</h1>
    <p><span class="error">* required field</span></p>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        E-mail: <input type="text" name="email">
        <span class="error">* <?php echo $emailErr; ?></span>
        <br><br>
        Password: <input type="password" name="password">
        <span class="error">* <?php echo $passErr; ?></span>
        <br><br>
        <input type="submit" name="submit" value="Submit">
    </form>

</body>

</html>