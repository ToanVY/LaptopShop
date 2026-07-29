<?php

if(!isset($_SESSION["cart"])){

    $_SESSION["cart"] = [];

}

/*
    Cấu trúc

    $_SESSION["cart"] = [

        product_id => quantity

    ];

*/
function addCart($id)
{

    if(isset($_SESSION["cart"][$id])){

        $_SESSION["cart"][$id]++;

    }else{

        $_SESSION["cart"][$id]=1;

    }

}
function increaseCart($id)
{

    if(isset($_SESSION["cart"][$id])){

        $_SESSION["cart"][$id]++;

    }

}
function decreaseCart($id)
{

    if(isset($_SESSION["cart"][$id])){

        $_SESSION["cart"][$id]--;

        if($_SESSION["cart"][$id]<=0){

            unset($_SESSION["cart"][$id]);

        }

    }

}
function removeCart($id)
{

    unset($_SESSION["cart"][$id]);

}
function clearCart()
{

    $_SESSION["cart"]=[];

}