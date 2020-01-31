<?php
	include"database.php";
	session_start();
	if(!isset($_SESSION["AID"]))
	{
		echo"<script>window.open('home.php?mes=Access Denied..','_self');</script>";
		
	}		
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Dashboard">
  <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
  <title></title>

  
  <link href="img/favicon.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

  
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
 
  <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="css/zabuto_calendar.css">
  <link rel="stylesheet" type="text/css" href="lib/gritter/css/jquery.gritter.css" />
  
  <link href="css2/style.css" rel="stylesheet">
  <link href="css2/style-responsive.css" rel="stylesheet">
  <script src="lib/chart-master/Chart.js"></script>

  
</head>

<body>
  <section id="container">
    
    <header class="header black-bg">
      <div class="sidebar-toggle-box">
        <div class="fa fa-bars tooltips" data-placement="right" ></div>
      </div>
      
      <a href="admin_home.php" class="logo"><b>DASH<span>BOARD</span></b></a>
      
      </div>
      <div class="top-menu">
        <ul class="nav pull-right top-menu">
          <li><a class="logout" href="logout.php">Logout</a></li>
        </ul>
      </div>
    </header>
   
    <aside>
      <div id="sidebar" class="nav-collapse ">
        
        <ul class="sidebar-menu" id="nav-accordion">
          
          <h5 class="centered"><?php echo $_SESSION['ANAME'];?></h5>
          <li class="mt">
            <a href="admin_home.php">
              <i class="fa fa-dashboard"></i>
              <span>Dashboard</span>
              </a>
          </li>
          <li class="sub-menu">
            <a class="active" href="javascript:;">
              <i class="fa fa-users"></i>
              <span>Mentor Allocation</span>
              </a>
            <ul class="sub">
              <li><a href="select_mentor.php">Group Allocation</a></li>
              <li class="active"><a href="individual_select.php">Allocate Individually</a></li>
            </ul>
          </li>
           <li class="sub-menu">
            <a href="reset.php">
              <i class="fa fa-rotate-right"></i>
              <span>Reset Contraints</span>
              </a>
          </li>
          <li class="sub-menu">
            <a href="view_blacklist.php">
              <i class="fa fa-times-circle"></i>
              <span>View Blacklist</span>
              </a>
          </li>
          <li class="sub">
            <a href="faq.html">
              <i class="fa fa-question"></i>
              <span>FAQ</span>
              </a>
          </li>
        </ul>

        
      </div>
    </aside>
    


 <section id="main-content">
      <section class="wrapper site-min-height">
        
          <br>
        <br>

        <?php  if (isset($_SESSION['AID'])) 
    {

        $query = "SELECT DISTINCT BATCH FROM student";
        $res = mysqli_query($db, $query);
        $n = mysqli_num_rows($res);

        ?>
        <div class="row mt">
          <div class="col-lg-12">
            <div class="form-panel" style="width: 80%;margin: auto;">
              <h4 class="mb" align="center">Select Constraints</h4>
              <form class="form-horizontal style-form" method="post">
       
           <select class="form-control" name="batch" style="width: 300px;margin-left: 50px;">
                  <option>Choose the batch </option>
          <?php
               for($i=1;$i<=$n;$i++)
              {
                $row = mysqli_fetch_array($res);
                $id = $row['BATCH'];
              ?>
              <option value="<?php echo $id?>"><?php echo $id?></option>
            <?php
          }
      
      ?>
    </select>
    <br>
    <br>
    <br>
    
    <select class="form-control" name="branch" style="width: 300px;margin-left: 650px;margin-top: -89px;">
                      <option>Choose the Branch</option>
              <?php
               $query = "SELECT DISTINCT BRANCH FROM student";
                $res = mysqli_query($db, $query);
                $n = mysqli_num_rows($res);
                   for($i=1;$i<=$n;$i++)
                  {
                    $row = mysqli_fetch_array($res);
                    $id = $row['BRANCH'];
                  ?>
                  <option value="<?php echo $id?>"><?php echo $id?></option>
                <?php
              }
          ?>
        </select>
    <br>
    <button type="btn" class="btn btn-theme" style="text-align: center;margin:auto;
  display:block;width: 150px;height: 40px;" name="view_sm">View</button>
  <?php 
          $batch="";
          $branch="";
          $q="";
          $res="";
          $n="";
          $res1="";
          $q1="";
          $n1="";
          $brnach1="";
          $mq="";
          $mres="";
          $mn="";
          if(isset($_POST['view_sm']))
          {
              $batch = mysqli_real_escape_string($db, $_POST['batch']);
              $branch = mysqli_real_escape_string($db, $_POST['branch']);


         }?>

  </form>
</div>
</div>
</div>


<div class="row mt">
          <div class="col-lg-12">
            <div class="form-panel" style="width: 80%;margin: auto;">
              <h4 class="mb" align="center">Select Mentor</h4>
              <form class="form-horizontal style-form" method="post">
                <?php
          $_SESSION['batch'] = $batch;
          $_SESSION['branch'] = $branch;
          
         ?>
        
    <?php

                      $q = "SELECT * FROM student WHERE BRANCH = '$branch' AND BATCH='$batch'";
                         $res = mysqli_query($db, $q);
                          $n = mysqli_num_rows($res);
                          $branch2="";
                          if($branch=="IT" OR $branch=="CE")
                          {
                              if($branch=="IT")
                              {
                                  $branch2="CE";
                              }
                              else
                              {
                                $branch2="IT";
                              }
                              $mq = "SELECT * FROM mentor WHERE (BRANCH = '$branch' OR BRANCH='$branch2')";
                          }

                         else
                         {
                          $mq = "SELECT * FROM mentor WHERE BRANCH = '$branch'";
                         }
                          $mres = mysqli_query($db, $mq);
                          $mn = mysqli_num_rows($mres);
             
            ?><?php $batch = $_SESSION['batch']; $branch=$_SESSION['branch'];?>
            <div class="form-group">
                      <label class="control-label" style="font-size: 17px;margin-left: 330px;">You have Selected batch of <?php echo $batch;?> and Branch as <?php echo $branch?></label>
                      
               <input type="text" name="batch" style="width: 50px;text-align: center;display: none;" value="<?php echo $batch;?>">
                <input type="text" name="branch" style="width: 50px;text-align: center;display: none;" value="<?php echo $branch;?>">
             
           </div>

           <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label" style="font-size: 17px;margin-left: 110px;">Total Students</label>
                      <div class="col-sm-10">
                        <input style="width: 50px;text-align: center;margin-left: 270px;margin-top: -30px;"type="text" class="form-control" required value="<?php echo $n;?>" name="num"  disabled>
                      
                    </div>
                    
                      <label class="control-label" style="font-size: 17px;margin-left:150px;margin-top: -2px;">Student ID With Mentor</label>
                      <div class="col-sm-10">
                        <select  class="form-control" name="batch" style="width: 250px;margin-left: 650px;margin-top: -35px;" > 
                  <option>View Student ID with Mentor </option>
                            <?php
                              for($i=0;$i<$n;$i++)
                              {
                                  $row = mysqli_fetch_array($res);
                                  $id = $row['SID'];
                                  $MID = $row['MID'];
                                  $nquery = "SELECT MNAME FROM mentor WHERE MID='$MID'";
                                  $res3 = mysqli_query($db, $nquery);
                                  $rres = $res3->fetch_assoc();
                                  $MNAME = $rres['MNAME'];

                                ?>
                                <option disabled><?php echo $id; echo "  -  ";echo $MNAME;?></option>
                            <?php
                              }
                            ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label" style="font-size: 17px;margin-left:-735px;">Student ID</label>
                      <div class="col-sm-10">
                        <select  class="form-control" name="individual" style="width: 170px;margin-left: 270px;" > 
                  <option>Select Student ID </option>
                            <?php

                                $q = "SELECT * FROM student WHERE BRANCH = '$branch' AND BATCH='$batch'";
                                 $res = mysqli_query($db, $q);
                                  $n = mysqli_num_rows($res);
                              for($i=0;$i<$n;$i++)
                              {
                                 $row = mysqli_fetch_array($res);
                                 $id = $row['SID'];

                              ?>
                                <option><?php echo $id;?></option>
                            <?php
                              }
                            ?>
                        </select>
                      </div>

                    <label class="control-label" style="font-size: 17px;margin-left:350px;"> Mentor</label>
                      <div class="col-sm-10">
                    <select class="form-control" name="cmentor" style="width: 167px;margin-left: 650px;margin-top: -33px;">
                    <option>Choose the Mentor</option>
                    <?php
                        for($i=0;$i<$mn;$i++)
                        {
                            $row = mysqli_fetch_array($mres);
                            $id = $row['MNAME'];
                    ?>
                     <option><?php echo $id;?></option>
                     <?php
                        }
                     ?>
                </select>
            </div>
</div>
<button type="btn" class="btn btn-theme" style="text-align: center;margin:auto;
  display:block;width: 150px;height: 40px;" name="assign">Assign</button>

    <?php

                if(isset($_POST['assign']))
                {
                    $id = mysqli_real_escape_string($db, $_POST['individual']);
                    $cmentor = mysqli_real_escape_string($db, $_POST['cmentor']);

                    $query = "SELECT MID FROM mentor WHERE MNAME = '$cmentor'";
                    $res = mysqli_query($db, $query);
                    $ro = $res->fetch_assoc();
                    $MID = $ro['MID'];

                    $query = "UPDATE student SET MID='$MID' WHERE SID='$id'";
                    $res = mysqli_query($db, $query);
                }
    ?>
            </form>
           </div>
         </div>
       </div>
      </section>
      
    </section>


<?php

}

?>


            
    <footer class="site-footer">
      <div class="text-center">
        
    </footer>
   
  </section>
  
  <script src="lib/jquery/jquery.min.js"></script>

  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <script class="include" type="text/javascript" src="lib/jquery.dcjqaccordion.2.7.js"></script>
  <script src="lib/jquery.scrollTo.min.js"></script>
  <script src="lib/jquery.nicescroll.js" type="text/javascript"></script>
  <script src="lib/jquery.sparkline.js"></script>
 
  <script src="lib/common-scripts.js"></script>
  <script type="text/javascript" src="lib/gritter/js/jquery.gritter.js"></script>
  <script type="text/javascript" src="lib/gritter-conf.js"></script>
</body>

</html>
