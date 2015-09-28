<?php
  include("connect.php");
  include("cartfunctions.php");
  
  unset($_SESSION['visitedCheckout']);
  unset($_SESSION['visitedCart']);
  
  /*$sql = "SELECT DISTINCT PCate FROM product";
  $res = mysql_query($sql);
  $res2 = mysql_query($sql);
  $row=mysql_fetch_array($res);*/
 if(isset($_GET['command']) && isset($_GET['productid']))
 {
  if($_GET['command']=='add' && $_GET['productid']>0)
    {   
	    $proId=$_GET['productid'];
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
		//header("location:homepage.php");
		//exit();
	}
 }
?>


<head>
  <title>Homepage</title>
  <link rel="stylesheet" href="<?php echo base_url();?>application/views/homepage.css" type="text/css">
  <link rel="stylesheet" href="<?php echo base_url();?>application/views/fader.css" type="text/css">
  <script src="<?php echo base_url();?>application/views/fader.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
  <script>
  

	  $(document).ready(function(){
	  
	      //click different category, div#content will do ajax to catch matched page
		  $("#category li a").click(function(){
		      var cate = $(this).attr("value");
		      //alert(cate);
		      var selectCate={
		      	category: cate,
		      	ajax: '1'
		      };
			  //$.get("<?php //echo base_url();?>/application/views/showContent.php",
			  $.ajax({
			  url: "<?php echo site_url('coolbook/showCate');?>",
			  type: 'GET',
			  data: selectCate,
			  success: function(msg){
				  $("#content").html(msg); 
				 }
			  }); 
		  });
		  
		  //add to cart, reload the current page
		  $(".add").click(function(){
		      var id = $(this).attr("value");
			  $.get("<?php echo base_url();?>application/views/homepage.php",
			  {productid: id,
			   command: "add"},
			   function(data){
			   window.location.reload();
			  }); 
		  });		  
		  	  
		  
	  });
 
  /*
    var xmlhttp;
	function loadXMLDoc(url,func)
	  {
	  if(window.XMLHttpRequest)
	    {
		xmlhttp=new XMLHttpRequest();
		}
	  else
	    {
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
	  xmlhttp.onreadystatechange=func;
	  xmlhttp.open("GET",url,true);
	  xmlhttp.send();
	  }
    function showContent(str)
	  {
	  loadXMLDoc("showContent.php?category="+str,function()
	    {
		if(xmlhttp.readyState==4 && xmlhttp.status==200)
		document.getElementById("content").innerHTML=xmlhttp.responseText;
		})
	  }
	  
    function addtocart(proId)
	{
	  document.addcart.productid.value=proId;
	  document.addcart.command.value='add';
	  document.addcart.submit();
    }*/
  </script>
  
</head>

<body>


 <form name="addcart" method="get">
	<input type="hidden" name="productid" />
    <input type="hidden" name="command" />
 </form>
 
 <div id="container">
  <div id="header">
    

	 <?php 
	 if(isset($_SESSION['UId'])==true)
	   {	 
	 ?>
	   <ul style="margin-bottom:0;">
	   <li style="padding:5px 5px 5px 10px;"><a href="<?php echo site_url('coolbook');?>" style="font-size:29px;">COOLBOOK</a></li>
	   <li><a href="<?php echo site_url('coolbook/logout');?>" style="float:right;padding:0px 5px;">Logout</a></li>
	   <li><a href="<?php echo site_url('coolbook/account');?>" style="float:right;padding:0px 5px;">My Account</a></li>
	   <li><a href="<?php echo site_url('coolbook/shoppingCart');?>" style="float:right;padding:0px 5px;"><img src="/images/shopping_cart.png" width="35px" height="35px" alt="cart" style="vertical-align:top;">(<?php echo get_total_qty_db()?>)</a></li>
	  
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
	   <li><a href="<?php echo site_url('coolbook/shoppingCart');?>" style="float:right;padding:0px 5px;"><img src="/images/shopping_cart.png" width="35px" height="35px" alt="cart" style="vertical-align:top;">(<?php echo get_total_qty()?>)</a></li>
	   </ul>
	   <?php
	   }
	   ?>
    
  </div>

  <div id="category">
    <h2>&nbsp;</h2>
    <h2>Category</h2>
	<h2>&nbsp;</h2>
    <hr />
	
    <ul>
  
      <li><a href="#" style="cursor:pointer" value="specialsale">Special Sales</a></li>	
	
	  <?php if(isset($category)) : foreach ($category as $row): ?>	
		    <li><a href="#" name="sel_category" style="cursor:pointer" value="<?php echo $row->PCate; ?>"><?php echo $row->PCate; ?></a></li>	      
	  <?php  endforeach; ?>
	  <?php endif; ?>
	      
    </ul>
  </div>	

  <div id="content"> 
  
	  <div id="wrapper">
		<div style="display:inline;">
			<div class="slider-button" onClick="ss.move(-1)">
			  <p>&nbsp;</p>
			  <p>&nbsp;</p>
			  <p>&nbsp;</p>
			  <p>&nbsp;</p>
			  <p>&nbsp;</p>
			  <p>&nbsp;</p>
			  <p>&laquo;</p>
		    </div>
			<div id="slideshow">
				<ul id="slides">
					<li>
						<div class="caption">
							<img src="/images/InfernoS.jpg" width="720" height="350" alt="inferno">
							<div>
								<h2>Inferno</h2>
								<p>By Dan Brown</p>
								<p><a href="#" class="add" style="text-decoration:none; cursor:pointer;" value="6001"/>
								Add to cart now</a></p>
							</div>
						</div>
					</li>
					<li>
						<div class="caption">
							<img src="/images/the-ocean.jpg" width="720" height="350" alt="ocean">
							<div>
								<h2>The Ocean At The End of The Lane</h2>
								<p>By Neil Gaiman</p>
								<p><a href="#" class="add" style="text-decoration:none; cursor:pointer; " value="6005"/>
								Add to cart now</a></p>								
						  </div>
					  </div>
					</li>
					<li>
						<div class="caption">
							<img src="/images/Python_For_KidsS.png" width="720" height="350" alt="Python_For_Kids">
							<div>
								<h2>Python For Kids</h2>
								<p>By Jason Briggs</p>
								<p><a href="#" class="add" style="text-decoration:none; cursor:pointer;" value="3005"/>
								Add to cart now</a></p>										
							</div>
						</div>
					</li>
					<li>
						<div class="caption">
							<img src="/images/WonderS.jpg" width="720" height="350" alt="Wonder">
							<div>
								<h2>Wonder</h2>
								<p>By RJ Palacio</p>
								<p><a href="#" class="add" style="text-decoration:none; cursor:pointer;" value="2001"/>
								Add to cart now</a></p>									
							</div>
						</div>
					</li>				
				</ul>
			</div>
			<div class="slider-button" onClick="ss.move(1)">
			  <p>&nbsp;</p>
			  <p>&nbsp;</p>
			  <p>&nbsp;</p>
			  <p>&nbsp;</p>
			  <p>&nbsp;</p>
			  <p>&nbsp;</p>
			  <p>&raquo;</p>
			</div>
		</div>
		<ol id="pagination" class="pagination">
			<li></li>
			<li></li>
			<li></li>
			<li></li>
		</ol>
	</div>
		<script>
		var ss = new TINY.fader.init('ss', {
			id: 'slides',
			auto: 4,
			resume: true,
			navid: 'pagination',
			navEvent: 'mouseover',
			activeClass: 'current',
			pauseHover: true
		});
		</script>

	<br>
    <div class="clear"></div>
    <div id="subcontent">
    <h1 style="color:#ec715a;font-weight:bold;">Special Sales</h1>
    <?php if(isset($specialsales)) : foreach ($specialsales as $row): ?>	
	    <div class="specialsale">
		<img src="<?php echo $row->Image; ?>" width="120" height="auto"/><br>
		<span style="font-weight:bold;font-style:italic;"><?php echo $row->PName; ?></span><br>
		Original:<span style="color:green;text-decoration:line-through;">$<?php echo $row->PPrice; ?></span><br />
		Price:<span style="color:red">$<?php $row->SPrice; ?></span><br />
		Discount:<span style="color:red"><?php echo $row->Discount; ?></span><br />
		Start:<?php echo $row->Startdate; ?><br />
		End:<?php echo $row->Enddate; ?><br />
		<a class="add" value="<?php echo $row->PId; ?>"><input type="button" class="butn" value="Add to Cart" style="cursor:pointer;"/></a>	<br><br>
		</div>
	<?php endforeach; ?>
	<?php endif; ?>
    </div>
  </div>
  <div id="footer">
  Copyright &copy Yuanzheng Li
  </div>
 </div>
</body>