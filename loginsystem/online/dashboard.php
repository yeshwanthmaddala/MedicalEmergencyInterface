<?php
session_start();
include('database.inc.php');
if(!isset($_SESSION['UID'])){
	header('location:index.php');
	die();
}
$time=time();
$res=mysqli_query($con,"select * from user");
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="robots" content="noindex, nofollow">
      <title>User Status Dashboard</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
      <style type="text/css">
         body {
			 margin: 0;
			 padding: 0;
			 background-color: #F7F7F7;
			 height: 100vh;
         }
         .container  {
			 margin-top: 100px;
			 border: 1px solid #9C9C9C;
			 background-color: #fff;
			 padding:30px;
         }    
		 .container h2{
			margin-bottom:25px;
		 }
		 .text-info {
			color: #000 !important;
		}
      </style>
      <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
      
   </head>
   <body>
      <div class="container">
         <h2 class="text-center text-info">Doctors Status Dashboard</h2>
		 <h5 class="text-center text-info"><a href="logout.php">Logout</a></h5>
         <table class="table table-striped table-bordered">
            <thead>
               <tr>
                  <th width="5%">#</th>
                  <th width="10%">Name</th>
                  <th width="15%">Status</th>
				  <th width="20%">hospital</th>
				  <th width="10%">specialization</th>
				  <th width="10%">contact</th>
				  <th width="10%">map</th>

               </tr>
            </thead>
            <tbody id="user_grid">
			   <?php 
			   $i=1;
			   while($row=mysqli_fetch_assoc($res)){
			   $status='Offline';
			   $class="btn-danger";
			   if($row['last_login']>$time){
					$status='Online';
					$class="btn-success";
					$hospital='hospital';	
					$specialization='specialization';
					$contact='contact number';
					$map='map';


					
			   }
			   ?>	
               <tr>
                  <th scope="row"><?php echo $i?></th>
                  <td><?php echo $row['name']?></td>
                  <td><button type="button" class="btn <?php echo $class?>"><?php echo $status?></button></td>
				  <td><?php echo $row['hospital']?></td>
				  <td><?php echo $row['specialization']?></td>
				  <td> <?php echo $row['contact number']?></td>
				  <td><button type="button" class="btn <?php echo $map?>"> <a href="https://www.google.co.in/maps/dir/17.4358528,78.4596992/CMR+hospital,+6-12%2F2007,+Ex-Servicemen+Colony,+Vishwa+Karma+Colony,+Balaji+Nagar,+Hyderabad,+Telangana+500087/@17.4746339,78.4714046,13z/data=!3m1!4b1!4m9!4m8!1m1!4e1!1m5!1m1!1s0x3bcb9beab8791e49:0x9bf95ef4ecee6494!2m2!1d78.5553558!2d17.5130514"?php echo $map?>view</a></button></td>
               </tr>
			   <?php 
			   $i++;
			   } ?>
            </tbody>
         </table>
      </div>
	  <script>
		function updateUserStatus(){
			jQuery.ajax({
				url:'update_user_status.php',
				success:function(){
					
				}
			});
		}
		
		function getUserStatus(){
			jQuery.ajax({
				url:'get_user_status.php',
				success:function(result){
					jQuery('#user_grid').html(result);
				}
			});
		}
		
		setInterval(function(){
			updateUserStatus();
		},3000);
		
		setInterval(function(){
			getUserStatus();
		},7000);
	  </script>
   </body>
</html>