<?php 
    include_once 'classes/Session.php';
    Session::start();
    include_once "classes/Students.php";
    include_once 'common.php';
    if(!isset($_SESSION['id']) && Session::get('role') != 'Admin'){
        exit();
    }
    $student = new Students();
    if(isset($_POST['fname'])){
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $start = $_POST['start']; //start date 
        $end = $_POST['end']; //end date
        $student->setRoll_no($_POST['roll_no']);
        $result = $student->searchStudent($fname,$lname,$start,$end);
    }else{
        $result = $student->selectAllStudent();
    }
$studentlist = "active";
include  "header.php";
?>
<link rel="stylesheet" href="css/header.css" >
<!-- Start Feature Section -->
        <section id="feature" class="feature-section first-section">
            <div class="container">
                <div class="row"></div>
                <div class="row" style="margin-top: 10px">
                    <div class="col-md-12">
                        <form method="post">
                            <div class='col-md-2'>
                                <input type='text' class="form-control" placeholder="First Name" name="fname">
                            </div>
                            <div class='col-md-2'>
                                <input type='text' class="form-control" placeholder="Last Name" name="lname">
                            </div>
                            <div class='col-md-2'>
                                <input type='text' class="form-control" placeholder="Roll Number" name="roll_no">
                            </div>
                            <div class='col-md-2'>
                                <input type='text' class="form-control date datepicker" placeholder="Start Date" name="start" data-provide="datepicker" data-date-format="dd-mm-yyyy">
                            </div>
                            <div class='col-md-2'>
                                <input type='text' class="form-control date datepicker" placeholder="End Date" name="end" data-provide="datepicker" data-date-format="dd-mm-yyyy">
                            </div>
                            <div class='col-md-2'>
                                <button type="submit" name="search" class="btn btn-primary"><strong><span class="fa fa-search"></span> &nbsp;&nbsp;Search</strong></button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="welcome-section">
                                <h4 class="text-center"> Student List </h4> 
                                <div class="border"></div>
                                <br/>
                                <?php Session::getMessage(); ?>
                                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Sr. NO.</th>
                                            <th>Roll Number</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Branch</th>
                                            <th>Semester</th>
                                            <th>Created</th>
                                            <th>Action </th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Sr. NO.</th>
                                            <th>Roll Number</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Branch</th>
                                            <th>Semester</th>
                                            <th>Created</th>
                                            <th>Action </th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php if($result->num_rows > 0) {
                                                $count=1;
                                                while ($row = $result->fetch_assoc()) {
                                            ?>
                                        <tr>
                                            <td><?php echo $count; ?></td>
                                            <td><?php echo $row['roll_no']; ?></td>
                                            <td><?php echo $row['fname']; ?></td>
                                            <td><?php echo $row['lname']; ?></td>
                                            <td><?php echo $row['branch']; ?></td>
                                            <td><?php echo $row['semester']; ?></td>
                                            <td><?php echo date('d-m-Y H:i:s',strtotime($row['created'])); ?></td>
                                            <td>
                                                <a href="deletestudent.php?id=<?php echo $row['id']; ?>" title="delete"><span class='fa fa-trash sp'></span></a>&nbsp;&nbsp;
                                                <a href="editstudent.php?id=<?php echo $row['id']; ?>" title="edit"><span class='fa fa-edit sp'></span></a>&nbsp;&nbsp;
                                                <a href="studentprofile.php?id=<?php echo $row['user_id']; ?>" title="view"><span class='fa fa-user sp'></span></a>
                                            </td>
                                        </tr>
                                        <?php
                                                $count++;
                                                    }
                                            } ?>
                                    </tbody>
                                </table>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-12"></div>
                </div><!-- /.row -->
            </div>
        </section>
<?php include "footer.php"; ?>