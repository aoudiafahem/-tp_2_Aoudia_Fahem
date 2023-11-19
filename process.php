<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $num_addresses = filter_input(INPUT_POST, 'num_addresses', FILTER_VALIDATE_INT);
    if ($num_addresses === false || $num_addresses <= 0) {
        header("Location: index.html");
        exit();
    }

    echo '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title>Formulaire d\'adresses</title>
    </head>
    <body>
        <div class="container">
            <form action="submit.php" method="post">';

    for ($i = 1; $i <= $num_addresses; $i++) {
        echo '<label for="street' . $i . '">Adresse ' . $i . '</label>
        <input type="text" id="street' . $i . '" name="street' . $i . '" maxlength="50" required>
        
        <label for="street_nb' . $i . '">Numéro de rue</label>
        <input type="number" id="street_nb' . $i . '" name="street_nb' . $i . '" required>
        
        <label for="type' . $i . '">Type</label>
        <select id="type' . $i . '" name="type' . $i . '" maxlength="20" required>
            <option value="livraison">Livraison</option>
            <option value="facturation">Facturation</option>
            <option value="autre">Autre</option>
        </select>
        
        <label for="city' . $i . '">Ville</label>
        <select id="city' . $i . '" name="city' . $i . '" required>
            <option value="Montréal">Montréal</option>
            <option value="Laval">Laval</option>
            <option value="Toronto">Toronto</option>
            <option value="Québec">Québec</option>
            <!-- Ajoutez dautres options selon vos besoins -->
        </select>
        <label for="zipcode' . $i . '">Code postal</label>
        <input type="text" id="zipcode' . $i . '" name="zipcode' . $i . '" pattern="[A-Za-z]\d[A-Za-z]?\s?\d[A-Za-z]\d" placeholder="Ex. H8R2X3" required>';
        
    }

    echo '<button type="submit">Suivant</button>
            </form>
        </div>
    </body>
    </html>';
} else {
    header("Location: index.html");
    exit();
}
?>
