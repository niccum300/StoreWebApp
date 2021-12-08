<!DOCTYPE html>
<html>
    <head>
        <title>Stores</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>  
    </head>
    <style>
        .fade.in{
            opacity: 1;
        }
        .modal.in .modal-dialog{
            -webkit-transform: translate(0,0);
            -o-transform: translate(0,0);
            transform: translate(0,0);
        }
        .modal-backdrop .fade .in {
            opacity: 0.5 !important;
        }
        .modal-backdrop.fade{
            opacity: 0.5 !important;
        }
    </style>
    <body>
    <nav class="navbar navbar-dark bg-primary">
        <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="../index.html">Store Database</a>
        </div>
        <ul class="nav">
            <li class="nav-item"><a class="nav-link" href="StoreViews/Index.php" style="color:#fff">Stores</a></li>
            
            <li class="nav-item"><a class="nav-link" href="../ProductViews/Index.php" style="color:#fff">Products</a></li>

            <li class="nav-item"><a class="nav-link" href="../OrderViews/Index.php" style="color:#fff">Orders</a></li>

            <li class="nav-item"><a class="nav-link" href="../EmployeeViews/Index.php" style="color:#fff">Employees</a></li>

            <li class="nav-item"><a class="nav-link" href="../CustomerViews/Index.php" style="color:#fff">Customers</a></li>

        </ul>
        </div>
    </nav>
        <div class="container">
            <br>
            <h3>View Stores</h3>
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method = "post">
                <div class="form-group row" style="margin-right: 0px; margin-left: 0px">
                    <label for="searchParameter" class="col-sm-2 col-form-label">Find</label>
                    <div class="col-sm-4">
                        <input type="text" id="searchParameter" class="form-control" name = "searchParameter">
                    </div>
                
                    <div class="col-md">
                    <button type="submit" class="btn btn-primary" name="submit">Search Database</button>
                    <button type="button" class="btn btn-success" name="create" data-toggle="modal" data-target="#createModal">Create</button>
                    <a href="Edit.php"><button type="button" class="btn btn-success" name="create">Edit</button></a>
                    </div> 
                </div>
            </form>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Address</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include('../../config.php');
                        
                        $sql = "";
                        $searchParameter = "";

                        if(isset($_POST['submit']))
                        {
                            $searchParameter = $_POST['searchParameter'];
                        }
                        
                        if($searchParameter == "")
                        {
                            $sql = "Select * from stores;";
                        }else{
                            $sql = "Select * from stores where name = '$searchParameter' OR Address =  '$searchParameter'; ";
                        }


                        $result = mysqli_query($conn,$sql);
                        
                        if($result != FALSE){

                            if(mysqli_num_rows($result) > 0)
                            {
                                while($row = mysqli_fetch_assoc($result))
                                {
                                    
                                    echo "<tr>";
                                    echo "<td>" .$row["Id"]. "</td>";
                                    echo "<td>" .$row["Name"]. "</td>";
                                    echo "<td>" .$row["Address"]. "</td>";
                                    echo "</tr>";
                                    

                                }
                                
                            }else{
                                echo "No results found";
                            }
                        }
                        else
                        {
                            echo "No results found";
                        }

                        ?>
                </tbody>
            </table>
        </div> 
        <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../../Controllers/StoreController.php" method="post">
            <div class="form-group">
              <label for="storeName">Store Name</label>
              <input type="text" name="storeName" class="form-control" id="storeNameId" placeholder="Enter Store Name">
            </div>
            <div class="form-group">
              <label for="address">Address</label>
              <input type="text" name="address" class="form-control" id="addressId" placeholder="Enter Address">
            </div>
            <div class="form-group">
              <input type="hidden" name="controllerMethod" class="form-control" id="controller" value="create">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
            </div>
            </div>
        </div>
        </div>
    </body>
</html>