<?php
    include_once 'common.php';
    include_once 'classes/Session.php';
    Session::start();
    include_once 'classes/Professors.php';
    $professor = new Professors();
    if(isset($_SESSION['id']) && (Session::get('role') == "Professor" || Session::get('role') == "Admin") ){
        if(Session::get('role') == "Professor"){
            $professor->setId(Session::get('id'));
            $result = $professor->getProfessor();
        }else{
             $professor->setId($_GET['id']);
            $result = $professor->getProfessor();
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
                            <a href="editbyprofessor.php" class="btn btn-primary btn-sm"><span class="fa fa-plus"></span> Edit Profile</a>
                            <img class="img-circle" src="<?php echo $imgurl; ?>" >
                            <h4 class="text-center">
                                <?php echo $row['fname']." ".$row['lname']; ?>
                            </h4>
                            <div class="border"></div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-12">
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
                                <label>Department</label>
                                <input type="text" class="form-control"  readonly value="<?php echo $row['department']." Deparment"; ?>" >
                            </div>
                            <div class="form-group">
                                <label>Designation</label>
                                <input type="text" class="form-control" value="<?php echo $row['designation']; ?>" readonly="">
                            </div>
                            <div class="form-group">
                                <label>Specification</label>
                                <input type="text"  class="form-control" readonly="" value="<?php echo $row['specification']; ?>" >
                            </div>
                    </div>
                     <?php } ?>
                    <div class="col-md-6 col-xs-12"></div>
                </div><!-- /.row -->
            </div>
        </section>
<?php include "footer.php"; ?>