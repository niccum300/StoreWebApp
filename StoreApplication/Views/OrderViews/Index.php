<!DOCTYPE html>
<html>
    <head>
        <title>Products</title>
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
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="../index.html">Store Database</a>
        </div>
        <ul class="nav">
            <li class="nav-item"><a class="nav-link" href="../StoreViews/Index.php" style="color:#fff">Stores</a></li>
            
            <li class="nav-item"><a class="nav-link" href="../ProductViews/Index.php" style="color:#fff">Products</a></li>

            <li class="nav-item"><a class="nav-link" href="Index.php" style="color:#fff">Orders</a></li>

            <li class="nav-item"><a class="nav-link" href="../EmployeeViews/Index.php" style="color:#fff">Employees</a></li>

            <li class="nav-item"><a class="nav-link" href="../CustomerViews/Index.php" style="color:#fff">Customers</a></li>

        </ul>
        </div>
    </nav>
        <div class="container">
            <br>
            <h3>View Orders</h3>
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method = "post">
                <div class="form-group row" style="margin-right: 0px; margin-left: 0px">
                    <label for="searchParameter" class="col-sm-2 col-form-label">Find</label>
                    <div class="col-sm-4">
                        <input type="text" id="searchParameter" class="form-control" name = "searchParameter">
                    </div>
                
                    <div class="col-md">
                    <button type="submit" class="btn btn-primary" name="submit">Search Database</button>
                    <button type="button" class="btn btn-success" name="create" data-toggle="modal" data-target="#createModal">Create</button>
                    </div> 
                </div>
            </form>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Order Date</th>
                        <th scope="col">Total Cost $</th>
                        <th scope="col">Customer Name</th>
                        <th scope="col">Emmployee Name </th>
                        <th scope="col">Product Name</th>
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
                            $sql = "select DISTINCT orders.Id, orders.OrderDate, orders.Amount, customers.FirstName, customers.LastName, employees.FirstName AS EmpFirstName, employees.LastName As EmpLastName, products.Name
                            from orders inner join customer_order ON orders.Id = customer_order.OrderId
                            inner join customers on customers.Id = customer_order.CustomerId
                            inner join employee_order ON orders.Id = employee_order.OrderId
                            INNER JOIN employees ON employee_order.EmployeeId = employees.Id
                            INNER join order_product on order_product.OrderId = orders.Id
                            inner JOIN products on order_product.ProductId = products.Id;";
                        }else{
                            $sql = "select DISTINCT orders.Id, orders.OrderDate, orders.Amount, customers.FirstName, customers.LastName, employees.FirstName AS EmpFirstName, employees.LastName As EmpLastName, products.Name
                            from orders inner join customer_order ON orders.Id = customer_order.OrderId
                            inner join customers on customers.Id = customer_order.CustomerId
                            inner join employee_order ON orders.Id = employee_order.OrderId
                            INNER JOIN employees ON employee_order.EmployeeId = employees.Id
                            INNER join order_product on order_product.OrderId = orders.Id
                            inner JOIN products on order_product.ProductId = products.Id
                            where orders.Id = $searchParameter OR orders.OrderDate = '$searchParameter' OR orders.Amount =$searchParameter 
                            or customers.FirstName = '$searchParameter' or customers.LastName = '$searchParameter' ";
                        }


                        $result = mysqli_query($conn,$sql);
                        
                        if($result != FALSE){

                            if(mysqli_num_rows($result) > 0)
                            {
                                while($row = mysqli_fetch_assoc($result))
                                {
                                    
                                    echo "<tr>";
                                    echo "<td>" .$row["Id"]. "</td>";
                                    echo "<td>" .$row["OrderDate"]. "</td>";
                                    echo "<td>$" .$row["Amount"]. "</td>";
                                    echo "<td>" .$row["FirstName"]. " ".$row["LastName"]. "</td>";
                                    echo "<td>" .$row["EmpFirstName"]. " ".$row["EmpLastName"]. "</td>";
                                    echo "<td>" .$row["Name"]. "</td>";
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
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="../../Controllers/OrderController.php" method="post">
            <div class="form-group">
              <label for="orderDate">Order Date</label>
              <input type="date" name="orderDate" class="form-control" id="orderDateId">
            </div>
            <div class="form-group">
            <label for="orderDate">Store Name</label>
            <select name="selectStore" class="custom-select" id="inputGroupSelect02">
            <?php
                        include('../../config.php');
                        
                        $sql = "Select * from stores";

                        echo "$sql";
                        $result = mysqli_query($conn,$sql);

                        

                            if(mysqli_num_rows($result) > 0)
                            {
                                while($row = mysqli_fetch_assoc($result))
                                {

                                    echo "<option value='". $row["Id"] ."'>" .$row["Name"]. "</option>";
                                }
                                
                            }else{
                                echo "No results found";
                            }
                        ?>
            </select>
                        </div>
            <div class="form-group">
            <label for="orderDate">Customer</label>
            <select name="selectCustomer" class="custom-select" id="inputGroupSelect02">
            <?php
                        include('../../config.php');
                        
                        $sql = "Select * from customers";

                        echo "$sql";
                        $result = mysqli_query($conn,$sql);

                        

                            if(mysqli_num_rows($result) > 0)
                            {
                                while($row = mysqli_fetch_assoc($result))
                                {

                                    echo "<option value='". $row["Id"] ."'>" .$row["FirstName"]. " " .$row["LastName"]."</option>";
                                }
                                
                            }else{
                                echo "No results found";
                            }
                        ?>
            </select>
                        </div>
                        <div class="form-group">
            <label for="orderDate">Employee</label>
            <select name="selectEmployee" class="custom-select" id="inputGroupSelect02">
            <?php
                        include('../../config.php');
                        
                        $sql = "Select * from employees";

                        echo "$sql";
                        $result = mysqli_query($conn,$sql);

                        

                            if(mysqli_num_rows($result) > 0)
                            {
                                while($row = mysqli_fetch_assoc($result))
                                {

                                    echo "<option value='". $row["Id"] ."'>" .$row["FirstName"]. " " .$row["LastName"]."</option>";
                                }
                                
                            }else{
                                echo "No results found";
                            }
                        ?>
            </select>
                        </div>
                        <div class="form-group">
            <label for="orderDate">Products</label>
            <select name="products[]" class="custom-select" id="inputGroupSelect02" multiple>
            <?php
                        include('../../config.php');
                        
                        $sql = "Select * from products where Quantity > 0;";

                        echo "$sql";
                        $result = mysqli_query($conn,$sql);

                        

                            if(mysqli_num_rows($result) > 0)
                            {
                                while($row = mysqli_fetch_assoc($result))
                                {

                                    echo "<option value='". $row["Id"] ."'>" .$row["Name"]. " $" .$row["Price"]."</option>";
                                }
                                
                            }else{
                                echo "No results found";
                            }
                        ?>
            </select>
                        </div>
            
            </div>
            <div class="form-group">
              <label for="amount">Order Total</label>
              <div class="input-group-prepend">
                <span class="input-group-text">$</span>
              <input type="text" name="amount" class="form-control" id="amountId" placeholder="0.00">
            </div>
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