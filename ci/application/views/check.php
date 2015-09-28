<?php
	include("connect.php");
	include("cartfunctions.php");

	
	unset($_SESSION['visitedCart']);
	$_SESSION['visitedCheckout']=1;
	if(isset($_POST['command']))
	{
	if($_POST['command']=='update')
	{
	
	    $id = $_SESSION['UId'];
		$price=get_total_price_db();
		$address='Name:'.$_POST['name'].' <br>Address:'.$_POST['address'].', '.$_POST['userzip'].' <br>Phone:'.$_POST['phone'];
		$b_address='Name:'.$_POST['bname'].'<br>Address:'.$_POST['baddress'].', '.$_POST['buserzip'].' <br>Phone:'.$_POST['bphone'];
		$card=$_POST['payment_card'].", ".$_POST['payment_name'].", ".$_POST['payment_exp_mon']."/".$_POST['payment_exp_year'];
		$date=date('Y-m-d');
		
		$result=mysql_query("insert into orders(order_id, cus_id, bill_adr, ship_adr, date, price, card) values('','$id','$b_address','$address','$date','$price','$card')");

		$order_id=mysql_insert_id();
		
		
			$res=mysql_query("select * from shopcart where UId='$id'");
		while($row=mysql_fetch_array($res))
		{
			$pid=$row['PId'];
			$q=$row['Qty'];
			$price=get_item_price($pid);
			mysql_query("insert into order_item(order_id, pro_id, pro_qty, pro_price) values ($order_id,$pid,$q,$price)");
			mysql_query("delete from shopcart where UId='$id'");
		}
	   
		 redirect('coolbook/orderSuccessful');
	}
	
	}
	
?>	
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link rel="stylesheet" href="<?php echo base_url();?>application/views/shopcart.css" type="text/css">
<title>Check Out</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script language="javascript">

var imgq="<img src='/images/question_symbol.png' width=20px height=16px align='absmiddle' hspace='2'>";

$(document).ready(function(){

	//global vars
	var form = $("#checkform");
	var command = $("#command");
	var name = $("#name");
	var nameInfo = $("#na");
	var bname = $("#bname");
	var bnameInfo = $("#bna");	
	var phone = $("#phone");
	var phoneInfo = $("#ph");	
	var bphone = $("#bphone");
	var bphoneInfo = $("#bph");	
	var add = $("#address");
	var addInfo = $("#add");	
	var badd = $("#baddress");
	var baddInfo = $("#badd");	
    var zip = $("#userzip");
	var zipInfo = $("#zip");
    var bzip = $("#buserzip");
	var bzipInfo = $("#bzip");
	var payname = $("#payment_name");
	var paynameInfo = $("#pn");
	var paycard = $("#payment_card");
	var paycardInfo = $("#pc");
	var paymon = $("#payment_exp_mon");
	var payyear = $("#payment_exp_year");
	var payInfo = $("#pe");	
	var error = $("#bill_err");


    //On blur
	name.blur(validateName);
	bname.blur(validateBName);
	bphone.blur(validateBPhone);
	phone.blur(validatePhone);
	add.blur(validateAdd);
	badd.blur(validateBAdd);
	zip.blur(validateZip);
	bzip.blur(validateBZip);
	payname.blur(validatePName);
	paycard.blur(validatePCard);
	paymon.blur(validatePDate);
	payyear.blur(validatePDate);



//validation functions
    function validateName(){
		//if it's NOT valid
		if(name.val().length ==0){
			nameInfo.html(imgq);
			error.html("Fill in shipping name, please.");
			return false;
		}
		//if it's valid
		else{
			nameInfo.html("");
			error.html("");
			return true;
		}
	}
	
    function validateBName(){
		//if it's NOT valid
		if(bname.val().length ==0){
			bnameInfo.html(imgq);
			error.html("Fill in billing name, please.");
			return false;
		}
		//if it's valid
		else{
			nameInfo.html("");
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
	
    function validateBPhone(){
		//if it's NOT valid
		if(bphone.val().length ==0){
			bphoneInfo.html(imgq);
			error.html("Fill in your phone number, please.");
			return false;
		}
		else if(bphone.val().length !=10){
			bphoneInfo.html(imgq);
			error.html("Should be 10 numbers, please.");
			return false;
		}
		//if it's valid
		else{
			bphoneInfo.html("");
			error.html("");
			return true;
		}
	}
	
    function validateAdd(){
		//if it's NOT valid
		if(add.val().length ==0){
			addInfo.html(imgq);
			error.html("Fill in shipping address, please.");
			return false;
		}
		else if(add.val().length<10){
			addInfo.html(imgq);
			error.html("Fill in valid shipping address, please.");
			return false;
		}
		//if it's valid
		else{
			addInfo.html("");
			error.html("");
			return true;
		}
	}

    function validateBAdd(){
		//if it's NOT valid
		if(badd.val().length ==0){
			baddInfo.html(imgq);
			error.html("Fill in billing address, please.");
			return false;
		}
		else if(badd.val().length<10){
			baddInfo.html(imgq);
			error.html("Fill in valid billing address, please.");
			return false;
		}
		//if it's valid
		else{
			baddInfo.html("");
			error.html("");
			return true;
		}
	}
	
	function validateZip(){
		//if it's NOT valid
		if(zip.val().length ==0){
			zipInfo.html(imgq);
			error.html("Fill in shipping zip code, please.");
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
	
    function validateBZip(){
		//if it's NOT valid
		if(bzip.val().length ==0){
			bzipInfo.html(imgq);
			error.html("Fill in billing zip code, please.");
			return false;
		}
		else if(bzip.val().length!=5){
			bzipInfo.html(imgq);
			error.html("Should be 5 numbers, please.");
			return false;
		}
		//if it's valid
		else{
			bzipInfo.html("");
			error.html("");
			return true;
		}
	}

    function validatePName(){
		//if it's NOT valid
		if(payname.val().length ==0){
			paynameInfo.html(imgq);
			error.html("Fill in card name, please.");
			return false;
		}
		//if it's valid
		else{
			paynameInfo.html("");
			error.html("");
			return true;
		}
	}
	
    function validatePCard(){
		//if it's NOT valid
		if(paycard.val().length ==0){
			paycardInfo.html(imgq);
			error.html("Fill in card number, please.");
			return false;
		}
		else if(paycard.val().length!=16){
			paycardInfo.html(imgq);
			error.html("Should be 16 numbers, please.");
			return false;
		}
		//if it's valid
		else{
			paycardInfo.html("");
			error.html("");
			return true;
		}
	}
	
    function validatePDate(){
		//if it's NOT valid
		if(paymon.val().length ==0||payyear.val().length ==0){
			payInfo.html(imgq);
			error.html("Choose your card expired information, please.");
			return false;
		}
		else if(payyear.val()==2013 & paymon.val()<8){
			payInfo.html(imgq);
			error.html("Change a valid card, please.");
			return false;
		}
		//if it's valid
		else{
			payInfo.html("");
			error.html("");
			return true;
		}
	}	

    //On Submitting
    form.submit(function(){	

        if(validateName() && validateBName() && validatePhone() && validateBPhone() && validateAdd() && validateBAdd() && validateZip() && validateBZip() && validatePName() && validatePCard() && validatePDate()){

		$("#command").val("update");
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
		
		<?php 
		 if(isset($_SESSION['UId'])==true)
		   {	 
		 ?>
		   <ul style="margin-bottom:0;">
		   <li style="padding:5px 5px 5px 10px;"><a href="<?php echo site_url('coolbook');?>" style="font-size:29px;">COOLBOOK</a></li>
		   <li><a href="<?php echo site_url('coolbook/logout');?>" style="float:right;padding:0px 5px;">Logout</a></li>
		   <li><a href="<?php echo site_url('coolbook');?>" style="float:right;padding:0px 5px;">Continue Shopping</a></li>
		   <li><a href="<?php echo site_url('coolbook/account');?>" style="float:right;padding:0px 5px;">My Account</a></li>
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
	  <?php 
	  if(isset($_SESSION['UId']))
	  {	    
	  $id = $_SESSION['UId'];
	  
	  $get_cus=mysql_query("select * from customers where UId='$id'") or die("select * from customers where UId='$id'".mysql_error());
	  $get_cus_cess=mysql_fetch_array($get_cus);
	  }
	  ?>
	    <form name="checkform" id="checkform" method="post">
			<input type="hidden" name="command" id="command"/>
			<h1 style="color:#ec715a;font-weight:bold;">Review your order</h1>
			
			
			<table name="outer_tb" style="border:0;cellpadding:4px;cellspacing:2px;" align="center"><tr><td width="668">
			
				<table name="cus_detail_tb">
				
					<tr style="font-weight:bold;color:#ffffff; background-color:#000000">
					<td>Shipping address</td><td>Billing address</td></tr>
					<tr>
					  <!--Shipping address-->
					  <td>
						  <table name="shiping_tb" style="border:0;cellpadding:2px;cellspacing:1px; background-color:#d8d8d8; width:330;">
							<tr><td>Name:</td>
							<td>
							<input type="text" name="name" id="name" value="<?php if(isset($_SESSION['UId'])) {echo htmlspecialchars($get_cus_cess['FName']." ".$get_cus_cess['LName']);} ?>"/>
							<span id="na"></span></td></tr>
							<tr><td>Address:</td>
							<td>
							<input type="text" name="address" id="address" value="<?php if(isset($_SESSION['UId'])) {echo htmlspecialchars($get_cus_cess['UAddress']);} ?>"/>
							<span id="add"></span></td></tr>
							<tr><td>Zip:</td>
							<td>
							<input type="text" name="userzip" id="userzip" value="<?php if(isset($_SESSION['UId'])) {echo htmlspecialchars($get_cus_cess['UZip']);} ?>"/>
							<span id="zip"></span></td></tr>
							<tr><td>Phone:</td>
							<td>
							<input type="text" name="phone" id="phone" value="<?php if(isset($_SESSION['UId'])) {echo htmlspecialchars($get_cus_cess['UPhone']);} ?>"/>				
							<span id="ph"></span></td>
							</tr>
						  </table>
					  </td>
					  <!--billing address-->
					  <td>
						  <table name="billing_tb" style="border:0;cellpadding:2px;cellspacing:1px; background-color:#d8d8d8; width:330;">
							<tr><td>Name:</td>
							<td>
							<input type="text" name="bname" id="bname" value="<?php if(isset($_SESSION['UId'])) {echo htmlspecialchars($get_cus_cess['FName']." ".$get_cus_cess['LName']);} ?>" />
							<span id="bna"></span></td></tr>
							<tr><td>Address:</td>
							<td>
							<input type="text" name="baddress" id="baddress" value="<?php if(isset($_SESSION['UId'])) {echo htmlspecialchars($get_cus_cess['UAddress']);} ?>"/>
							<span id="badd"></span></td></tr>
							<tr><td>Zip:</td>
							<td>
							<input type="text" name="buserzip" id="buserzip" value="<?php if(isset($_SESSION['UId'])) {echo htmlspecialchars($get_cus_cess['UZip']);} ?>"/>
							<span id="bzip"></span></td></tr>
							<tr><td>Phone:</td>
							<td>
							<input type="text" name="bphone" id="bphone" value="<?php if(isset($_SESSION['UId'])) {echo htmlspecialchars($get_cus_cess['UPhone']);} ?>"/>				
							<span id="bph"></span></td>
							</tr>
						  </table>
					  </td>
					</tr>	
					
					<!--Payment information-->
					<tr style="font-weight:bold;color:#ffffff; background-color:#000000;">
					  <td>Payment information</td></tr>
					<tr>
					  	
					  <td><span style="color:#CCCCCC;">Enter your card information:</span>
					  
					      <table name="pay_tb" style="border:0;cellpadding:2px;cellspacing:1px; background-color:#d8d8d8; width:330;">
						    <tr><td>Card number:</td>
							<td><input type="text" name="payment_card" id="payment_card" maxlength="16" /><span id="pc"></span></td>
							</tr>
							<tr><td>Name on card:</td>
							<td><input type="text" name="payment_name" id="payment_name" maxlength="20"/><span id="pn"></span></td>
							</tr>
							<tr><td>Expiration date:</td>
							<td>
							    Month
							    <select name="payment_exp_mon" id="payment_exp_mon">
								<option></option>
							    <option value="1">1</option>
							    <option value="2">2</option>
							    <option value="3">3</option>
							    <option value="4">4</option>
							    <option value="5">5</option>
							    <option value="6">6</option>
							    <option value="7">7</option>
							    <option value="8">8</option>
							    <option value="9">9</option>
							    <option value="10">10</option>
							    <option value="11">11</option>
							    <option value="12">12</option>
								</select>														
							    year
								<select name="payment_exp_year" id="payment_exp_year">
								<option></option>
								  <script>
									  var myDate = new Date();
									  var year = myDate.getFullYear();
									  for(var i = year;i<2031;i++){
										  document.write('<option value="'+i+'">'+i+'</option>');
									  }
								  </script>
							    </select><span id="pe"></span>
							</td>
							</tr>
						  </table>					  
					  </td>	
					  <td>
						 <span id="bill_err" style="color:#ec715a; font:bold; text-align:center;"></span>
					  </td>				
					</tr>
                    <tr style="font-weight:bold;color:#ffffff;">
					<td><b>Order Total: $<?php if(isset($_SESSION['UId']))
					                              echo get_total_price_db();
											   else
					                              echo get_total_price();?></b></td>
					<td colspan="5" align="right">
					<?php 
					if(isset($_SESSION['UId']))
					  {
					?>
						<input class="butn" type="submit" value="Place Order" /></td></tr>
					<?php
					  }
					else
					  {
					  	$backLogin=site_url('coolbook/checkCustomer');
					?>
					     <input class="butn" type="button" value="Please Login" onClick="window.location='<?php echo $backLogin; ?>'" /></td></tr>
					<?php
					  }
					?>
				</table>
				
		        </td></tr>
				<tr><td>
		
			
				<table width="673">
				<?php 
				if(!(isset($_SESSION['UId'])))
				{
				    if(isset($_SESSION['cart']))
				    { ?>
					<tr style="font-weight:bold;color:#ffffff; background-color:#000000;">
					<td>Item</td><td width="71">Qty</td>
					<td>Amount</td></tr>
				<?php
						$items=count($_SESSION['cart']);
						for($i=0;$i<$items;$i++){
							$proId=$_SESSION['cart'][$i]['productid'];
							$qty=$_SESSION['cart'][$i]['qty'];
							$pname=get_item_name($proId);
							$pimage=get_item_image($proId);
							if($qty==0) continue;
					?>
							<tr style="background-color:#d8d8d8;">
							<td width="515">
							<div style="float:left">
							<img src="<?php echo $pimage?>" width="80" height="auto"/><br>
							</div>
							<div style="float:left">
							<?php echo $pname?><br>
							$ <?php echo get_item_price($proId)?></div>
							</td>
							<td><?php echo $qty?></td>                    
							<td width="71">$ <?php echo get_item_price($proId)*$qty?></td>
					<?php					
						}
						$backShop=site_url('coolbook/shoppingCart');
					?>
						<tr style="font-weight:bold;color:#ffffff;"><td><b>Order Total: $<?php echo get_total_price()?></b></td><td colspan="5" align="right">
						<input class="butn" type="button" value="Edit" onClick="window.location='<?php echo $backShop; ?>'"/></td></tr>
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
				      
			          while($row=mysql_fetch_array($resCart))
			            {  
				          $proId=$row['PId'];
				          $qty=$row['Qty'];
					      $pname=get_item_name($proId);
						  $pimage=get_item_image($proId);
				        ?>
						  <tr style="background-color:#d8d8d8;">
						  <td width="515">
						  <div style="float:left">
						  <img src="<?php echo $pimage?>" width="80" height="auto"/><br>
						  </div>
						  <div style="float:left">
						  <?php echo $pname?><br>
						  $ <?php echo get_item_price($proId)?></div>
						  </td>
						  <td><?php echo $qty?></td>                    
						  <td width="71">$ <?php echo get_item_price($proId)*$qty?></td>
						  <?php
						  }
						$backShop=site_url('coolbook/shoppingCart');
						  ?>
						  <tr style="font-weight:bold;color:#ffffff;"><td><b>Order Total: $<?php echo get_total_price_db()?></b></td><td colspan="5" align="right">
						  <input class="butn" type="button" value="Edit" onClick="window.location='<?php echo $backShop; ?>'"/></td></tr>
				    <?php
					}
				else
				  {
					 echo "<tr bgColor='#FFFFFF'><td>No item in your shopping cart.</td>";
				  }
						  
				  
				}
				?>
				</table>
				
				
				</tr></td>
		    </table>	
					
	     </form>
	   </div>
	
	   <div id="footer">
	   Copyright &copy Yuanzheng Li
	   </div>     
	   
  </div>
</body>
</html>