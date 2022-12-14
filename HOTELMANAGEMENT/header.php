<?php 

  require('admin/extra/connect.php');
  require('admin/extra/func.php');

  $settings_q = "SELECT * FROM `settings` WHERE `S_ID`=?";
  $values = [1];
  $settings_r = mysqli_fetch_assoc(select($settings_q,$values,'i'));


?>





<nav class="navbar navbar-expand-lg navbar-dark bg-secondary px-2 py-3 shadow-lg sticky-top border-bottom border-3 border-outline">
  <div class="container-fluid">
     <a class="navbar-brand me-4 fw-bolder fs-1 font-three " href="index.php"><?php echo $settings_r['site_title'] ?></a>     <!-- return to index.php whenever click on hotel name -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link active me-2" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active me-2" aria-current="page" href="room.php">Rooms Book</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active me-2" aria-current="page" href="facilities.php">Facilities</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active me-2" aria-current="page" href="contact.php">Contact Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active me-2" aria-current="page" href="about.php">About</a>
        </li>
      </ul>

      <div class="d-flex">
        <?php
          session_start();

          if(isset($_SESSION['login']) && $_SESSION['login']==true){

            echo<<<data
              <div class="btn-group">
                <button type="button" class="btn btn-light shadow-none dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                 $_SESSION[uName]
                </button>
                <ul class="dropdown-menu dropdown-menu-lg-end">
                  <li><a class="dropdown-item" href="logout.php">Log Out</a></li>
                </ul>
              </div>
            data;
          }

          else{
            echo<<<data
              <button type="button" class="btn btn-light shadow-none" style="border-color:black; border-width: 2px; margin-right: 5px; padding-top: 8px;" data-bs-toggle="modal" data-bs-target="#loginmodal">
                LOGIN
              </button>
              <button type="button" class="btn btn-light shadow-none" style="border-color:black; border-width: 2px; margin-right: 2px; padding-top: 8px;" data-bs-toggle="modal" data-bs-target="#signupmodal">
                SIGN UP
              </button>
            data;
          }
         
          

        ?>


        
        
      </div>
    </div>
  </div>
</nav>

<div class="modal fade" id="loginmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">

        <form id="login-form">
            <div class="modal-header">
                <h5 class="modal-title align-items-center d-flex">
                    <i class="bi bi-person-check fs-3 me-2"></i> USER LOGIN
                </h5>
                <button type="reset" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Email / Phone<br> </label>
                    <input type="text" name="email_phone" required class="form-control shadow-none">
                </div>
                <div class="mb-3">
                    <label class="form-label">Password <br> </label>
                    <input type="password" name="pass" required class="form-control shadow-none">
                  </div>
                  <br> 
                <div class="align-items-center d-flex justify-content-between ">
                    <button type="submit" class="btn btn-dark">LOGIN</button>
                    <a href="javascript: void(0)" class="text-secondary">Forgot Password?</a>
                </div>
              </div>  
        </form>
      </div>
    </div>
</div>

  <div class="modal fade" id="signupmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <form id="signup-form">
            <div class="modal-header">
                <h5 class="modal-title align-items-center d-flex">
                    <i class="bi bi-person-fill-add fs-3 me-2 "></i></i> USER SIGN UP
                </h5>
                <button type="reset" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 ps-0 mb-3">
                            <label class="form-label">Name</label>
                            <input name="name" type="text" class="form-control shadow-none" required>
                        </div>
                    <div class="col-md-6 ps-0 mb-3">
                        <label class="form-label">Email</label>
                        <input name="email" type="email" class="form-control shadow-none" required>
                    </div>
                    <div class="col-md-6 ps-0 mb-3">
                        <label class="form-label">Phone Number</label>
                        <input name="phonenum" type="number" class="form-control shadow-none" required>
                    </div>
                    <div class="col-md-6 ps-0 mb-3 ">
                        <label class="form-label">Date Of Birth</label>
                        <input name="dob" type="date" class="form-control shadow-none" required>
                    </div>
                    <div class="col-md-12 ps-0 mb-3"> 
                        <label class="form-label">Address</label>
                        <textarea name="address" class="form-control shadow-none" rows="3" required></textarea>
                    </div>                  
                    <div class="col-md-6 ps-0 mb-3">
                        <label class="form-label">Password</label>
                        <input name="pass" type="password" class="form-control shadow-none" required>
                    </div>
                    <div class="col-md-6 p-0 mb-3">
                        <label class="form-label">Confirm Password</label>
                        <input name="cpass" type="password" class="form-control shadow-none" required>
                    </div>
                    </div>

                    <div class="text-center my-3">
                        <button type="submit" class="btn btn-dark">SIGN UP</button>

                    </div>
                </div>
              </div>
              
        </form>


        
      </div>
    </div>
  </div>