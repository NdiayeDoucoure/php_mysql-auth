<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connexion à la base de données
    $conn = mysqli_connect("localhost", "root", "", "samabd");

    // Vérification des erreurs de connexion
    if (mysqli_connect_errno()) {
        die("Échec de la connexion à la base de données: " . mysqli_connect_error());
    }

    // Récupération des données du formulaire
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    // Requête pour insérer l'utilisateur dans la base de données
    $query = "INSERT INTO userdata (username, email, password) VALUES ('$username', '$email', '$password')";
    $result = mysqli_query($conn, $query);

    // Vérification de l'insertion réussie
    if ($result) {
        echo "Inscription réussie !";
    } else {
        echo "Erreur lors de l'inscription : " . mysqli_error($conn);
    }

    // Fermeture de la connexion
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Inscription</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <form method="post" action="inscription.php">
            <h2>Inscription</h2>
            <label>Nom d'utilisateur:</label>
            <input type="text" name="username" required>
            <label>Email:</label>
            <input type="email" name="email" required>
            <label>Mot de Passe:</label>
            <input type="password" name="password" required>
            <input type="submit" value="S'inscrire">
        </form>
    </div>
</body>
</html>
