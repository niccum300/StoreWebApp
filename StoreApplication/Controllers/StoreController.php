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
        $storeName = $_POST['storeName'];
        $address   = $_POST['address'];
    
        $sql = "INSERT INTO stores(Name, Address)
        VALUES ('$storeName', '$address')";
    
        if (mysqli_query($conn, $sql)) {
                    echo "New record created successfully";
            } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            
            header("refresh:0; url = ../Views/StoreViews/index.php");
            
            mysqli_close($conn);
    }

    function Update()
    {
        include('../config.php');
        $Id       = $_POST['Id'];
        $name       = $_POST['name'];
        $address      = $_POST['address'];
    
        $sql = "update stores 
                set name = '$name', address = '$address'
                where id = $Id"; 
    
        if (mysqli_query($conn, $sql)) {
                    echo "Record Updated!";
            } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            
            header("refresh:0; url = ../Views/StoreViews/index.php");
            
            mysqli_close($conn);
    }

?>