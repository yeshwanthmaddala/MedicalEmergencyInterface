<?php
session_start();
include('database.inc.php');
$uid=$_SESSION['UID'];
$time=time();
$res=mysqli_query($con,"select * from user");
$i=1;
$html='';

while($row=mysqli_fetch_assoc($res)){
	$status='closed';
	$class="btn-danger";
	if($row['last_login']>$time){
		$status='opened';
		$class="btn-success";
		$location='location';
		$avilabilaty='avilabilaty';
		$contact='contact';
		$Request='Request';
		
		

	}
	

	$html.='<tr>
                  <th scope="row">'.$i.'</th>
                  <td>'.$row['name'].'</td>
                  <td><button type="button" class="btn '.$class.'">'.$status.'</button></td>
				  <td>'.$row['location'].'</td>
				  <td>'.$row['avilabilaty'].'</td>
				  <td>'.$row['contact'].'</td>
				  <td><button type="button" class="btn <?php echo $Request?>"> <a href="/loginsystem/request.php"?php echo $Request?>request</a></button></td>
				  
               </tr>';
	$i++;
}
echo $html;
?>