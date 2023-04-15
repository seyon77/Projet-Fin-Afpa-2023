<?php

require_once "model/order.php";
require_once "model/order_line.php";

function showAllOrders(){
    $orders=getOrderWithTotalandCustomer();
    require "view/orders_view.php";
    }

    function showDetailOrder(){
        $orderId=intval($_GET['id']);
        $order=getOrder($orderId);
        $details=getOrderlineByOrder($orderId);
        require "view/order_details_view.php";
    }

    function showUserOrder(){
        $orderId=$_SESSION['utilisateur']['id'];
        $orders=getOrderWithTotalandCustomer($orderId);
        require "view/order_user_view.php";
    }
    
    function showUserDetailOrder(){
        $orderId=intval($_GET['id']);
        $order=getOrder($orderId);
        $details=getOrderlineByOrder($orderId);
        require "view/order_details_view.php";
    }
?>
    