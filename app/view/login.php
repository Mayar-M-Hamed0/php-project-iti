<?php 
$title= 'Login';

include("../../assets/bodyhtmlbootsrtap.php");


?>
    <section class="vh-100" style="background-color: #eee;">
        <div class="container h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
              <div class="card text-black" style="border-radius: 25px;">
                <div class="card-body p-md-5">
                  <div class="row justify-content-center">
                    <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
      
                      <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4 ">Log In</p>
      <!-- ffffffffffffffffffffffffffffffffffffffffffffffff -->
                      <form class="mx-1 mx-md-4"  action="../control/login.php" method="post">
      
      
                        <div class="d-flex flex-row align-items-center mb-4">
                          <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                          <div class="form-outline flex-fill mb-0">
                            <input type="email" id="form3Example3c"  name="email" class="form-control" />
                            <label class="form-label" for="form3Example3c">Your Email</label>
                          </div>
                        </div>
      
                        <div class="d-flex flex-row align-items-center mb-4">
                          <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                          <div class="form-outline flex-fill mb-0">
                            <input type="password" id="form3Example4c" name="password" class="form-control" />
                            <label class="form-label"  for="form3Example4c">Password</label>
                          </div>
                        </div>


      
                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4 mt-4">
                   
                          <button type="submit" class="btn btn-info btn-lg">Login</button>
                          
                        </div>
                        <a href="signup.php" class="text-decoration-none fs-4" >New to Courses ?  <span class="fw-bold">Join now</span>     </a>
                      </form>
      
                    </div>
                    <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
      
                      <img src="../../assets/Illustration_Online-Classes.png"
                        class="img-fluid" alt="Sample image">
      
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>



