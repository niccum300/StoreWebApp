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
        $firstName = $_POST['firstName'];
        $lastName  = $_POST['lastName'];
        $address   = $_POST['address']; 
    
        $sql = "INSERT INTO customers(FirstName, LastName, Address)
        VALUES ('$firstName', '$lastName', '$address')";
    
        if (mysqli_query($conn, $sql)) {
                    echo "New record created successfully";
            } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            
            header("refresh:0; url = ../Views/CustomerViews/Index.php");
            
            mysqli_close($conn);
    }

    function Update()
    {
        include('../config.php');
        $Id       = $_POST['Id'];
        $firstName = $_POST['firstName'];
        $lastName  = $_POST['lastName'];
        $address  = $_POST['address']; 
    
        $sql = "update customers
                set FirstName = '$firstName', LastName = '$lastName', Address = '$address'
                where id = $Id"; 
    
        if (mysqli_query($conn, $sql)) {
                    echo "Record Updated!";
            } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            
            header("refresh:0; url = ../Views/CustomerViews/index.php");
            
            mysqli_close($conn);
    }

?>