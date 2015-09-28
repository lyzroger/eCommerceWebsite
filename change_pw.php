<?php
  include("connect.php");
  include("cartfunctions.php");
  if(!(isset($_SESSION['UId'])))
	{
	redirect("coolbook");
	}
	
	$err="";
	
  /*if($_POST['command']=='update'){
  

	        
			$opw=$_POST['OPass'];
			$id=$_POST['UId'];
			$get_pw=mysql_query("SELECT UPass FROM customers WHERE UId='$id'") or die('Error find this ID.');
			$password=mysql_fetch_array($get_pw);
   
   */
			if(isset($nonmatch))
			{
			 $err="Sorry, please check your old password.";
			}
		
 /*           else
			{
				$pw=$_POST['UPass'];
				$result=mysql_query("UPDATE customers SET UPass='$pw' WHERE UId='$id'");
				if($result)
				{				
				echo "<fieldset><legend><b>Congratulate</b></legend>
				<div class='backhome'><link rel='stylesheet' href='signup.css' type='text/css'>
				<p style='text-align:center;'>Successfully changing password.</p>
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
	var form = $("#edit_pw_form");
	var command = $("#command");
	var opw = $("#OPass");
	var opwInfo = $("#opw");
	var pw = $("#UPass");
	var pwInfo = $("#pw");
	var cpw = $("#CPass");
	var cpwInfo = $("#cpw");
	var error = $("#errmsg");	

    //On blur
	opw.blur(validateOPass);
	pw.blur(validatePass);
	cpw.blur(validateCPass);

//validation functions
	function validateOPass(){
		//it's NOT valid
		if(opw.val().length <3){
			opwInfo.html(imgq);
            error.html("Check your old password please.");
			return false;
		}
		//it's valid
		else{			
			opwInfo.html("");
			error.html("");
			return true;
		}
	}
	
	function validatePass(){
		//it's NOT valid
		if(pw.val().length <3){
			pwInfo.html(imgq);
            error.html("At least 3 characters please.");
			return false;
		}
		//it's valid
		else{			
			pwInfo.html("");
			error.html("");
			return true;
		}
	}
	
	function validateCPass(){
		//are NOT valid
		if( cpw.val().length==0 ){
			cpwInfo.html(imgq);
            error.html("Please comfirm your password.");
			return false;
		}
		else if( pw.val() != cpw.val() ){
			cpwInfo.html(imgq);
            error.html("Don't match, please check.");
			return false;
		}
		//are valid
		else{
			cpwInfo.html("");
			error.html("");
			return true;
		}
	}
	
    //On Submitting
	form.submit(function(){
		if(validateOPass() && validatePass() && validateCPass()){
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
	   <li><a href="<?php echo site_url('coolbook/shoppingCart');?>" style="float:right;padding:0px 5px;"><img src="/images/shopping_cart.png" width="35px" height="35px" alt="cart" style="vertical-align:top;">(<?php echo get_total_qty_db()?>)</a></li>
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
		 <form name="edit_pw_form" id="edit_pw_form" method="post" action="<?php echo site_url('coolbook/savePassword'); ?>">
		    <!--<input type="hidden" name="command" id="command"/>-->			
			<span name="errmsg" id="errmsg" style="color:#FF6666"><?php echo $err ?></span><br />
			<?php echo validation_errors('<span id="errmsg" style="color:#FF6666">'); ?>
			<input type="hidden" name="UId" id="UId" value="<?php echo $cus_info['UId'] ?>"/>
			<table align="center" border="0" cellpadding="2px">
				  <td>Old Password:</td>
				  <td><input type="password" name="OPass" id="OPass"/>
				  <span id="opw"></span></td>
			  </tr>
				<tr>
				  <td>New Password:</td>
				  <td><input type="password" name="UPass" id="UPass"/>
				  <span id="pw"></span></td>
			  </tr>
				<tr>
				  <td>Confirm Password: </td>
				  <td><input type="password" name="CPass" id="CPass"/>
				  <span id="cpw"></span></td>
			  </tr>
				<tr><td>&nbsp;</td><td><input class="butn" style="float:right; cursor:pointer;" type="submit" value="Save"  /></td></tr>
			</table></form>
		</div>
		
	<?php } ?>
    
  </div>
  
  <div id="footer">
  Copyright &copy Yuanzheng Li
  </div>
 </div>
</body>