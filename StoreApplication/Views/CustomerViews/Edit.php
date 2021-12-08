<!DOCTYPE html>
<html>
    <head>
        <title>Edit Customer</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      </head>
    <body>
    <nav class="navbar navbar-dark bg-primary">
        <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="../index.html">Store Database</a>
        </div>
        <ul class="nav">
            <li class="nav-item"><a class="nav-link" href="../StoreViews/Index.php" style="color:#fff">Stores</a></li>
            
            <li class="nav-item"><a class="nav-link" href="../ProductViews/Index.php" style="color:#fff">Products</a></li>

            <li class="nav-item"><a class="nav-link" href="../OrderViews/Index.php" style="color:#fff">Orders</a></li>

            <li class="nav-item"><a class="nav-link" href="../EmployeeViews/Index.php" style="color:#fff">Employees</a></li>

            <li class="nav-item"><a class="nav-link" href="Index.php" style="color:#fff">Customers</a></li>

        </ul>
        </div>
    </nav>
      <br>
      <div class="container">
      <h3>Edit Customer</h3>
      <form action="<?php echo $_SERVER['PHP_SELF'];?>" method = "post">
                <div class="form-group row" style="margin-right: 0px; margin-left: 0px">
                    <label for="searchParameter" class="col-sm-2 col-form-label">Enter Customer Id</label>
                    <div class="col-sm-4">
                        <input type="text" id="searchParameter" class="form-control" name = "searchParameter">
                    </div>
                
                    <div class="col-md">
                    <button type="submit" class="btn btn-primary" name="submit">Search Database</button>
                    </div> 
                </div>
            </form>
      </div>
      <?php
                        include('../../config.php');
                        
                        $sql = "";
                        $searchParameter = "";

                        if(isset($_POST['submit']))
                        {
                            $searchParameter = $_POST['searchParameter'];
                            $sql = "Select * from customers where Id = '$searchParameter'; ";
                        

                        $result = mysqli_query($conn,$sql);
                        
                        if($result != FALSE){

                            if(mysqli_num_rows($result) > 0)
                            {
                                while($row = mysqli_fetch_assoc($result))
                                {
      echo"<div class=\"container\">";
      echo"<form action=\"../../Controllers/CustomerController.php\" method=\"post\">";
      echo"<div class=\"form-group\">";
      echo"<label for=\"name\">First Name</label>";
      echo" <input type=\"text\" name=\"firstName\" class=\"form-control\" id=\"nameId\" value=".$row["FirstName"].">";
      echo" </div>";
      echo"<div class=\"form-group\">";
      echo"<label for=\"price\">Last Name</label>";
      echo"<input type=\"text\" name=\"lastName\" class=\"form-control\" id=\"priceId\" value=".$row["LastName"].">";
      echo"</div>";
      echo"<div class=\"form-group\">";
      echo"<label for=\address\">Address</label>";
      echo"<input type=\"text\" name=\"address\" class=\"form-control\" id=\"quantityId\" value=".$row["Address"].">";
      echo"</div>";
      echo"<div class=\"form-group\">";
      echo"<input type=\"hidden\" name=\"Id\" class=\"form-control\" value=".$row["Id"].">";
      echo"<input type=\"hidden\" name=\"controllerMethod\" class=\"form-control\" id=\"controller\" value=\"update\">";
      echo"</div>";
      echo" <button type=\"submit\" class=\"btn btn-primary\">Submit</button>";
      echo"</form>";
      echo"</div>"; 
                                }
                              }
                            }
                          }
      ?>
    </body>
</html>