<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories - V&D Webshop</title>
    <link rel="stylesheet" href="CSS/LoginPagina.css">
</head>
<body>

<section class="login">
    <div class="login-container">
    <h2>Login</h2>
<?php
include 'Connection.php';

if (!isset($conn)) {
    die("Database connection error.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars(trim($_POST["uname"]));
    $password = htmlspecialchars(trim($_POST["psw"]));


    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $hashedPassword = $user['wachtwoord'];
        $role = $user['role'];

        if (password_verify($password, $hashedPassword)) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];

            if ($role == 'Admin') {
                header("Location: Index.php?page=HomePage");
            } elseif ($role == 'Klant') {
                header("Location: Index.php?page=HomePage");
            }
            exit();
        } else {
            echo "<p style='color: red;'>Invalid credentials!</p>";
        }
    } else {
        echo "<p style='color: red;'>Invalid credentials!</p>";
    }

    $stmt->close();
}
?>
    <form action="" method="POST">
        <label for="uname">Email Adres</label>
        <input type="text" id="uname" name="uname" placeholder="Typ uw Email" required>

        <label for="psw">Wachtwoord</label>
        <input type="password" id="psw" name="psw" placeholder="Typ uw Wachtwoord" required>

        <button type="submit">Login</button>
    </form>

    <!-- Registration Section -->
    <div class="register-section">
        <h3>Geen Klant?</h3>
        <div class="line"></div>
        <a href="Index.php?page=RegistratiePagina">Registreren</a>
    </div>
</div>
</section>