<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include_once("../../assets/bodyhtmlbootsrtap.php");
include_once("../classes/profile-info.php");
include_once("../control/profile-info-contr.php");
$profile=new ProfileInfo();
$id= $_SESSION['user_id'];


$username=$_SESSION['username'];
$profileinf=$profile->getProfileInfo($id);

$info=$profileinf['profile_about'];
$about=$profileinf['profile_introtext'];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $info=$_POST['profile_about'];
        $about=$_POST['profile_introtext'];
        $image_name=$_FILES["profile_img"];
    if(!empty($_FILES["profile_img"]["tmp_name"])){
        $image_temp_path=$_FILES["profile_img"]["tmp_name"];
            $image_name=time().$_FILES["profile_img"]["name"];
            $image_destinatin="../../assets/".$image_name;
            move_uploaded_file($image_temp_path,$image_destinatin);
            $updatprofile=new ProfileInfoContr();
            $updatprofile->getinfo($id);
            $updatprofile->updateProfile($info,$about,$image_name);
               }else{
                $updatprofile=new ProfileInfoContr();
                $updatprofile->getinfo($id);
                $updatprofile->updateProfilenoimg($info,$about);
               }

    header("location:profile.php");
    // print_r($_FILES["profile_img"]);
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../assets/profile-edit.css">
</head>

<body>
    <div class="container d-flex justify-content-center">
        <div>
            <form action="" class="bg-white p-4 mt-4 rounded-2" method="post"  enctype="multipart/form-data">
                <h3> profile settings</h3>
                <b>Info:</b></br>
                <textarea class="rounded-2" name="profile_about" id="" cols="70" rows="10"><?php echo $info ?></textarea><br> <br>
                <b>About:</b></br>
                <textarea class="rounded-2" name="profile_introtext" id="" cols="70" rows="10"><?php echo $about ?></textarea><br> <br>


                <b>edit profile picture:</b></br>
                <input type="file" name="profile_img" id="image" class="btn btn-dark rounded-2 pt-2"> <br> <br>

                <input type="submit" class="btn btn-dark px-5 py-2 fs-5 rounded-pill ms-5" name="submit" value="save">

            </form>

        </div>
    </div>
    <script>

    </script>
</body>

</html>