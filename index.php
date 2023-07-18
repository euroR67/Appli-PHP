<?php 
    session_start();

    require 'function.php';
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title>Ajout de produit</title>
    </head>
    <body>

        <header>
            <nav>
                <h1>PHP.App</h1>
                <ul>
                    <li><a href="index.php">AJOUT PRODUIT</a></li>
                    <li><a href="recap.php">PANIER</a></li>
                </ul>
            </nav>
        </header>

        <main>
            <?php 
            $total = getQtt();
            echo "<aside> <h3>Produits en session : ".$total."</h3></aside>";
            if(isset($_SESSION['products'])){
                echo $_SESSION['message'];
            } else {
                echo $_SESSION['message'];
            }
            ?>
            <h1>Ajouter un produit</h1>
            <form action="traitement.php" method="post">
                <p>
                    <label>
                        Nom du produit :
                        <input type="text" name="name">
                    </label>
                </p>
                <p>
                    <label>
                        Prix du produit :
                        <input type="number" step="any" name="price">
                    </label>
                </p>
                <p>
                    <label>
                        Quantité désirée :
                        <input type="number" name="qtt" value="1">
                    </label>
                </p>
                <p>
                    <input class="ajouter" type="submit" name="submit" value="Ajouter le produit">
                </p>
            </form>
        </main>

    </body>
</html>