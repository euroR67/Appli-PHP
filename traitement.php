<?php 

    session_start();

    if(isset($_POST['submit'])) {

        $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
        $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT);

        if($name && $price && $qtt) {

            $product = [
                "name" => $name,
                "price" => $price,
                "qtt" => $qtt,
                "total" => $price*$qtt
            ];

            $_SESSION['products'][] = $product;

            $_SESSION['message'] = "<p class='succes'>Produit ajouter avec succès</p>";
        } else {
            $_SESSION['message'] = "<p class='succes'>Erreur, veuillez verifié les champs</p>";
        }
    }
    
    if($_GET['action'] === 'deleteAll') {
        if(isset($_SESSION['products'])){
            unset($_SESSION['products']);
        }
    }
    
    header("Location:index.php");
    
?> 