<?php 
error_reporting(E_ERROR | E_PARSE);

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

                    if(isset($_FILES['file'])){
                        
                        $tmpName = $_FILES['file']['tmp_name'];
                        $img_name = $_FILES['file']['name'];
                        $size = $_FILES['file']['size'];
                        $error = $_FILES['file']['error'];
                        $type = $_FILES['file']['type'];
                    }

                    $tabExtension = explode('.', $img_name); // Sépare le nom du fichier et son extension
                    $extension = strtolower(end($tabExtension)); // Stock l'extension
                    
                    //Tableau des extensions acceptées
                    $extensions = ['jpg', 'png', 'jpeg', 'gif'];

                    // Taille maximale acceptée (en bytes)
                    $maxSize = 400000;

                    // Vérifie que l'extension et la taille sont accepté
                    if (in_array($extension, $extensions) && $size <= $maxSize && $error == 0) {
                        $uniqueName = uniqid('', true);
                        $file = $uniqueName . "." . $extension;
                        move_uploaded_file($tmpName, './upload/' . $file); // Upload le fichier dans le dossier upload
                        
                        if($name && $price && $qtt) {
            
                            $product = [
                                "name" => $name,
                                "price" => $price,
                                "qtt" => $qtt,
                                "total" => $price*$qtt,
                                "image" => $file
                            ];
                
                            $_SESSION['products'][] = $product;
                
                            $_SESSION['message'] = "<p class='succes'>Produit ajouter avec succès</p>";
                        } else {
                            $_SESSION['message'] = "<p class='fail'>Erreur, veuillez verifié les champs</p>";
                        }
                    } else { // Génère un message d'erreur en fonction de l'erreur rencontrée
                        $_SESSION['message'] = "<p class='fail'>Fichier non compatible</p>";
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
                    if(isset($_GET['id']) && isset($_SESSION['products'][$_GET['id']])){
                        $_SESSION['products'][$_GET['id']]['qtt']++;

                        $prix = $_SESSION['products'][$_GET['id']]['price'];
                        $quantite = $_SESSION['products'][$_GET['id']]['qtt'];
                        $totalGeneral = $prix * $quantite;

                        $_SESSION['products'][$_GET['id']]['total'] = $totalGeneral;

                        header("Location:recap.php");
                    }
                }
                break;
            case "deleteOne":
                if(isset($_SESSION['products'])){
                    if(isset($_GET['id']) && isset($_SESSION['products'][$_GET['id']])){
                        $_SESSION['products'][$_GET['id']]['qtt']--;

                        $prix = $_SESSION['products'][$_GET['id']]['price'];
                        $quantite = $_SESSION['products'][$_GET['id']]['qtt'];
                        $totalGeneral = $prix * $quantite;

                        $_SESSION['products'][$_GET['id']]['total'] = $totalGeneral;

                        if($quantite <= 0){
                            unset($_SESSION['products'][$_GET['id']]);
                        }

                        header("Location:recap.php");
                    }
                }
                break;

            case "deleteProduct":
                unset($_SESSION['products'][$_GET['id']]);
                $_SESSION["errors"][] = 'suppression du produit "'. $nom .'" avec succes !';
                header("Location:recap.php");
                break;
        }
    }

    
    
?> 