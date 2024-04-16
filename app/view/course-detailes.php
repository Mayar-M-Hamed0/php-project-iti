<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include("../../assets/bodyhtmlbootsrtap.php");
require_once '../classes/query.php';
include_once("../classes/review.php");
$username = $_SESSION['username'];
$id = $_GET['id'];
$user_id = $_SESSION['user_id'];
// include_once("review.php");

$coursedetailes = new CourseController();
$thecourse = $coursedetailes->getCourseById($id);


$course = $coursedetailes->getinstactor($id);
$review = new Review;


if (isset($_POST['addreview'])) {

    $revieww = $_POST['review'];

    $rate = $_POST['rate'];
    $review->addreview($user_id, $id, $rate, $revieww);
    
    $revieswresult = $review->showereview($id);
}
$revieswresult = $review->showereview($id);

// if (isset($_POST['updatereview'])) {

//     $reviewsresult = $review->showereview($id);
   

//     $revieww = $_POST['review'];
//     $rate = $_POST['rate'];
//     $reviewsresult = $review->showereview($id);
// }



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../assets/coursedetailes.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>

<body>
    <div class="container">
        <div class="card my-5">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="../../assets/Online-Learning.jpg" class="img-fluid rounded-start" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $thecourse['title'] ?></h5>
                        Instructor: <a href="profile-for-forign.php?id=<?php echo $thecourse['instructor_id']; ?>"><?php print_r($course[0]['instructor_name']); ?></a>
                        <p class="card-text"> <?php echo $thecourse['description'] ?> </p>
                        <p class="card-text"> <?php echo "duration for the course: " . $thecourse['duration'] . " weeks" ?></p>
                        <p class="card-text"> <?php echo "price of the course: " . $thecourse['price'] . "$" ?></p>
                        <p class="card-text"> <?php echo    '<span class="fw-bold">categories </span>' . $thecourse['categories']  ?></p>

                    </div>
                </div>
                <?php if ($_SESSION['role'] == "student") : ?>
                    <button class="btn btn-primary rounded-2 " data-bs-toggle="modal" data-bs-target="#exampleModal">Add Review</button>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="" method="post" enctype="multipart/form-data">

                                    <div class="modal-body">

                                        <p> Add your review</p>
                                        <textarea name="review" id="" cols="30" rows="10"></textarea>
                                        <p>add your Rate from 0-10</p>
                                        <input type="number" min="0" max="10" name="rate">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" name="addreview" class="btn btn-primary" data-bs-dismiss="modal">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="container reviews my-5 p-4 text-center">
        <h3 class="p-4"> students Reviews</h3>
        <div class="swiper">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <!-- Slides -->
                    <?php foreach($revieswresult as $reviewresult):?>
                <div class="swiper-slide">
                    <div class="card" style="width: 18rem;">
                        <img src="../../assets/<?php echo $reviewresult['profile_img'] ?>" class="card-img-top rounded-5" alt="...">
                        <div class="card-body">
                            <p class="card-text"> <?php echo "user name:  " . $reviewresult['username'] ?></p>
                            <p class="card-text"> <?php echo "usercomment:  " . $reviewresult['comment'] ?></p>
                            <p class="card-text"> <?php echo "user rating:  " . $reviewresult['rating'] . "  from 10" ?></p>
                           
                            <?php if($user_id == $reviewresult['user_id']):?>
                            <button data-bs-toggle="modal" data-bs-target="#edit" name="updatereview" class="btn btn-success py-2 px-3 ms-1"><a href="review.php?rid=<?php echo $reviewresult['review_id']?>">edit</a> </button>
                            <?php endif;?>
                            <!--                            -->
                        </div>
                    </div>
                </div>
                        <?php endforeach;?>

                ...
            </div>
            <!-- If we need pagination -->
            <div class="swiper-pagination"></div>

            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>


        </div>
       

       
        <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="editlLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" method="post" enctype="multipart/form-data">

                        <div class="modal-body">

                            <p> Add your review</p>
                            <textarea name="review" id="" cols="30" rows="10"><?php echo $revieww ?></textarea>
                            <p>add your Rate from 0-10</p>
                            <input type="number" min="0" max="10" value="<?php echo $rate ?>" name="rate">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="updatereview" class="btn btn-primary" data-bs-dismiss="modal">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        const swiper = new Swiper('.swiper', {
            // Optional parameters
            loop: true,
            spaceBetween: 20,
            // If we need pagination
            pagination: {
                el: '.swiper-pagination',
            },

            // Navigation arrows
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },

            // And if we need scrollbar
            scrollbar: {
                el: '.swiper-scrollbar',
            },
            slidesPerView: 1,
            spaceBetween: 10,
            // Responsive breakpoints
            breakpoints: {
                // when window width is >= 320px
                0: {
                    slidesPerView: 1,

                },
                768: {
                    slidesPerView: 2,

                },
                1020: {
                    slidesPerView: 3,

                },
            }
        });
    </script>

</body>

</html>