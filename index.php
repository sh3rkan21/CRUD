<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap 4 Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<?php require_once 'process.php'; ?> 

<?php 
    if(isset($_SESSION['message'])){
?> 

        <div class="alert alert-<?php echo $_SESSION['msg_type']?>">

<?php } ?>
    



    <?php
        if(isset($_SESSION['message'])){

            echo $_SESSION['message'];
            unset ($_SESSION['message']);
        }
    ?>
</div>

    

<div class="container">

<?php 
      $conn = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($conn));
      $result = $conn->query("SELECT * FROM data") or die($conn->error);
      ?>

    <div class="row justify-content-center">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Location</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>

            <?php 
                while($row = $result->fetch_assoc()):
            ?>
            <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['location']; ?></td>
                <td>
                    <a href="index.php?edit=<?php echo $row['id'];?> "
                    class = 'btn btn-info'>Edit</a>
                    <a href="process.php?delete=<?php echo $row['id'];?>"
                    class= 'btn btn-danger'>Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
        
    </div>
      
<div class="row justify-content-center"> 
    <form action="process.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $id?>">
    <div class="form-group">
        <label>Name</label>
        <input type = 'text' name="name" class="form-control" placeholder = 'Enter your name' 
        value = "<?php echo $name; ?>">
        </div>
        <div class="form-group">
        <label>Location</label>
        <input type = 'text' name="location" class="form-control" placeholder = 'Enter your location' 
        value = "<?php echo $location; ?>">
        </div>
        <div class="form-group">
        <?php if($update == true) { ?> 
        <button type = 'submit' name="update" class="btn btn-info">Update</button>
        <?php } else {?>
        <button type = 'submit' name="save" class="btn btn-primary">Save</button>
        <?php } ?>
        
        </div>
    </form>
    </div>
</div>
</body>
</html>