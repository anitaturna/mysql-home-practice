<?php
$database=mysqli_connect("localhost","root","","bb_purpose");
if(isset($_POST['submit'])){
    $name=$_POST['name'];
    $address=$_POST['address'];
    $database->query("call manus_data ('$name','$address')");
}

if(isset($_POST['add_submit'])){
    $name=$_POST['name'];
    $price=$_POST['price'];
    $manufacture_id=$_POST['manufact'];
    $database->query("call product_data('$name','$price','$manufacture_id')");

}
?>
<?php
if(isset($_POST['Delete_product'])){
    $delete = $_POST['manufact'];
    $database->query("DELETE FROM manufacture WHERE id = '$delete'");
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>two procedure</title>
</head>
<body>
    <form action="" method="post">
        <fieldset>
           <h1> Manufacture table </h1>
            name: <br>
            <input type="text" name="name"> <br> <br>
            address: <br>
            <input type="text" name="address"> <br> <br>
            <input type="submit" name="submit" value="submit">
        </fieldset>
    </form>
    <br> <br>
    <form action="" method="post">
        <fieldset>
          <h1> Product Table </h1>
            name: <br>
            <input type="text" name="name"> <br> <br>
            price: <br>
            <input type="text" name="price"> <br> <br>
            Manufacture_id: <br>
            <select name="manufact" id="">
                <?php
                $manufac=$database->query("select * from manufacture");
                while(list($id,$name)=$manufac->fetch_row()){
                    echo "<option value='$id'>$name</option>";
                }
                ?>
            </select>
            <input type="submit" name="add_submit" value="add_submit">
        </fieldset>
    </form>
      
    <table border="2">
         <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
            </tr>
         </thead>
         <tbody>
            <?php
            $manufac=$database->query("SELECT * FROM manufacture_view");
            while(list($name,$price)= $manufac->fetch_row()){
             ?>
              <tr>
                <td><?php echo $name; ?></td>
                <td><?php echo $price; ?></td>
              </tr> 
              <?php  
            }
            ?>
         </tbody>
    </table>
    <form action="" method="post">
        <fieldset>
        Manufacture_id: <br>
            <select name="manufact" id="">
                <?php
                $manufac=$database->query("select * from manufacture");
                while(list($id,$name)=$manufac->fetch_row()){
                    echo "<option value='$id'>$name</option>";
                }
                ?>
            </select>
            <input type="submit" name="Delete_product" value="Delete">
            </fieldset>
    </form>
</body>
</html>