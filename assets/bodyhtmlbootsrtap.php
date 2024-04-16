


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title><?php echo "$title" ?></title>
</head>
<body>


<!-- nav for all page -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a href="../view/corse.php" class="navbar-brand">Course</a>
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav">
                
            
                <a href="../view/corse.php" class="nav-item nav-link active">All course</a>
            </div>
            <div class="navbar-nav ms-auto">

     
   


               

          






                <?php 
                
if (!isset($_SESSION['user_id'])) {
    echo '<a href="login.php" class="nav-item nav-link">Login</a>';
} else {
    echo '<li class="nav-item dropdown">';
    echo '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">';
    echo 'My Profile';
  
    echo '</a>';
    echo '<ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
    if(isset($username)){echo   "<li class='text-center'><i class='fa-solid fa-user'></i>  <a href='../view/profile.php'>$username</a></li>" ; } ;
 
    if($_SESSION['role'] == 'teacher'){
        echo '<li><a class="dropdown-item" href="../view/mycourse.php">My Course</a></li>';
        echo '<li><a class="dropdown-item" href="../view/UploadCourse.php">Upload Course</a></li>';
    };
    echo '<li><a class="dropdown-item" href="#">Another action</a></li>';
 
    echo '</ul>';
    echo '</li>';
    echo '<a href="../control/logout.php" class="nav-item nav-link">Logout</a>';
}
?>










            </div>
        </div>
    </div>
</nav>









<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js" integrity="sha512-GWzVrcGlo0TxTRvz9ttioyYJ+Wwk9Ck0G81D+eO63BaqHaJ3YZX9wuqjwgfcV/MrB2PhaVX9DkYVhbFpStnqpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html> 