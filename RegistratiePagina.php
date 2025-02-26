<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registreren</title>
    <link rel="stylesheet" href="CSS/RegistratiePagina.css">
</head>
<body>

<section class="registratie">
<div class="registration-container">
    <h2>Registreren</h2>
    <?php
    include 'connection.php';

    if (!isset($conn)) {
        die("Database connection error.");
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $voornaam = htmlspecialchars(trim($_POST['Voornaam']));
        $tussenvoegsel = htmlspecialchars(trim($_POST['Tussenvoegsel']));
        $achternaam = htmlspecialchars(trim($_POST['Achternaam']));
        $geboortedatum = htmlspecialchars(trim($_POST['dob']));
        $woonplaats = htmlspecialchars(trim($_POST['Straat']));
        $huisnummer = htmlspecialchars(trim($_POST['Huisnummer']));
        $postcode = htmlspecialchars(trim($_POST['Postcode']));
        $email = htmlspecialchars(trim($_POST['email']));
        $password = password_hash(htmlspecialchars(trim($_POST['password'])), PASSWORD_DEFAULT);
        $role = 'Klant';

        $sql = "INSERT INTO users (voornaam, tussenvoegsel, achternaam, geboortedatum, woonplaats, huisnummer, postcode, email, wachtwoord, role) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param(
                "ssssssssss",
                $voornaam, $tussenvoegsel, $achternaam, $geboortedatum,
                $woonplaats, $huisnummer, $postcode, $email, $password, $role
            );

            if ($stmt->execute()) {
                echo "<p>Registratie succesvol! U kunt nu inloggen.</p>";
            } else {
                echo "<p>Er is een fout opgetreden: " . $stmt->error . "</p>";
            }

            $stmt->close();
        } else {
            echo "<p>Database fout: " . $conn->error . "</p>";
        }
    }
    ?>
    <form action="" method="post">

        <div class="flex-row">
            <div>
                <label for="Voornaam">Voornaam:</label>
                <input type="text" id="Voornaam" name="Voornaam" placeholder="Typ voornaam" required>
            </div>
            <div>
                <label for="Tussenvoegsel">Tussenvoegsel:</label>
                <input type="text" id="Tussenvoegsel" name="Tussenvoegsel" placeholder="Typ tussenvoegsel" required>
            </div>
            <div>
                <label for="Achternaam">Achternaam:</label>
                <input type="text" id="Achternaam" name="Achternaam" placeholder="Typ achternaam" required>
            </div>
        </div>

        <div class="flex-row">
            <div>
                <label for="dob">Geboortedatum:</label>
                <input type="date" id="dob" name="dob" required>
            </div>
            <div>
                <label for="Huisnummer">Huisnummer:</label>
                <input type="text" id="Huisnummer" name="Huisnummer" placeholder="123" required>
            </div>
        </div>

        <div class="flex-row">
            <div>
                <label for="Postcode">Postcode:</label>
                <input type="text" id="Postcode" name="Postcode" placeholder="ab1234" required>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Typ email" required>

            </div>
        </div>

        <div class="flex-row">
            <div class="wide">
                <label for="Woonplaats">Woonplaats en Straat:</label>
                <input type="text" id="Woonplaats" name="Straat" placeholder="Typ straatnaam" required>
            </div>
            <div class="small">
                <label for="password">Wachtwoord:</label>
                <input type="password" id="password" name="password" placeholder="Typ wachtwoord" required>
            </div>
        </div>

        <button type="submit">Registreren</button>

    </form>

    <div class="login-section">
        <h3>Al Klant?</h3>
        <div class="line"></div>
        <a href="Index.php?page=LoginPagina">Login</a>
    </div>

</div>
</section>
</body>
</html>