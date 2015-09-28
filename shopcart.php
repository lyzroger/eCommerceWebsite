<?php
	include("connect.php");
	include("cartfunctions.php");
	
	unset($_SESSION['visitedCheckout']);

   $msg="";
if(isset($_GET['command']))
{	
	if($_GET['command']=='remove' && $_GET['proId']>0){
		
		if(isset($_SESSION['UId']))
		  {
		    $proId=$_GET['proId'];
		    $uid=$_SESSION['UId'];
		    $sql="DELETE FROM shopcart WHERE PId='$proId' AND UId='$uid'";
		    $res=mysql_query($sql);
		  }
		else
		  {
		    remove_one_item($_GET['proId']);
		  }
	}
	else if($_GET['command']=='clear')
	{
		if(isset($_SESSION['UId']))
		  {
		    $uid=$_SESSION['UId'];
		    $sql="DELETE FROM shopcart WHERE UId='$uid'";
		    $res=mysql_query($sql);
		  }
		else
		  {
		  unset($_SESSION['cart']);
		  }
	}
	else if($_GET['command']=='update')
	{   
	  if(isset($_SESSION['UId']))
		{
		  $uid=$_SESSION['UId'];
		  $all="SELECT * FROM shopcart WHERE UId='$uid'";
		  $resAll=mysql_query($all);
		  while($row=mysql_fetch_array($resAll))
		    {
			  $proId=$row['PId'];
			  $qty=$_GET['product'.$proId];
			  $sql="UPDATE shopcart SET Qty='$qty' WHERE UId='$uid' AND PId='$proId'";
		      $res=mysql_query($sql);
			}
		  
		}
	  else
	    {
		  $items=count($_SESSION['cart']);
		  for($i=0;$i<$items;$i++)
		  {
			 $proId=$_SESSION['cart'][$i]['productid'];
			 $qty=$_GET['product'.$proId];
			 if($qty>0 && $qty<=999)
			 {
			 	$_SESSION['cart'][$i]['qty']=$qty;
			 }
			 else
			 {
				$msg='Proudcts not updated! Quantity must be a number between 1 and 999';
			 }
		  }
		}
	}
	
if($_GET['command']=='add' && $_GET['proId']>0)
    {   
	    $proId=$_GET['proId'];
		if(isset($_SESSION['UId']))
		{
		  $uid=$_SESSION['UId'];
		  $SId=session_id();
		  $price=get_item_price($proId);
		  $checkSame="SELECT * FROM shopcart WHERE UId='$uid' AND PId='$proId'";
		  $resSame=mysql_query($checkSame);
		  if($row=mysql_fetch_array($resSame))
		    {
		      $resSame2=mysql_query($checkSame);
		      $row2=mysql_fetch_array($resSame2);
		      $qty=$row2['Qty'];
		      $qty+=1;
		      $sql="UPDATE shopcart SET Qty='$qty' WHERE UId='$uid' AND PId='$proId'";
		      $res=mysql_query($sql);
		    }
		  else
		    {
		      $qty=1;
		      $sql="INSERT INTO shopcart (PId, Qty, PPrice, UId, SId) VALUES ('$proId','$qty','$price','$uid','$SId')";
		      $res=mysql_query($sql);
		    }
		}
		else
		{
		  addtocart($proId,1);
		}
		//header("location:shopcart.php");
		//exit();
	}
}
?>
<html>
<head>
<link rel="stylesheet" href="<?php echo base_url();?>application/views/shopcart.css" type="text/css">
<title>Shopping Cart</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script language="javascript">

 $(document).ready(function(){
 
	 var form = $("#manageCart");
	 var command = $("#command");
	 
	// update cart  
    form.submit(function(){
	     command.val("update");
	});
	 
     $(".remove").click(function(){
		      var id = $(this).attr("value");
			  $.get("<?php echo site_url('coolbook/shoppingCart');?>",
			  {proId: id,
			   command: "remove"},
			   function(data){
			       $("body").html(data);
			  }); 
		  });	
      $(".clear").click(function(){
			  $.get("<?php echo site_url('coolbook/shoppingCart');?>",
			  {command: "clear"},
			   function(data){
			       $("body").html(data);
			  }); 
		  });
		  
		  
	   //add to cart, reload the current page
	   $(".add").click(function(){
		     var id = $(this).attr("value");
			 $.get("<?php echo site_url('coolbook/shoppingCart');?>",
			 {proId: id,
			  command: "add"},
		      function(data){
			  //window.location.reload();
			  $("body").html(data);
			 }); 
	    });			  
  });		  
 /*
	function rmv(proId)
	{
	
			document.manageCart.proId.value=proId;
			document.manageCart.command.value='remove';
			document.manageCart.submit();
		
	}
	function clear_cart()
	{
		
			document.manageCart.command.value='clear';
			document.manageCart.submit();
		
	}
	function update()
	{
		document.manageCart.command.value='update';
		document.manageCart.submit();
	}
    function addtocart(proId)
	{
	  document.manageCart.proId.value=proId;
	  document.manageCart.command.value='add';
	  document.manageCart.submit();
    }
*/
</script>
</head>

<body>


 <div id="container">
  <div id="header">
    
	<?php 
	
	$_SESSION['visitedCart']=1;
	
	 if(isset($_SESSION['UId'])==true)
	   {	 
	 ?>
	   <ul style="margin-bottom:0;">
	   <li style="padding:5px 5px 5px 10px;"><a href="<?php echo site_url('coolbook');?>" style="font-size:29px;">COOLBOOK</a></li>
	   <li><a href="<?php echo site_url('coolbook/logout');?>" style="float:right;padding:0px 5px;">Logout</a></li>
	   
	   <li><a href="<?php echo site_url('coolbook/account');?>" style="float:right;padding:0px 5px;">My Account</a></li>
	   <li><a href="<?php echo site_url('coolbook');?>" style="float:right;padding:0px 5px;">Continue Shopping</a></li>
	   </ul>
	   <?php
	   }
	   else
	   {
	   ?>
	   <ul style="margin-bottom:0;">
	   <li style="padding:5px 5px 5px 10px;"><a href="<?php echo site_url('coolbook');?>" style="font-size:29px;">COOLBOOK</a></li>
	   <li><a href="<?php echo site_url('coolbook/signup');?>" style="float:right;padding:0px 5px;">Sign Up</a></li>
	   <li><a href="<?php echo site_url('coolbook/checkCustomer');?>" style="float:right;padding:0px 5px;">Login</a></li>
	   <li><a href="<?php echo site_url('coolbook');?>" style="float:right;padding:0px 5px;">Continue Shopping</a></li>
	   </ul>
	   <?php
	   }
	   ?>	 
    
  </div>
  
  <div id="content"> 
	  <form name="manageCart" id="manageCart" method="get">
	  <input type="hidden" name="proId" id="proId"/>
	  <input type="hidden" name="command" id="command" />
		<div class="header">
			<h1 style="color:#ec715a;font-weight:bold;">Your Shopping Cart</h1>
			
		</div>
			<div style="color:red"><?php echo $msg?></div>
			<table style="border:0;cellpadding:4px;cellspacing:2px; width:850px;" align="center">
			<?php 
			if(!(isset($_SESSION['UId'])))
			  {
			  	
				
			    if(isset($_SESSION['cart']))
				{ ?>
				<tr style="font-weight:bold;color:#ffffff;">
				<td>Item</td><td>Name</td><td>Price</td><td>Qty</td><td>Amount</td><td>Options</td></tr>
			<?php
					$items=count($_SESSION['cart']);
					for($i=0;$i<$items;$i++)
					{
						$proId=$_SESSION['cart'][$i]['productid'];
						$qty=$_SESSION['cart'][$i]['qty'];
						$pname=get_item_name($proId);
						if($qty==0) continue;
				?>
						<tr style="background-color:#ffffff;width:35%;">
						<td><?php echo $i+1?></td>
						<td><?php echo $pname?></td>
						<td width="10%">$ <?php echo get_item_price($proId)?></td>
						<td><input type="text" name="product<?php echo $proId?>" value="<?php echo $qty?>" maxlength="3" size="2" /></td>                    
						<td width="10%">$ <?php echo get_item_price($proId)*$qty?></td>
						<td width="15%"><a class="remove" value="<?php echo $proId?>"><input type="button" class="butn" value="Remove"/></a></td></tr>
				<?php      			
					}
					$goCheck=site_url('coolbook/checkout');
				?>
					<tr style="font-weight:bold;color:#ffffff;"><td><b>Order Total: $<?php echo get_total_price()?></b></td><td colspan="5" align="right">
					<input type="button" class="butn clear" id="clear" value="Clear Cart">
					<input type="submit" class="butn" id="update" value="Update Cart">
					<input type="button" class="butn" value="Place Order" onClick="window.location='<?php echo $goCheck; ?>'"></td></tr>
				<?php
				}
				
				else
				 {
					echo "<tr bgColor='#FFFFFF'><td>No item in your shopping cart.</td>";
				 }
			  }
			else
			  {
			    $userid=$_SESSION['UId'];
			    $cart="SELECT * FROM shopcart WHERE UId='$userid'";
			    $resCart=mysql_query($cart);
				$resCart2=mysql_query($cart);
			if($row2=mysql_fetch_array($resCart2))
			  {
				$i=1;
			    while($row=mysql_fetch_array($resCart))
			      {  
				    $proId=$row['PId'];
				    $qty=$row['Qty'];
					$pname=get_item_name($proId);
					
				  ?>
					<tr style="background-color:#ffffff;width:35%;">
					<td><?php echo $i?></td>
					<td><?php echo $pname?></td>
					<td width="10%">$ <?php echo get_item_price($proId)?></td>
					<td><input type="text" name="product<?php echo $proId?>" id="product<?php echo $proId?>" value="<?php echo $qty?>" maxlength="3" size="2" /></td>                    
					<td width="10%">$ <?php echo get_item_price($proId)*$qty?></td>
					<td width="15%"><a class="remove" value="<?php echo $proId?>"><input type="button" class="butn" value="Remove"/></a></td></tr>
				<?php 
                    $i++;     			
				   }
				  $goCheck=site_url('coolbook/checkout');
				?>
					<tr style="font-weight:bold;color:#ffffff;"><td><b>Order Total: $<?php echo get_total_price_db()?></b></td><td colspan="5" align="right">
					<input type="button" class="butn clear" id="clear" value="Clear Cart" />
					<input type="submit" class="butn" id="update" value="Update Cart"/>
					<input type="button" class="butn" value="Place Order" onClick="window.location='<?php echo $goCheck; ?>'"/></td></tr>
				<?php
			  }
			else
				  {
					 echo "<tr bgColor='#FFFFFF'><td>No item in your shopping cart.</td>";
				  }

			  }
			?>
			</table>
			
			<div>
			<?php
			if(isset($_SESSION['UId']))
			  { 
			     $relPro=array();
				 $items=0;
				 $uid=$_SESSION['UId'];
				 $getPId="SELECT * FROM shopcart WHERE UId='$uid'";
				 $resPId=mysql_query($getPId);
				 $resPId2=mysql_query($getPId);
				 while($rowPId=mysql_fetch_array($resPId))
				   {
				     $proId=$rowPId['PId'];
					 $getOId="SELECT DISTINCT order_id FROM order_item WHERE pro_id='$proId'";
					 $resOId=mysql_query($getOId);
					 while($rowOId=mysql_fetch_array($resOId))
					   {
					     $oid=$rowOId['order_id'];
						 $getproId="SELECT DISTINCT pro_id FROM order_item WHERE order_id='$oid' AND pro_id NOT LIKE '$proId'";
						 $resproId=mysql_query($getproId);
						 $resproId2=mysql_query($getproId);
						 if($rowproId2=mysql_fetch_array($resproId2))
						   {
			
			                 
			                 while($rowproId=mysql_fetch_array($resproId))
							   {
							     $relPro[$items]=$rowproId['pro_id'];
								 $items++;
							   }
							}
						}
					}
		    
							 while($rowPId2=mysql_fetch_array($resPId2))
							   {
							     $proId=$rowPId2['PId'];
								 foreach(array_keys($relPro,"$proId") as $key)
								   {
								     unset($relPro[$key]);
								   }
								 
							   }
							   
							 $relPro2=array_values(array_unique($relPro));
							 $max=count($relPro2);
							 if($max)
							 {
			?>
						     <div class="header">
			                 <h3 style="color:#ec715a;font-weight:bold;">Customers Who Bought These Books Also Bought</h3>
			                 </div>
			<?php
							 for($i=0;$i<$max;$i++)
							   {
							     $getRel="SELECT * FROM product p, detail d WHERE p.PId='$relPro2[$i]' AND p.PId=d.PId";
								 $resRel=mysql_query($getRel);
								 $rowRel=mysql_fetch_array($resRel);
								   
								     $proImg=$rowRel['Image'];
									 $proName=$rowRel['PName'];
									 $getSpecial=mysql_query("SELECT SPrice FROM specialsale WHERE PId = $relPro2[$i]");
									 
									 if($rowSpecial=mysql_fetch_array($getSpecial))
									   {
									     $proPrice=$rowSpecial['SPrice'];
									   }
									 else
									   {
									     $proPrice=$rowRel['PPrice'];
									   }
									 ?>
									 <div class="relate">
									 <img src="<?php echo $proImg?>" width="100" height="auto"/><br>
		                             <span style="font-weight:bold;font-style:italic;"><?php echo $proName?></span><br>
		                             Price:<span style="color:red">$<?php echo $proPrice?></span><br />
									 <a class="add" value="<?php echo $relPro2[$i] ?>"><input type="button" class="butn" value="Add to Cart" /></a><br>
									 </div>
									 
									 <?php
								   
							   }
							  }
			  }
			else
			  {
			     if(isset($_SESSION['cart']))
				 {
				 $relPro=array();
				 $dis=0;
				 $items=count($_SESSION['cart']);
					for($i=0;$i<$items;$i++)
					{
					 $proId=$_SESSION['cart'][$i]['productid'];
					 $getOId="SELECT DISTINCT order_id FROM order_item WHERE pro_id='$proId'";
					 $resOId=mysql_query($getOId);
					 while($rowOId=mysql_fetch_array($resOId))
					   {
					     $oid=$rowOId['order_id'];
						 $getproId="SELECT DISTINCT pro_id FROM order_item WHERE order_id='$oid' AND pro_id NOT LIKE '$proId'";
						 $resproId=mysql_query($getproId);
						 $resproId2=mysql_query($getproId);
						 if($rowproId2=mysql_fetch_array($resproId2))
						   {
			                 while($rowproId=mysql_fetch_array($resproId))
							   {
							     $relPro[$dis]=$rowproId['pro_id'];
								 $dis++;
							   }
							}
						}
					}
		    
							 for($i=0;$i<$items;$i++)
							   {
							     $proId=$_SESSION['cart'][$i]['productid'];
								 foreach(array_keys($relPro,"$proId") as $key)
								   {
								     unset($relPro[$key]);
								   }
								 
							   }
							 $relPro2=array_values(array_unique($relPro));
							 $max=count($relPro2);
							 if($max)
							 {
			?>
						     <div class="header">
			                 <h3 style="color:#ec715a;font-weight:bold;">Customers Who Bought These Books Also Bought</h3>
			                 </div>
			<?php
							 for($i=0;$i<$max;$i++)
							   {
							     $getRel="SELECT * FROM product p, detail d WHERE p.PId='$relPro2[$i]' AND p.PId=d.PId";
								 $resRel=mysql_query($getRel);
								 $rowRel=mysql_fetch_array($resRel);
								   
								     $proImg=$rowRel['Image'];
									 $proName=$rowRel['PName'];
									 $getSpecial=mysql_query("SELECT SPrice FROM specialsale WHERE PId = $relPro2[$i]");
									 
									 if($rowSpecial=mysql_fetch_array($getSpecial))
									   {
									     $proPrice=$rowSpecial['SPrice'];
									   }
									 else
									   {
									     $proPrice=$rowRel['PPrice'];
									   }
									 ?>
									 <div class="relate">
									 <img src="<?php echo $proImg?>" width="100" height="auto"/><br>
		                             <span style="font-weight:bold;font-style:italic;"><?php echo $proName?></span><br>
		                             Price:<span style="color:red">$<?php echo $proPrice?></span><br />
									 <a class="add" value="<?php echo $relPro2[$i] ?>"><input type="button" class="butn" value="Add to Cart" /></a>	<br>
									 </div>
									 
									 <?php
							   }
							  }
				 }
			  }
			
			?>
			</div>
	  </form>
  </div>
  
  <div id="footer">
  Copyright &copy Yuanzheng Li
  </div>
  
 </div>
</body>
</html>