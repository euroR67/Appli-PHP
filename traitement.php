<?php 

    session_start();

    require 'function.php';

    if(isset($_GET['action'])) {
        switch($_GET['action']) {
            
            // Ajouter un produit
            case "add":
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
                    header("Location:index.php");
                }
                break;

            case "deleteAll":
                if(isset($_SESSION['products'])){
                    unset($_SESSION['products']);
                    header("Location:recap.php");
                }
                break;
            
            case "addOne":
                if(isset($_SESSION['products'])){
                    foreach($_SESSION['products'] as $index => $product) {
                        $_SESSION['products'][$index]['qtt']++;
                        $_SESSION['products'][$index]['total'] = $_SESSION['products'][$index]['qtt'] * $_SESSION['products'][$index]['price'];
                    }
                    header("Location:recap.php");
                }
                break;
            case "deleteOne":
                if(isset($_SESSION['products'])){
                    foreach($_SESSION['products'] as $index => $product) {
                        if($_SESSION['products'][$index]['qtt'] > 1){
                            $_SESSION['products'][$index]['qtt']--;
                            $_SESSION['products'][$index]['total'] = $_SESSION['products'][$index]['qtt'] * $_SESSION['products'][$index]['price'];
                        }
                    }
                    header("Location:recap.php");
                }
                break;
            case "deleteProduct":
                if(isset($_SESSION['products'])){
                    foreach($_SESSION['products'] as $index => $product) {
                        if($_SESSION['products'][$index]['qtt'] == 1){
                            unset($_SESSION['products'][$index]);
                        }
                    }
                    header("Location:recap.php");
                }
                break;
        }
    }

    
    
?> 