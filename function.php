<?php 
    function getQtt() {
        $totalQtt = 0;

        foreach($_SESSION['products'] as $product) {
            $quantity = $product['qtt'];
            $totalQtt += $quantity;
        }

        return $totalQtt;
    }
?>