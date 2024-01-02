<?php 
$connection=mysqli_connect("localhost","root","","session");
if(isset($_REQUEST['btnsubmit']))
{
	$name=$_REQUEST['name'];
	$email=$_REQUEST['email'];
	$password=$_REQUEST['password'];
	$gender=$_REQUEST['g'];
	
	$hobbies=$_REQUEST['h'];
	// array to string - implode();
	// string to array - explode();
	$string_hobbies=implode("/",$hobbies);

	$city=$_REQUEST['city'];
	$address=$_REQUEST['address'];
	$insert="insert into form (name,email,password,gender,hobbies,city,address)values('$name','$email','$password','$gender','$string_hobbies','$city','$address')";
	mysqli_query($connection,$insert);
	header("location:form.php");
}
if(isset($_REQUEST['e']))
{
	$id=$_REQUEST['e'];
	$edit="select * from form  where id='$id'";
	$edit_executed=mysqli_query($connection,$edit);
	$edit_fetch=mysqli_fetch_array($edit_executed);

}

if(isset($_REQUEST['btnupdate']))
{
	$id=$_REQUEST['e'];
	$name=$_REQUEST['name'];
	$email=$_REQUEST['email'];
	$password=$_REQUEST['password'];
	$gender=$_REQUEST['g'];
	
	$hobbies=$_REQUEST['h'];
	// array to string - implode();
	// string to array - explode();
	$string_hobbies=implode("/",$hobbies);

	$city=$_REQUEST['city'];
	$address=$_REQUEST['address'];
	$update="update form set name='$name', email='$email', password='$password', gender='$gender', hobbies='$string_hobbies', city='$city', address='$address' where id='$id'";
	mysqli_query($connection,$update);
	header("location:display.php");
}

?>
<html>
		<head>
			<title>Form Page</title>
		</head>

		<body>
			<form method="post">
				<table align="center" border="2">
				<caption><h3>Form Page</h3></caption>
				<tr>
					<th>Name:</th>
					<td><input type="text" name="name" placeholder="Enter name here" value="<?php echo @$edit_fetch['name']; ?>"></td>
				</tr>
				
				<tr>
					<th>Email:</th>
					<td><input type="text" name="email" placeholder="Enter email here" value="<?php echo @$edit_fetch['email']; ?>"></td>
				</tr>
				
				<tr>
					<th>Password:</th>
					<td><input type="password" name="password" placeholder="Enter password here" value="<?php echo @$edit_fetch['password']; ?>"></td>
				</tr>

				<tr>
					<th>Gender:</th>
					<!--
					<?php 
					if(@$edit_fetch['gender']=='male')
					{
						?>
						<td><input type="radio" name="g" checked value="male">Male
						<input type="radio" name="g" value="female">Female
						</td>
						<?php

					}
					else if(@$edit_fetch['gender']=='female')
					{
						?>

						<td><input type="radio" name="g" value="male">Male
						<input type="radio" name="g" checked value="female">Female
						</td>
						<?php
					}
					else
					{
							?>

							<td><input type="radio" name="g" value="male">Male
							<input type="radio" name="g" value="female">Female
							</td>
							<?php
					}
					?>
					
					-->

							<td>
								<input type="radio" <?php if(@$edit_fetch['gender']=='male') { ?> checked <?php } ?> name="g" value="male">Male
								<input type="radio" <?php if(@$edit_fetch['gender']=='female') { ?> checked <?php } ?> name="g" value="female">Female
							</td>
							

				</tr>

				<tr>
					<th>Hobbies:</th>
					<?php 
						$ar=explode("/",@$edit_fetch['hobbies']);
						//print_r($ar);
						if(@$ar[0]=='coding')
						{
					?>

						<td><input type="checkbox" checked name="h[]" value="coding">Coding

						<?php 
						}
						else
						{
							?>
							<td><input type="checkbox" name="h[]" value="coding">Coding
							<?php
						}

						if(@$ar[0]=='cricket' or @$ar[1]=='cricket')
						{
							?>
							<input type="checkbox" checked name="h[]" value="cricket">Cricket
							<?php
						}
						else
						{

							?>
							<input type="checkbox" name="h[]" value="cricket">Cricket
							<?php

						}
						?>





						
					</td>
				</tr>



				<tr>
					<th>City:</th>
					<td>
					<!--	<?php
						if($edit_fetch['city']=='Surat')
						{
							?>
							<select name="city">
							<option>Select city</option>
							<option selected>Surat</option>
							<option>Vapi</option>
							</select>
							<?php

						}
						else if($edit_fetch['city']=='Vapi')
						{
							?>
							<select name="city">
							<option>Select city</option>
							<option>Surat</option>
							<option selected>Vapi</option>
							</select>
							<?php

						}
						else
						{
							?>
							<select name="city">
							<option>Select city</option>
							<option>Surat</option>
							<option>Vapi</option>
							</select>
							<?php
						}
						?>
						-->


						<select name="city">
							<option>Select city</option>
							<option <?php if(@$edit_fetch['city']=='Surat') { ?> selected <?php  } ?>>Surat</option>
							<option <?php if(@$edit_fetch['city']=='Vapi') { ?> selected <?php  } ?>>Vapi</option>
							</select>
							
					</td>
				</tr>
<tr>
					<th>Address:</th>
					<td>
						<textarea name="address" placeholder="Enter address here"><?php echo @$edit_fetch['address']; ?></textarea>
					</td>
				</tr>



				<tr>
					<td align="center" colspan="2">
						<?php
						if(isset($_REQUEST['e']))
						{
							?>
							<input type="submit" name="btnupdate" value="Update">
							<?php

						}
						else
						{
						?>
						<input type="submit" name="btnsubmit" value="Add">

						<?php 

						}
						?>
						<!-- <button type="submit" name="btnsubmit">Add</button> -->
					</td>
				</tr>




				</table>
			</form>
		</body>
</html>