<?php
  include("connect.php");
  include("cartfunctions.php");
  if(!(isset($_SESSION['UId'])))
	{
	redirect("coolbook");
	}
 ?>


<head>
  <title>Your information</title>
  <link rel="stylesheet" href="<?php echo base_url();?>application/views/homepage.css" type="text/css"> 
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
		 <div class="view_profile" id="view_profile">
			<table align="center" border="0" cellpadding="2px">
				<tr><td>User Name:</td><td><?php echo htmlspecialchars($cus_info['UName']); ?></td>
				</tr>
				<tr><td>First Name:</td><td><?php echo htmlspecialchars($cus_info['FName']); ?></td>
			  </tr>
				<tr><td>Last Name:</td><td><?php echo htmlspecialchars($cus_info['LName']); ?></td>
			  </tr>
				<tr><td>Phone:</td><td><?php echo htmlspecialchars($cus_info['UPhone']); ?></td>
			  </tr>
				<tr><td>Address:</td><td><?php echo htmlspecialchars($cus_info['UAddress']); ?></td>
			  </tr>
				<tr><td>E-mail:</td><td><?php echo htmlspecialchars($cus_info['UEmail']); ?></td>
			  </tr>
				<tr><td>Zip/Postal Code: </td><td><?php echo htmlspecialchars($cus_info['UZip']); ?></td>
			  </tr>
			</table>
		</div>
		
	<?php } ?>
    
  </div>
  
  <div id="footer">
  Copyright &copy Yuanzheng Li
  </div>
 </div>
</body>