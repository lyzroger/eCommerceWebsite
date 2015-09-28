<?php
  session_start();
  session_unset();
  session_destroy();
?>  

<html>
<head>
<link rel="stylesheet" href="<?php echo base_url(); ?>application/views/shopcart.css" type="text/css"/>
<title>CoolBook</title>
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

      <fieldset style="border-radius:8px; width:350px; margin-left:350; margin-top:100;">
      <legend style="color:#FFFFFF;"><b>Logout Successfully</b></legend>
	    <div class="field">
		 You can go back to <a style='text-decoration:none;color:blue;' href ='<?php echo site_url('coolbook'); ?>'>Homepage</a> or <a style='text-decoration:none;color:blue;' href ='<?php echo site_url('coolbook/checkCustomer'); ?>'>Login</a> again!
		
		</div>

      </fieldset>
	</form>


  </div>
  
  <div id="footer">
  Copyright &copy Yuanzheng Li
  </div>


 </div>

</body>


</html>
