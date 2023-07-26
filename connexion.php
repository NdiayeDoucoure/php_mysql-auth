<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connexion à la base de données
    $conn = mysqli_connect("localhost", "root", "", "samabd");

    // Vérification des erreurs de connexion
    if (mysqli_connect_errno()) {
        die("Échec de la connexion à la base de données: " . mysqli_connect_error());
    }

    // Récupération des données du formulaire
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Requête pour récupérer l'utilisateur de la base de données
    $query = "SELECT * FROM userdata WHERE email='$email'";
    $result = mysqli_query($conn, $query);

    // Vérification des informations de connexion
    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user["password"])) {
            // Authentification réussie
            $_SESSION["user_id"] = $user["id"];
            echo "Connexion réussie !";
        } else {
            echo "Mot de passe incorrect.";
        }
    } else {
        echo "Utilisateur non trouvé.";
    }

    // Fermeture de la connexion
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Connexion</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <form method="post" action="connexion.php">
            <h2>Connexion</h2>
            <label>Email:</label>
            <input type="email" name="email" required>
            <label>Mot de Passe:</label>
            <input type="password" name="password" required>
            <input type="submit" value="Se connecter">
        </form>
    </div>
</body>
</html>
