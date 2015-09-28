<?php
	include("connect.php");
	include("cartfunctions.php");
	
	/*if($_POST['command']=='signup'){
	
        $err="";
		$name=$_POST['UName'];
		$same=mysql_query("SELECT UName FROM customers WHERE UName='$name'");
	 
	 */
	 $err="";
		if(isset($exist))
		{ 
		   $err="<p style='color:red;'>Sorry, this username has been used.</p>";
         } 
	    /*else
		{

		$pw=$_POST['UPass'];
		$fname=$_POST['FName'];
		$lname=$_POST['LName'];
		$email=$_POST['UEmail'];
		$address=$_POST['UAddress'];
		$phone=$_POST['UPhone'];
		$zip=$_POST['UZip'];
		
		$result=mysql_query("insert into customers(UName,UPass,FName,LName,UEmail,UAddress,UPhone,UZip) values('$name','$pw','$fname','$lname','$email','$address','$phone','$zip')");
		$customerid=mysql_insert_id();
		echo "<fieldset><legend><b>Congratulate</b></legend>
		<div class='backhome'><link rel='stylesheet' href='signup.css' type='text/css'>
		<p style='text-align:center;'>$name, your are the NO.$customerid customer, thank you.</p>
		<a href='customerlogin.php'><input type='button' style='float:right;' class='butn' value='Back'/></a></div></fieldset>";
		die('');
		}
	}
		 
		 */
?>

<html>
<head>
<link rel="stylesheet" href="<?php echo base_url(); ?>application/views/shopcart.css" type="text/css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<title>Register</title>

<script>
var imgq="<img src='/images/question_symbol.png' width=22px height=20px align='absmiddle' hspace='2'>"


 $(document).ready(function(){
	//global vars
	var form = $("#signForm");
	var command = $("#command");
	var name = $("#UName");
	var nameInfo = $("#name");
	var pw = $("#UPass");
	var pwInfo = $("#pw");
	var cpw = $("#CPass");
	var cpwInfo = $("#cpw");	
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
	pw.blur(validatePass);
	cpw.blur(validateCPass);
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
		if(validateName() && validatePass() && validateCPass && validateFName() && validateLName() && validatePhone() && validateAdd() && validateEmail() && validateZip()){
		    //command.val("signup");
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
	   <li style="padding:5px 5px 5px 10px;"><a href="<?php echo site_url('coolbook'); ?>" style="font-size:29px;">COOLBOOK</a></li>
	   <li><a href="<?php echo site_url('coolbook/checkCustomer'); ?>" style="float:right;padding:0px 5px;">Login</a></li>
	   <li><a href="<?php echo site_url('coolbook'); ?>" style="float:right;padding:0px 5px;">Continue Shopping</a></li>
	   </ul>
 
    
  </div>

  <div id="content"> 

    <form name="signForm" id="signForm" method="post" action="<?php echo site_url('coolbook/createCustomer'); ?>">
      <!--<input type="hidden" name="command" id="command"/>-->
      <fieldset style="border-radius:8px; width:350px; margin-left:350; margin-top:100;">
	  <h5>Already have an account? <a href="<?php echo site_url('coolbook/checkCustomer'); ?>" style="text-decoration:none;">Log in</a> now</h5>
      <legend style="color:#FFFFFF;"><b>Register</b></legend>
	    <div class="field">
		<span id="errmsg" style="color:#FF6666"><?php echo $err ?></span><br />
		<?php echo validation_errors('<span id="errmsg" style="color:#FF6666">'); ?>
        <table border="0" cellpadding="2px" style="background-color:#d8d8d8;" align="center">
        	<tr>
        	  <td>User Name:</td><td><input type="text" name="UName" id="UName" maxlength="20"/>
			  <span id="name"></span></td>
        	</tr>
        	<tr>
        	  <td>Password:</td>
        	  <td><input type="password" name="UPass" id="UPass" maxlength="20"/>
			  <span id="pw"></span></td>
      	  </tr>
        	<tr>
        	  <td>Confirm Password: </td>
        	  <td><input type="password" name="CPass" id="CPass"/>
			  <span id="cpw"></span></td>
      	  </tr>
        	<tr>
        	  <td>First Name:</td>
        	  <td><input type="text" name="FName" id="FName" maxlength="20"/>
			  <span id="fn"></span></td>
      	  </tr>
        	<tr>
        	  <td>Last Name:</td>
        	  <td><input type="text" name="LName" id="LName" maxlength="20"/>
			  <span id="ln"></span></td>
      	  </tr>
            <tr>
              <td>Phone:</td>
			  <td><input type="text" name="UPhone" id="UPhone" maxlength="10"/>
			  <span id="ph"></span></td></tr>
            <tr><td>Address:</td>
			<td><input type="text" name="UAddress" id="UAddress"/>
			<span id="add"></span></td></tr>
            <tr><td>E-mail:</td>
			<td><input type="text" name="UEmail" id="UEmail"/>
			<span id="email"></span></td></tr>
            <tr>
              <td>Zip/Postal Code: </td>
              <td><input type="text" name="UZip" id="UZip" maxlength="5"/>
			  <span id="zip"></span></td></tr>
            <tr><td>&nbsp;</td><td><input class="butn" style="float:right;" type="submit" value="Sign Up" /></td></tr>
        </table></div>
      </fieldset>
	</form>


  </div>
  
  <div id="footer">
  Copyright &copy Yuanzheng Li
  </div>


 </div>

</body>

