<?php
session_start();
  //include("connect.php");
  include("cartfunctions.php");
  
  	if(!(isset($_SESSION['UId'])))
	{
	redirect("coolbook");
	}
	
	/*function get_total_qty_db()
	{
	  $userid=$_SESSION['UId'];
	  $sql="SELECT * FROM shopcart WHERE UId='$userid'";
	  $res=mysql_query($sql);
	  $sum=0;
	  while($row=mysql_fetch_array($res))
	   {  
		  $qty=$row['Qty'];
		  $sum+=$qty;	  
	   }
	  return $sum;
	}
	*/
	
  $err="";
  /*if($_POST['command']=='update'){
  
  
        
		$name=$_POST['UName'];
		$id=$_POST['UId'];
		$change=mysql_query("SELECT UName FROM customers WHERE UId='$id'");
		$get_name=mysql_fetch_array($change);
	
   
   
		if($name!=$get_name[0])
		{
		    $same=mysql_query("SELECT UName FROM customers WHERE UName='$name'");
   
   */
			if(isset($exist))
		    {
		       $err="Sorry, this username has been used.";		   
			 }		
		
/*			else
			{
				$fname=$_POST['FName'];
				$lname=$_POST['LName'];
				$email=$_POST['UEmail'];
				$address=$_POST['UAddress'];
				$phone=$_POST['UPhone'];
				$zip=$_POST['UZip'];
				
				$result=mysql_query("UPDATE customers SET UName='$name',FName='$fname',LName='$lname',UEmail='$email',UAddress='$address',UPhone='$phone',UZip='$zip' WHERE UId='$id'");
				
 
 */
 /*	            if(isset($updateSuccess))
				{				
				echo"<fieldset><legend><b>Congratulation</b></legend>
				<div class='backhome'><link rel='stylesheet' href='<?php echo base_url();?>application/views/signup.css' type='text/css'>
				<p style='text-align:center;'><?php echo $username; ?>, you have update your profile, thank you.</p>
				<a href=<?php echo site_url('coolbook/account');?>><input type='button' style='float:right;' class='butn' value='Back'/></a></div></fieldset>";
				 //die('');
				}
			
				else
				{
				echo "You don't edit it.";
				}
				
			}
		}
		else
		{
			$fname=$_POST['FName'];
			$lname=$_POST['LName'];
			$email=$_POST['UEmail'];
			$address=$_POST['UAddress'];
			$phone=$_POST['UPhone'];
			$zip=$_POST['UZip'];
			
			$result=mysql_query("UPDATE customers SET UName='$name',FName='$fname',LName='$lname',UEmail='$email',UAddress='$address',UPhone='$phone',UZip='$zip' WHERE UId='$id'");
			if($result)
			{				
			echo "<fieldset><legend><b>Congratulate</b></legend>
			<div class='backhome'><link rel='stylesheet' href='signup.css' type='text/css'>
			<p style='text-align:center;'>$name, you have update your profile, thank you.</p>
			<a href='viewinfo.php'><input type='button' style='float:right;' class='butn' value='Back'/></a></div></fieldset>";
			die('');
			}
			
			else
			{
			echo "You don't edit it.";
			}
				
		}
		
	}
 
 */
?>


<head>
  <title>Edit information</title>
  <link rel="stylesheet" href="<?php echo base_url();?>application/views/homepage.css" type="text/css">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
  <script language="javascript">

var imgq="<img src='/images/question_symbol.png' width=20px height=16px align='absmiddle' hspace='2'>";

 $(document).ready(function(){
	//global vars
	var form = $("#edit_profile_form");
	var command = $("#command");
	var name = $("#UName");
	var nameInfo = $("#name");
	var fname = $("#FName");
	var fnameInfo = $("#fn");	
	var lname = $("#LName");
	var lnameInfo = $("#ln");	
	var phone = $("#UPhone");
	var phoneInfo = $("#ph");	
	var add = $("#UAddress");
	var addInfo = $("#add");		
	var email = $("#UEmail");
	var emailInfo = $("#email");
    var zip = $("#UZip");
	var zipInfo = $("#zip");
	var error = $("#errmsg");

    //On blur
	name.blur(validateName);
	fname.blur(validateFName);
	lname.blur(validateLName);
	phone.blur(validatePhone);
	add.blur(validateAdd);
	email.blur(validateEmail);
	zip.blur(validateZip);


//validation functions
    function validateName(){
		//if it's NOT valid
		if(name.val().length ==0){
			nameInfo.html(imgq);
			error.html("Fill in the username, please.");
			return false;
		}
		//if it's valid
		else{
			nameInfo.html("");
			error.html("");
			return true;
		}
	}

    function validateFName(){
		//if it's NOT valid
		if(fname.val().length ==0){
			fnameInfo.html(imgq);
			error.html("Fill in your first name, please.");
			return false;
		}
		//if it's valid
		else{
			fnameInfo.html("");
			error.html("");
			return true;
		}
	}
	
    function validateLName(){
		//if it's NOT valid
		if(lname.val().length ==0){
			lnameInfo.html(imgq);
			error.html("Fill in your last name, please.");
			return false;
		}
		//if it's valid
		else{
			lnameInfo.html("");
			error.html("");
			return true;
		}
	}

    function validatePhone(){
		//if it's NOT valid
		if(phone.val().length ==0){
			phoneInfo.html(imgq);
			error.html("Fill in your phone number, please.");
			return false;
		}
		else if(phone.val().length !=10){
			phoneInfo.html(imgq);
			error.html("Should be 10 numbers, please.");
			return false;
		}
		//if it's valid
		else{
			phoneInfo.html("");
			error.html("");
			return true;
		}
	}
	
    function validateAdd(){
		//if it's NOT valid
		if(add.val().length ==0){
			addInfo.html(imgq);
			error.html("Fill in your address, please.");
			return false;
		}
		else if(add.val().length<10){
			addInfo.html(imgq);
			error.html("Fill in valid address, please.");
			return false;
		}
		//if it's valid
		else{
			addInfo.html("");
			error.html("");
			return true;
		}
	}
		
	function validateEmail(){
		//testing regular expression
		var a = email.val();
		var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/;
		//if it's valid email
		if(filter.test(a)){
			emailInfo.html("");
			error.html("");
			return true;
		}
		//if it's NOT valid
		else{
			emailInfo.html(imgq);
			error.html("Fill in valid email, please.");
			return false;
		}
	}
	
    function validateZip(){
		//if it's NOT valid
		if(zip.val().length ==0){
			zipInfo.html(imgq);
			error.html("Fill in your zip code, please.");
			return false;
		}
		else if(zip.val().length!=5){
			zipInfo.html(imgq);
			error.html("Should be 5 numbers, please.");
			return false;
		}
		//if it's valid
		else{
			zipInfo.html("");
			error.html("");
			return true;
		}
	}	
	

    //On Submitting
	form.submit(function(){
		if(validateName() && validateFName() && validateLName() && validatePhone() && validateAdd() && validateEmail() && validateZip()){
		    //command.val("update");
			return true;
		}
		else
			return false;
	});
		
 });

</script>
  
</head>

<body>
 <div id="container">
  <div id="header">
    
	   <ul style="margin-bottom:0;">
	   <li style="padding:5px 5px 5px 10px;"><a href="<?php echo site_url('coolbook');?>" style="font-size:29px;">COOLBOOK</a></li>
	   <li><a href="<?php echo site_url('coolbook/logout');?>" style="float:right;padding:0px 5px;">Logout</a></li>
	   <li><a href="<?php echo site_url('coolbook');?>" style="float:right;padding:0px 5px;">Homepage</a></li>
	   <li><a href="<?php echo site_url('coolbook/shoppingCart');?>" style="float:right;padding:0px 5px;">
	   	  <img src="/images/shopping_cart.png" width="35px" height="35px" alt="cart" style="vertical-align:top;">(<?php echo get_total_qty_db() ?>)</a></li>
	   </ul>	 
    
  </div>

  <div id="category">
    <h2>&nbsp;</h2>
    <h2>My CoolBook</h2>
	<h2>&nbsp;</h2>
    <hr />
	
    <ul>
  
      <li><a href="<?php echo site_url('coolbook/account');?>" style="cursor:pointer">Account Profile</a></li>	
	  <li><a href="<?php echo site_url('coolbook/editProfile');?>" style="cursor:pointer">Edit Profile</a></li>
	  <li><a href="<?php echo site_url('coolbook/changePassword');?>" style="cursor:pointer">Change Password</a></li>
	  <li><a href="<?php echo site_url('coolbook/viewOrder');?>" style="cursor:pointer">My Orders</a></li>

    </ul>
  </div>	

  <div id="content"> 
  
    <h1 style="color:#ec715a;font-weight:bold;">Account Profile</h1>
    <?php 
	  $id = $_SESSION['UId'];
	  $customer = "SELECT * FROM customers WHERE UId = '$id'";
      $resCus = mysql_query($customer);
	  if($cus_info=mysql_fetch_array($resCus))
	  { ?>		
		 <div class="edit_profile" id="edit_profile">
		 <form name="edit_profile_form" id="edit_profile_form" method="post" action="<?php echo site_url('coolbook/saveEditProfile'); ?>">
		    <!--<input type="hidden" name="command" id="command"/>-->
			<span id="errmsg" style="color:#FF6666"><?php echo $err ?></span><br />
			<?php echo validation_errors('<span id="errmsg" style="color:#FF6666">'); ?>
			<input type="hidden" name="UId" id="UId" value="<?php echo $cus_info['UId'] ?>"/>
			<table align="center" border="0" cellpadding="2px">
				<tr>
				  <td>User Name:</td><td><input type="text" name="UName" id="UName" value="<?php echo htmlspecialchars($cus_info['UName']); ?>" />
				  <span id="name"></span></td>
				</tr>
				<tr>
				  <td>First Name:</td>
				  <td><input type="text" name="FName" id="FName" value="<?php echo htmlspecialchars($cus_info['FName']); ?>"/>
				  <span id="fn"></span></td>
			  </tr>
				<tr>
				  <td>Last Name:</td>
				  <td><input type="text" name="LName" id="LName" value="<?php echo htmlspecialchars($cus_info['LName']); ?>"/>
				  <span id="ln"></span></td>
			  </tr>
				<tr>
				  <td>Phone:</td>
				  <td><input type="text" name="UPhone" id="UPhone" value="<?php echo htmlspecialchars($cus_info['UPhone']); ?>"/>
				  <span id="ph"></span></td></tr>
				<tr><td>Address:</td>
				<td><input type="text" name="UAddress" id="UAddress" value="<?php echo htmlspecialchars($cus_info['UAddress']); ?>" />
				<span id="add"></span></td></tr>
				<tr><td>E-mail:</td>
				<td><input type="text" name="UEmail" id="UEmail" value="<?php echo htmlspecialchars($cus_info['UEmail']); ?>"/>
				<span id="email"></span></td></tr>
				<tr>
				  <td>Zip/Postal Code: </td>
				  <td><input type="text" name="UZip" id="UZip" value="<?php echo htmlspecialchars($cus_info['UZip']); ?>"/>
				  <span id="zip"></span></td></tr>
				<tr><td>&nbsp;</td><td><input class="butn" style="float:right; cursor:pointer;" type="submit" value="Save" /></td></tr>
			</table></form>
		</div>
		
	<?php } ?>
    
  </div>
  
  <div id="footer">
  Copyright &copy Yuanzheng Li
  </div>
 </div>
</body>