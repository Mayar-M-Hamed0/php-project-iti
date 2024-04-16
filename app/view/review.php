<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include_once("../../assets/bodyhtmlbootsrtap.php");
include_once("../classes/Dbconnect.php");
include_once("../classes/review.php");
// include_once("course-detailes.php");


$review=new Review;
$rid=$_GET['rid'];
$user_id = $_SESSION['user_id'];
$reviewsresult=$review->getsingle($rid);

$revieww=$reviewsresult[0]['comment'];
$rate=$reviewsresult[0]['rating'];
$courseid= $reviewsresult[0]['course_id'];

if (isset($_POST['updatereview'])) {

    $revieww=$_POST['review'];
    $rate=$_POST['rate'];
    $review->updatereview($rate,$revieww, $rid);
    header("location:course-detailes.php?id=$courseid");
}
if (isset($_POST['delete'])){
    $review->delet($rid);
    header("location:course-detailes.php?id=$courseid");

}
?>
<div class="main k">

        <div class="d-flex justify-content-center">
            <form action="" method="post">
                <div class="modal-body">

                    <p> Add your review</p>
                    <textarea name="review" id="" cols="30" rows="10"><?php echo $revieww ?></textarea>
                    <p>add your Rate from 0-10</p>
                    <input type="number" min="0" max="10" value="<?php echo $rate ?>" name="rate">
                    </div>
                    <div class="modal-footer">
                    <?php if($user_id == $reviewsresult[0]['user_id']):?>
                        <button class="btn btn-danger p-2 me-3" name="delete"> delete </button>
                        <button type="submit" name="updatereview" class="btn btn-primary">Save changes</button>
                    <?php endif;?>
                                    
                 </div>
            </form>
        </div>
    </div>