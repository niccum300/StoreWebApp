<!DOCTYPE html>
<html>
    <head>
        <title>Create Product</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      </head>
    <body>
        <div class="container">
            <br>
            <h3>View Products</h3>
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method = "post">
                <div class="form-group row" style="margin-right: 0px; margin-left: 0px">
                    <label for="searchParameter" class="col-sm-2 col-form-label">Find</label>
                    <div class="col-sm-4">
                        <input type="text" id="searchParameter" class="form-control" name = "searchParameter">
                    </div>
                
                    <div class="col-sm-2">
                    <button type="submit" class="btn btn-primary">Search Database</button>
                    </div>
                </div>
            </form>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Price $</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                    <tr>
                        <?php
                         ?>
                    </tr>
                </thead>
            </table>
        </div> 
    </body>
</html>