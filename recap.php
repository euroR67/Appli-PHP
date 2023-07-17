<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title>Récapitulatif des produits</title>
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

    <?php

        if(!isset($_SESSION['products']) || empty($_SESSION['products'])) {
            echo "<p>Aucun produit en session...</p>";
        } else {
            echo "<main>",
                        "<h2 class='titreRecap'>Produit ajouter</h2>",
                    "<table>",
                        "<thead>",
                            "<tr>",
                                "<th style='width:10%'>#</th>",
                                "<th style='width:40%'>Nom</th>",
                                "<th style='width:15%'>Prix</th>",
                                "<th style='width:5%'>Quantité</th>",
                                "<th style='width:25%'>Total</th>",
                            "</tr>",
                        "</thead>",
                    "</body>";
                    $totalGeneral = 0;
                    foreach($_SESSION['products'] as $index => $product) {
                        echo "<tr>",
                                "<td>".$index."</td>",
                                "<td>".$product['name']."</td>",
                                "<td>".number_format($product['price'], 2, ",", "&nbsp;")."&nbsp;€</td>",
                                "<td>".$product['qtt']."</td>",
                                "<td>".number_format($product['total'], 2, ",", "&nbsp;")."&nbsp;€</td>",
                            "</tr>";
                        $totalGeneral+= $product['total'];
                    }
                    echo "<tr>",
                            "<td colspan=4>Total général : </td>",
                            "<td><strong>".number_format($totalGeneral,2,",","&nbsp;")."&nbsp;€</strong></td>",
                        "</tr>";
                    echo "</tbody>",
                    "</table>",
                "</main>";
        }

    ?>

    
    </body>
</html>