<!DOCTYPE html>
<html>
    <head>
        <title>Edit Product</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      </head>
    <body>
      <br>
      <div class="container">
      <h3>Edit Product</h3>
      <form action="<?php echo $_SERVER['PHP_SELF'];?>" method = "post">
                <div class="form-group row" style="margin-right: 0px; margin-left: 0px">
                    <label for="searchParameter" class="col-sm-2 col-form-label">Enter Product Id</label>
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
                            $sql = "Select * from products where Id = '$searchParameter'; ";
                        


                        $result = mysqli_query($conn,$sql);
                        
                        if($result != FALSE){

                            if(mysqli_num_rows($result) > 0)
                            {
                                while($row = mysqli_fetch_assoc($result))
                                {
      echo"<div class=\"container\">";
      echo"<form action=\"../../Controllers/ProductController.php\" method=\"post\">";
      echo"<div class=\"form-group\">";
      echo"<label for=\"name\">Product Name</label>";
      echo" <input type=\"text\" name=\"name\" class=\"form-control\" id=\"nameId\" value=".$row["Name"].">";
      echo" </div>";
      echo"<div class=\"form-group\">";
      echo"<label for=\"price\">Product Price</label>";
      echo"<div class=\"input-group-prepend\">";
      echo"<span class=\"input-group-text\">$</span>";
      echo"<input type=\"text\" name=\"price\" class=\"form-control\" id=\"priceId\" value=".$row["Price"].">";
      echo"</div>";
      echo"</div>";
      echo"<div class=\"form-group\">";
      echo"<label for=\quantity\">Quantity</label>";
      echo"<input type=\"number\" name=\"quantity\" class=\"form-control\" id=\"quantityId\" value=".$row["Quantity"].">";
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