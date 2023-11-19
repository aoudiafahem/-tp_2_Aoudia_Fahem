<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        $stmt = $dbh->prepare("INSERT INTO addresses (street, street_nb, type, city, zipcode) VALUES (:street, :street_nb, :type, :city, :zipcode)");

        for ($i = 1; isset($_POST['street' . $i]); $i++) {
            $street = $_POST['street' . $i];
            $street_nb = $_POST['street_nb' . $i];
            $type = $_POST['type' . $i];
            $city = $_POST['city' . $i];
            $zipcode = $_POST['zipcode' . $i];

            $stmt->bindParam(':street', $street);
            $stmt->bindParam(':street_nb', $street_nb);
            $stmt->bindParam(':type', $type);
            $stmt->bindParam(':city', $city);
            $stmt->bindParam(':zipcode', $zipcode);

            $stmt->execute();
        }

        // Afficher les adresses enregistrées
        $result = $dbh->query("SELECT * FROM addresses");
        echo '<div class="address-details">';
        echo '<h2>Adresses enregistrées :</h2>';
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo '<p>Adresse : ' . $row['street'] . ' ' . $row['street_nb'] . ', ' . $row['city'] . ', ' . $row['zipcode'] . '</p>';
        }
        echo '</div>';

        // Vous pouvez également ajouter du code pour afficher un message de confirmation
        echo '<p>Adresses enregistrées avec succès !</p>';
    } catch (PDOException $e) {
        echo "Erreur lors de l'enregistrement des données dans la base de données : " . $e->getMessage();
    }
} else {
    header("Location: index.html");
    exit();
}
?>
