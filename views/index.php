<!DOCTYPE html>
<html lang="en">
<head>
  <title>SB MEDIA GROUP</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<!-- A grey horizontal navbar that becomes vertical on small screens -->
<nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <!-- Brand -->
  <a class="navbar-brand" href="#">SB MEDIA GROUP</a>
</nav>


  
<div class="container mt-5">
    
    <?php 

         //$all_users = $all_user->getUser(1);
        $all_users = $all_user->allUsers();
     
        if(is_array($all_users)) { ?>
           
        <a href="?export=1" class="btn btn-info btn-md float-right mb-2" >CSV Export users </a>    
        <table class="table table-striped mt-2">
        <thead>
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>City</th>
          </tr>
        </thead>
        <tbody>
            <?php foreach ($all_users as $row): ?>
              <tr>
                <td><?= $row->name ?></td>
                <td><?= $row->email ?></td>
                <td><?= $row->phone ?></td>
                <td><?= $row->address ?></td>
              </tr>
            <?php endforeach; ?> 
        </tbody>
      </table>

  <?php } else {
    echo "Oops Something went wrong!";
  } ?>

</div>

</body>
</html>
