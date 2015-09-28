<?php
  include("connect.php");
  //header("Content-Type: text/html;charset=utf-8");
  
  //$sql = "SELECT DISTINCT PCate FROM product";
  //$res = mysql_query($sql);
  $getCategory=$this->input->get('category');
  
   ?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script>
     $(document).ready(function(){

		  $(".add").click(function(){
		      var id = $(this).attr("value");
		      
			  $.get("<?php echo site_url('coolbook');?>",
			  {productid: id,
			   command: "add"},
			   function(data){
			   window.location.reload();
			  }); 
		  });		  
		  	  
	  });
</script>	  
	  
	  
	  
	  <?php
  
   if(isset($category)) : foreach ($category as $row):
    
      if($getCategory==$row->PCate)
      {
	  //$sql = "SELECT * FROM product p,detail d WHERE PCate='$getCategory' AND p.PId=d.PId";
	  //$sql2 = "SELECT * FROM product p,detail d,specialsale s WHERE PCate='$getCategory' AND p.PId=d.PId AND p.PId=s.PId";
      //$res = mysql_query($sql);
	  //$res2 = mysql_query($sql2);
	  //$res3 = mysql_query($sql2);
	  
	 
	  if(isset($catespecialsales))
	    { ?>
	    <h1 style="color:#ec715a;font-weight:bold;">Special Sales for <?php echo $getCategory?></h1>
	  <?php
	    foreach ($catespecialsales as $row):
		 ?>
		 <div class="specialsale">
	      <img src="<?php echo $row->Image; ?>" width="80" height="auto"/><br>
		  <span style="font-weight:bold;font-style:italic;"><?php echo $row->PName; ?></span><br>
		  Original:<span style="color:green;text-decoration:line-through;">$<?php echo $row->PPrice; ?></span><br />
		  Price:<span style="color:red">$<?php echo $row->SPrice; ?></span><br />
		  Discount:<span style="color:red"><?php echo $row->Discount; ?></span><br />
		  Start:<?php echo $row->Startdate; ?><br />
		  End:<?php echo $row->Enddate; ?><br />
		  <a class="add" value="<?php echo $row->PId; ?>"><input type="button" class="butn" value="Add to Cart" style="cursor:pointer;" /></a>	<br><br>	
	     </div>
		 <div style="clear:both;"> </div>
		 <?php
         endforeach;
		}
		 ?>
		 
	  <h1 style="color:#ec715a;font-weight:bold;"><?php echo $getCategory?></h1>
	  <?php
	  if(isset($cateproducts))
	    {
	    	foreach ($cateproducts as $row): 
	    	?> 
			<div class="specialsale">
			<img src="<?php echo $row->Image; ?>" width="120" height="auto"/><br>
			<span style="font-weight:bold;font-style:italic;"><?php echo $row->PName; ?></span><br>
			Price:<span style="color:red">$
			<?php 
		    $spe = $row->PId;
			$get_special = mysql_query("SELECT SPrice FROM specialsale WHERE PId = $spe");
			$row1= mysql_fetch_array($get_special);
            if($row1) 
			{
			echo $row1['SPrice'];
			}
			else 
		    echo $row->PPrice;
		    ?></span><br />	
            <a class="add" value="<?php echo $row->PId; ?>"><input type="button" class="butn" value="Add to Cart" style="cursor:pointer;"/></a><br><br>			
			</div>
		<?php 
		endforeach;
		}
	  }?>
   <?php endforeach; ?>
   <?php endif; ?>
	<?php
    if ($getCategory=='specialsale')
    { ?>
	<h1 style="color:#ec715a;font-weight:bold;">Special Sales</h1>
	<?php if(isset($specialsales)) : foreach ($specialsales as $row): ?>	
	    <div class="specialsale">
		<img src="<?php echo $row->Image; ?>" width="120" height="auto"/><br>
		<span style="font-weight:bold;font-style:italic;"><?php echo $row->PName; ?></span><br>
		Original:<span style="color:green;text-decoration:line-through;">$<?php echo $row->PPrice; ?></span><br />
		Price:<span style="color:red">$<?php echo $row->SPrice; ?></span><br />
		Discount:<span style="color:red"><?php echo $row->Discount; ?></span><br />
		Start:<?php echo $row->Startdate; ?><br />
		End:<?php echo $row->Enddate; ?><br />
		<a class="add" value="<?php echo $row->PId; ?>"><input type="button" class="butn" value="Add to Cart" style="cursor:pointer;"/></a>	<br><br>
		</div>
	<?php endforeach; ?>
	<?php endif; ?>
	 <?php }  ?>
	

	
