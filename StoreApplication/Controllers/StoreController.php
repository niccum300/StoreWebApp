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
        $storeName = $_POST['storeName'];
        $address   = $_POST['address'];
    
        $sql = "INSERT INTO stores(Name, Address)
        VALUES ('$storeName', '$address')";
    
        if (mysqli_query($conn, $sql)) {
                    echo "New record created successfully";
            } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            
            header("refresh:2; url = ../Views/StoreViews/Create.html");
            
            mysqli_close($conn);
    }

?>