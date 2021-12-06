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
            
            header("refresh:2; url = ../Views/CustomerViews/Create.html");
            
            mysqli_close($conn);
    }

?>