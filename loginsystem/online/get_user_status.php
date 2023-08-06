<?php
session_start();
include('database.inc.php');
$uid=$_SESSION['UID'];
$time=time();
$res=mysqli_query($con,"select * from user");
$i=1;
$html='';

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
	

	$html.='<tr>
                  <th scope="row">'.$i.'</th>
                  <td>'.$row['name'].'</td>
                  <td><button type="button" class="btn '.$class.'">'.$status.'</button></td>
				  <td>'.$row['hospital'].'</td>
				  <td>'.$row['specialization'].'</td>
				  <td>'.$row['contact number'].'</td>
				  <td> <button type="button" class="btn <?php echo $map?>"> <a href="https://www.google.co.in/maps/dir/17.4358528,78.4596992/CMR+hospital,+6-12%2F2007,+Ex-Servicemen+Colony,+Vishwa+Karma+Colony,+Balaji+Nagar,+Hyderabad,+Telangana+500087/@17.4746339,78.4714046,13z/data=!3m1!4b1!4m9!4m8!1m1!4e1!1m5!1m1!1s0x3bcb9beab8791e49:0x9bf95ef4ecee6494!2m2!1d78.5553558!2d17.5130514"?php echo $map?>view</a></button></td>
				  
				  
               </tr>';
	$i++;
}
echo $html;
?>