    <?php 
        ob_start();
        session_start();

        require 'function.php';
    ?>
            <main>
                <?php 
                    $total = getQtt();
                    echo "<aside> <h3>Produits en session : ".$total."</h3></aside>";
                    if(isset($_SESSION['message'])){
                        echo $_SESSION['message'];
                    }
                    unset($_SESSION['message']);
                ?>
                <h1>Ajouter un produit</h1>
                <form action="traitement.php?action=add" method="post" enctype="multipart/form-data">
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
                        <label for="file">Image du produit</label>
                        <input style="margin-top: 10px;" class="file" type="file" name="file">
                    </p>
                    <p>
                        <input class="ajouter" type="submit" name="submit" value="Ajouter le produit">
                    </p>
                </form>
            </main>
<?php
$title="ajouter un produit";
$contenu = ob_get_clean();
require_once('template.php');
?>