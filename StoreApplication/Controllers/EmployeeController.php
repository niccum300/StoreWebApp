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
        $jobTitle  = $_POST['jobTitle'];
        $storeId   = $_POST['selectStore'];
         
    
        $sql = "CALL add_store_employee('$firstName', '$lastName', '$jobTitle', $storeId)";
    
        if (mysqli_query($conn, $sql)) {
                    echo "New record created successfully";
            } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            
            header("refresh:0; url = ../Views/EmployeeViews/Index.php");
            
            mysqli_close($conn);
    }

    function Update()
    {
        include('../config.php');
        $Id       = $_POST['Id'];
        $firstName = $_POST['firstName'];
        $lastName  = $_POST['lastName'];
        $jobTitle  = $_POST['jobTitle']; 
    
        $sql = "update employees
                set FirstName = '$firstName', LastName = '$lastName', JobTitle = '$jobTitle'
                where id = $Id"; 
    
        if (mysqli_query($conn, $sql)) {
                    echo "Record Updated!";
            } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            
            header("refresh:0; url = ../Views/EmployeeViews/index.php");
            
            mysqli_close($conn);
    }

?>