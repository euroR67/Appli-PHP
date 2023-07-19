<?php 
    ob_start();
    session_start();

    require 'function.php';
?>
    <?php
        $total = getQtt();

        if(!isset($_SESSION['products']) || empty($_SESSION['products'])) {
            echo "<main>",
                        "<aside> <h3>Produits en session : ".$total."</h3></aside>",
                        "<h2 class='titreRecap'>Aucun produit ajouter</h2>",
                    "</main>";
        } else {
            echo "<main>",
                        "<aside> <h3>Produits en session : ".$total."</h3></aside>",
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
                    "<body>";
                    $totalGeneral = 0;
                    foreach($_SESSION['products'] as $index => $product) {
                        echo "<tr>",
                                
                                // insère l'index du produit dans le tableau
                                "<td>".$index."</td>",

                                // insère le nom du produit dans le tableau
                                "<td>".$product['name']."</td>",

                                // insère le prix du produit dans le tableau
                                "<td>".number_format($product['price'], 2, ",", "&nbsp;")."&nbsp;€</td>",

                                // insère la quantité du produit dans le tableau et ajoute les boutons + et -
                                "<td><a class='add' href='traitement.php?action=addOne&id=$index'>+</a> 
                                ".$product['qtt'].
                                " <a class='add' href='traitement.php?action=deleteOne&id=$index'>-</a></td>",
                                "<td>".number_format($product['total'], 2, ",", "&nbsp;")."&nbsp;€</td>",
                                // insère l'image du produit dans le tableau avec un <td> et un <img>
                                "<td><img src='upload/".$_SESSION['products'][$index]['image']."' width='100px'></td>",
                                "<td><a class='delete' href='traitement.php?action=deleteProduct&id=$index'>❌</a></td>",
                            "</tr>";
                        $totalGeneral+= $product['total'];
                    }
                    echo "<tr>",
                            "<td colspan=4>Total général : </td>",
                            "<td><strong>".number_format($totalGeneral,2,",","&nbsp;")."&nbsp;€</strong></td>",
                        "</tr>";
                    echo "</tbody>",
                    "</table>",
                    "<a href='traitement.php?action=deleteAll'>Tout supprimer</a>",
                "</main>";
        }
    $contenu = ob_get_clean();
    require_once('template.php');
    ?>