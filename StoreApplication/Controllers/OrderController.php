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
        $orderDate = $_POST['orderDate'];
        $amount    = $_POST['amount'];
        $customerId = $_POST['selectCustomer'];
        $employeeId = $_POST['selectEmployee'];

        $sql ="Insert INTO orders(OrderDate, Amount)
        values('$orderDate', $amount);";

        if (mysqli_query($conn, $sql)) {
                echo "New record created successfully";
        } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        
        foreach($_POST['products'] as $pId)
        {
                $sql = "CALL addOrder('$orderDate', $amount, $customerId, $employeeId, $pId);";

                echo "$sql";
    
                if (mysqli_query($conn, $sql)) {
                        echo "New record created successfully";
                } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            
            
        }

        header("refresh:2; url = ../Views/OrderViews/index.php");

        mysqli_close($conn);
        
    }

    function Update()
    {
        include('../config.php');
        $Id       = $_POST['Id'];
        $orderDate = $_POST['orderDate'];
        $amount  = $_POST['amount'];
        $selectCustomer = $_POST['selectCustomer'];
    
        $sql = "update orders
                set OrderDate = '$orderDate', Amount = $amount
                where id = $Id"; 
    
        if (mysqli_query($conn, $sql)) {
                    echo "Record Updated!";
            } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            
            header("refresh:2; url = ../Views/OrderViews/index.php");
            
            mysqli_close($conn);
    }
?>