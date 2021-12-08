<?php
    

    switch($_POST['controllerMethod'])
    {
        case 'create':
                Create();
                break;
        case 'update':
                Update();
                break;
    }

    function Create()
    {
        include('../config.php');
        $name       = $_POST['name'];
        $price      = $_POST['price'];
        $quantity   = $_POST['quantity']; 
    
        $sql = "INSERT INTO products(Name, Price, Quantity)
        VALUES ('$name', '$price', '$quantity')";
    
        if (mysqli_query($conn, $sql)) {
                    echo "New record created successfully";
            } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            
            header("refresh:2; url = ../Views/ProductViews/index.php");
            
            mysqli_close($conn);
    }

    function Update()
    {
        include('../config.php');
        $Id       = $_POST['Id'];
        $name       = $_POST['name'];
        $price      = $_POST['price'];
        $quantity   = $_POST['quantity']; 
    
        $sql = "update products 
                set name = '$name', price = $price, quantity = $quantity
                where id = $Id"; 
    
        if (mysqli_query($conn, $sql)) {
                    echo "Record Updated!";
            } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            
            header("refresh:1; url = ../Views/ProductViews/index.php");
            
            mysqli_close($conn);
    }

?>