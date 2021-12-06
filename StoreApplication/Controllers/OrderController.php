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
        $orderDate = $_POST['orderDate'];
        $amount    = $_POST['amount'];
        
        $sql = "INSERT INTO orders(OrderDate, Amount)
        VALUES ('$orderDate', '$amount')";
    
        if (mysqli_query($conn, $sql)) {
                    echo "New record created successfully";
            } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            
            header("refresh:2; url = ../Views/OrderViews/Create.html");
            
            mysqli_close($conn);
    }

?>