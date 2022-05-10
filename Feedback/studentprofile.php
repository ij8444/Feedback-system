<?php
    include_once 'common.php';
    include_once 'classes/Session.php';
    Session::start();
    if(!isset($_SESSION['id'])){
        exit();
    }
    include_once 'classes/Students.php';
    $student = new Students();
    if(isset($_SESSION['id']) && (Session::get('role') == "Student" || Session::get('role') == "Admin") ){
        if(Session::get('role') == "Student"){
            $student->setId(Session::get('id'));
            $result = $student->getStudent();
        }else{
             $student->setId($_GET['id']);
            $result = $student->getStudent();
        }
    }else{
        exit();
    }
   $profile = "active";
include  "header.php" ?>
<link rel="stylesheet" href="css/header.css" >
<!-- Start Feature Section -->
        <section id="feature" class="feature-section first-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <?php if($result->num_rows > 0){
                             $row = $result->fetch_assoc();
                             if($row['imgurl'] != ""){
                                 $imgurl = "profile/".$row['imgurl'];
                             }else{
                                $imgurl = "profile/profile.png";
                             }
                            ?>
                        <div class="welcome-section">
                            <a href="editbystudent.php" class="btn btn-primary btn-sm"><span class="fa fa-plus"></span> Edit Profile</a>
                            <img class="img-circle" src="<?php echo $imgurl; ?>" >
                            <h4 class="text-center">
                                <?php echo $row['fname']." ".$row['lname']; ?>
                            </h4>
                            <div class="border"></div>
                             <h4 class="text-center">
                                 Batch <br/><br/>
                                    <?php echo $row['start_year']; ?> -
                                    <?php echo $row['end_year'];?>
                             </h4>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-12">
                         <div class="form-group">
                            <label>Roll Number</label>
                            <input type="text"  class="form-control" readonly="" value="<?php echo $row['roll_no']; ?>" >
                        </div>
                        <div class="form-group">
                            <label>Mobile Number</label>
                            <input type="text" readonly="" class="form-control" value="<?php echo $row['mobile'] ?>" >
                        </div>
                        <div class="form-group">
                            <label>Date Of Birth</label>
                            <input type="text" readonly="" class="form-control"  value="<?php echo date('d-m-Y' ,strtotime($row['dob'])); ?>" >
                        </div> 
                        <div class="form-group">
                            <label>Gender</label>
                            <input type="text" class="form-control"  readonly="" value="<?php echo $row['gender']; ?>" >
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <textarea class="form-control" readonly=""><?php echo $row['address'] ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Branch</label>
                            <input type="text" class="form-control"  readonly value="<?php echo $row['branch']; ?>" >
                        </div>
                        <div class="form-group">
                            <label>Semester</label>
                            <input type="text" class="form-control" value="<?php echo $row['semester']; ?>" readonly="">
                        </div>
                    </div>
                     <?php } ?>
                    <div class="col-md-6 col-xs-12"></div>
                </div><!-- /.row -->
            </div>
        </section>
<?php include "footer.php"; ?>