<?php 

    function getQtt() {

        $totalQtt = 0;

        if(isset($_SESSION['products'])) {
            foreach($_SESSION['products'] as $product) {
                $quantity = $product['qtt'];
                $totalQtt += $quantity;
            } } 

            return $totalQtt;
    }
?>