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
        $jobTitle  = $_POST['jobTitle']; 
    
        $sql = "INSERT INTO employees(FirstName, LastName, JobTitle)
        VALUES ('$firstName', '$lastName', '$jobTitle')";
    
        if (mysqli_query($conn, $sql)) {
                    echo "New record created successfully";
            } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            
            header("refresh:2; url = ../Views/EmployeeViews/Create.html");
            
            mysqli_close($conn);
    }

?>