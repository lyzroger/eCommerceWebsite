<?php
  include("connect.php");
  include("cartfunctions.php");
  if(!(isset($_SESSION['UId'])))
	{
	redirect("coolbook");
	}
?>


<head>
  <title>Your Orders</title>
  <link rel="stylesheet" href="<?php echo base_url();?>application/views/homepage.css" type="text/css"> 
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
  <script>
 
  
  
  $(document).ready(function(){
	  
	      //click different order detail,  will do ajax to catch matched page
		  $(".add").click(function(){
		      var id = $(this).attr("value");
		      var selectOrder={
		      	orderid: id,
			    ajax: '1'
		      };
			  
			  $.ajax({
			  url: "<?php echo site_url('coolbook/showOrderDetail');?>",
			  type: 'GET',
			  data: selectOrder,
			  success: function(msg){
				  $("#content").html(msg); 
				 }
			  }); 
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
  
    <h1 style="color:#ec715a;font-weight:bold;">Your Orders</h1>
    <?php 
	  $id = $_SESSION['UId'];
	  $order = "SELECT order_id, date, price FROM orders WHERE cus_id = '$id'";
      $res = mysql_query($order);
	  $res2 = mysql_query($order);
	  if($order_info2=mysql_fetch_array($res2))
	  {
    ?>		
		 <div class="view_profile" id="view_profile">
		   <form name="view_order_form" method="post" <!--action="view_order_detail.php"-->
		   <input type="hidden" name="command" />
		   <input type="hidden" name="orderid" />
			<table align="center" border="0" cellpadding="2px" style="font:Verdana, Arial, Helvetica, sans-serif 11px;background-color:#333333;font:#333333;">
				<tr style="font-weight:bold;color:#ffffff;">
				<td width="120">Order ID</td><td width="120">Order Date</td><td width="100">Total</td><td>Action</td></tr>
				<?php 
					  while($order_info=mysql_fetch_array($res))
	                 {
				?>
						<tr style="background-color:#ffffff;">
						<td><a class="add" value="<?php echo $order_info['order_id'] ?>" style="cursor:pointer"><?php echo $order_info['order_id'] ?></a></td>				
						<td><?php echo $order_info['date'] ?></td>
						<td>$<?php echo $order_info['price'] ?></td>
						<td><a class="add" value="<?php echo $order_info['order_id'] ?>"><input class="butn" type="button" value="Detail" style="cursor:pointer"/></a></td>
					  </tr>
			    <?php } ?>
			  
			</table>
		  </form>
		</div>
     <?php } 
          else 
          {
	           echo "<h3>You have no orders</h3>";
          }
     ?>
  </div>
  
  <div id="footer">
  Copyright &copy Yuanzheng Li
  </div>
 </div>
</body>