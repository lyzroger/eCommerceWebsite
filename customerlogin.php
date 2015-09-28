<?php
session_start();
//setcookie(session_name(),session_id(),time()+60*30,"/");
	
include("cartfunctions.php");
$errText="";
if(isset($_POST['username']) && isset($_POST['pw']))
{
  $username=$_POST['username'];
  $password=$_POST['pw'];

  
  
  

  if(strlen($username)==0)
    {$errText='Please enter username!';}
  if(strlen($password)==0)
    {$errText='Please enter password!';}
  if(strlen($username)==0&&strlen($password)==0)
    {$errText='';}
  if(strlen($username)>0 && strlen($password)>0)
    {
     /*$con=mysql_connect('localhost','root','36631213');
     if(!$con)
       {die ('Cannot connect to Database!');}
	 else
	 {mysql_select_db('coolbook',$con);}
	 $sql="SELECT * FROM customers WHERE UName='$username' AND UPass='$password'";
	 
     $res=mysql_query($sql);
	  
	  */
     if(!(isset($customer)))
	   {
	   $errText='User does not exist! <br />Please check your username and password!';
	   }
     else
	   {
	   foreach ($customer as $row):
	   $userid=$row->UId;
	   $_SESSION['UId']=$userid;
	   if(isset($_SESSION['visitedCheckout']))
	     $loc='coolbook/checkout';
	   else if(isset($_SESSION['visitedCart']))
	     $loc='coolbook/shoppingCart';
	   else
	     $loc='coolbook';
	   
	   if(isset($_SESSION['cart']))
      {
	    $items=count($_SESSION['cart']);
	    for($i=0;$i<$items;$i++)
		  {
			$proId=$_SESSION['cart'][$i]['productid'];
			$qty=$_SESSION['cart'][$i]['qty'];
			if($qty==0) continue;
			$checkSame="SELECT * FROM shopcart WHERE PId='$proId' AND UId='$userid'";
			$resSame=mysql_query($checkSame);
			$res=mysql_query($checkSame);
			
			if(!($row=mysql_fetch_array($resSame)))
				{
			      $uid=$_SESSION['UId'];
				  $SId=session_id();
				  $price=get_item_price($proId);
				  $sql="INSERT INTO shopcart (PId, Qty, PPrice, UId, SId) VALUES ('$proId','$qty','$price','$uid','$SId')";
				  $res=mysql_query($sql);
			    }
            else
                {
				$rowUpdate=mysql_fetch_array($res);
				$qtyNew=$rowUpdate['Qty']+$qty;
				$sql="UPDATE shopcart SET Qty='$qtyNew' WHERE PId='$proId'";
				$res=mysql_query($sql);
				}			
		  }	
		
      }
	   
	   
	   
	   redirect($loc);
endforeach;
	   }
    } 
  }?>

<head>
<link rel="stylesheet" href="<?php echo base_url(); ?>application/views/shopcart.css" type="text/css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

<script>
var imgq="<img src='/images/question_symbol.png' width=20px height=16px align='absmiddle' hspace='2'>";
 $(document).ready(function(){
 
 //global vars
	var form = $("#loginForm");
	var name = $("#username");
	var nameInfo = $("#use");
	var pass = $("#pw");
	var passInfo = $("#pass");
	var error = $("#error");
	
	//On blur
	name.blur(validateName);
	pass.blur(validatePass);

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
		//if it's NOT valid
		if(pass.val().length ==0){
			passInfo.html(imgq);
			error.html("Fill in the password, please.");
			return false;
		}
		//if it's valid
		else{
			passInfo.html("");
			error.html("");
			return true;
		}
	} 
 
     //On Submitting
	form.submit(function(){
		if(validateName()&validatePass())
			return true;
		else
			return false;
	});
 
 
 
 
 });
 
</script>

<title>CoolBook</title>
</head>	


<body>

 <div id="container">
  <div id="header">
    
	<?php 
	
	
	
	 if(isset($_SESSION['UId'])==true)
	   {	 
	 ?>
	   <ul style="margin-bottom:0;">
	   <li style="padding:5px 5px 5px 10px;"><a href="<?php echo site_url('coolbook'); ?>" style="font-size:29px;">COOLBOOK</a></li>
	   <li><a href="<?php echo site_url('coolbook/logout'); ?>" style="float:right;padding:0px 5px;">Logout</a></li>
	   <li><a href="<?php echo site_url('coolbook'); ?>" style="float:right;padding:0px 5px;">Continue Shopping</a></li>
	   <li><a href="<?php echo site_url('coolbook/account'); ?>" style="float:right;padding:0px 5px;">My Account</a></li>
	   </ul>
	   <?php
	   }
	   else
	   {
	   ?>
	   <ul style="margin-bottom:0;">
	   <li style="padding:5px 5px 5px 10px;"><a href="<?php echo site_url('coolbook'); ?>" style="font-size:29px;">COOLBOOK</a></li>
	   <li><a href="<?php echo site_url('coolbook/signup'); ?>" style="float:right;padding:0px 5px;">Sign Up</a></li>
	   <li><a href="<?php echo site_url('coolbook'); ?>" style="float:right;padding:0px 5px;">Continue Shopping</a></li>
	   </ul>
	   <?php
	   }
	   ?>	 
    
  </div>

  <div id="content"> 
    <p style="color:red;text-align:center">
	  <?php echo $errText; ?>
	</p>
  <form id="loginForm" name="loginForm" method="post" >
  <div style="text-align:center">
    
  <fieldset style="border-radius:8px; width:350px; margin-left:350; margin-top:160;">
	<h5>Don't have an account? <a href="<?php echo site_url('coolbook/signup'); ?>" style="text-decoration:none;">Sign Up</a> now</h5>
    <legend style="color:#FFFFFF;"><b>Login</b></legend>
	    <span id="error" style="color:red;"></span>
	    <table style="background-color:#d8d8d8;" align="center">
		<tr><td>User Name:</td>
		    <td><input class="css_input" id="username" type="text" name="username"/>
			    <span id="use"></span>
			</td>
		</tr>
	    <tr><td>Password:</td>
		    <td><input class="css_input" id="pw" type="password" name="pw"/>
			    <span id="pass"></span>
			</td>
		</tr>
		</table>
	<div class="button" style="margin-top:20px;">
	   <input type="submit" name="login" id="login" value="Login" class="butn"/>
	   <input name="reset" type="reset" value="Reset" class="butn" />
	 
	</div>	   
  </fieldset>
  </div>
  </form>

  </div>
  
  <div id="footer">
  Copyright &copy Yuanzheng Li
  </div>
  
 </div>

</body>
