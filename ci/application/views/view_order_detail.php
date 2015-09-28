<?php
  session_start();
 /* include("connect.php");
  include("cartfunctions.php");*/
  if(!(isset($_SESSION['UId'])))
	{
	redirect('coolbook');
	}
  
  
?>
  
    <h1 style="color:#ec715a;font-weight:bold;">Order Detail</h1>
    <?php 
    
	  

		  if(isset($orderInfo))
	     {
	     	foreach($orderInfo as $order_info)	 
			{
	?> 
		  <table align="center" border=".5" cellpadding="2px" style="font: Verdana, Arial, Helvetica, sans-serif 11px bold;background-color:#333333; color:#FFFFFF;">
		    <tr><td>
		    <table style=" border-color:#FFFFFF; font: Verdana, Arial, Helvetica, sans-serif 11px bold;background-color:#333333; color:#FFFFFF;">
		    <tr><td>Order ID</td><td style="color:#333333; background-color:#FFFFFF;"><?php echo $order_info->order_id; ?></td></tr>
			<tr><td>Date</td><td style="color:#333333; background-color:#FFFFFF;"><?php echo htmlspecialchars($order_info->date); ?></td></tr>
			<tr><td>Shipping Address</td><td style="color:#333333; background-color:#FFFFFF; width:300; height:auto; "><?php echo htmlspecialchars($order_info->ship_adr); ?></td></tr>
		    <tr><td>Billing Address</td><td style="color:#333333; background-color:#FFFFFF; width:300; height:auto;"><?php echo htmlspecialchars($order_info->bill_adr); ?></td></tr>
			
			<tr><td>Payment Info</td><td style="color:#333333; background-color:#FFFFFF; width:300; height:auto;"><?php echo htmlspecialchars('***'.substr($order_info->card,12,4).substr($order_info->card,16)); ?></td></tr>
			<tr><td>Total</td><td style="color:#333333; background-color:#FFFFFF;">$<?php echo $order_info->price; ?></td></tr>
			</table>
			</td></tr>
			<tr><td>
			<table style="border-style:solid;border-width:3px;border-color:white; font: Verdana, Arial, Helvetica, sans-serif 11px bold;background-color:#333333; color:#FFFFFF;">
				<tr><td style="border:1px solid #FFFFFF;width:250px">Items</td>
				<td style="border:1px solid #FFFFFF;width:80px">Price</td>
				<td style="border:1px solid #FFFFFF;width:80px">Qty</td></tr>
			<?php 
				  
	            
			    //for every product in a order
			    foreach($order_item as $detail_info)
				{		
				  $pro_id = $detail_info->pro_id; 
				  $pro = "SELECT PName,Image FROM product,detail WHERE product.PId='$pro_id' and product.PId=detail.PId"; 
				  //get product info and detail
				  $res3 = $this->db->query($pro);
	              if($res3->num_rows() > 0)
		          {
			         foreach($res3->result() as $pro_detail)
			         {
				       
			         
			         
		          
				  
				  
				   //if($pro_detail=mysql_fetch_array($res3))
				  //{
			?>
			          <tr style="color:#333333; background-color:#FFFFFF;">
					  <td>
					  <div style="float:left;">
					  <img src="<?php echo $pro_detail->Image; ?>" width="100" height="auto"/>
					  </div>
					  <div style="float:left; width:150; height:auto; line-height:inherit;">
				      <?php echo $pro_detail->PName; ?></div></td>
				      <td>$<?php echo $detail_info->pro_price;?></td>
				      <td><?php echo $detail_info->pro_qty;?></td></tr>				
			        
			 <?php     }
					 }
			    } ?>	
			</table>	
			</td></tr>
			
		  </table>
		
	  <?php } 
	  
	  }?>
	  
		

    
  