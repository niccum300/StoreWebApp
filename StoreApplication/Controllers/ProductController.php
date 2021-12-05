<?php
    

    switch($_POST['controllerMethod'])
    {
        case 'create':
                Create();
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
            
            header("refresh:2; url = ../Views/ProductViews/Create.html");
            
            mysqli_close($conn);
    }

?>