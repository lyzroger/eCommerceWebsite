<?php

	function add_exists_item($proId)
	{
	
		$items=count($_SESSION['cart']);
		$exist=0;
		for($i=0;$i<$items;$i++)
		{
			if($proId==$_SESSION['cart'][$i]['productid']){		
				$exist=1;
				$_SESSION['cart'][$i]['qty']+=1;
				break;
			}
		}
		return $exist;
	}
	
	function addtocart($proId,$qty)
	{
		if($proId<1 or $qty<1) return;
		
		if(isset($_SESSION['cart']))
		{
			if(add_exists_item($proId)) return;
			$items=count($_SESSION['cart']);
			$_SESSION['cart'][$items]['productid']=$proId;
			$_SESSION['cart'][$items]['qty']=$qty;
		}
		else{
			$_SESSION['cart']=array();
			$_SESSION['cart'][0]['productid']=$proId;
			$_SESSION['cart'][0]['qty']=$qty;
		}
	}	
	
	function get_item_name($proId)
	{
		$result=mysql_query("SELECT PName FROM product WHERE PId=$proId") or die("SELECT PName FROM product WHERE PId=$proId".mysql_error());
		$row=mysql_fetch_array($result);
		return $row['PName'];
	}
	
		function get_item_image($proId)
	{
		$result=mysql_query("SELECT Image FROM detail WHERE PId=$proId") or die("SELECT Image FROM detail WHERE PId=$proId".mysql_error());
		$row=mysql_fetch_array($result);
		return $row['Image'];
	}
	
	
	function get_item_price($proId)
	{   
	    $result=mysql_query("SELECT PPrice FROM product WHERE PId=$proId") or die("SELECT PPrice FROM product WHERE PId=$proId".mysql_error());
		$row=mysql_fetch_array($result);
		$get_special = mysql_query("SELECT SPrice FROM specialsale WHERE PId = $proId") or die("SELECT SPrice FROM product WHERE PId=$proId".mysql_error());
	    $row2= mysql_fetch_array($get_special);
        if($row2) 
		  {
		  return $row2['SPrice'];
		  }
		  else 
		  return $row['PPrice'];
	}
	
	function remove_one_item($proId)
	{
		
		$items=count($_SESSION['cart']);
		for($i=0;$i<$items;$i++){
			if($proId==$_SESSION['cart'][$i]['productid']){
				unset($_SESSION['cart'][$i]);
				break;
			}
		}
		$_SESSION['cart']=array_values($_SESSION['cart']);
	}
	
	function get_total_price()
	{
		$items=count($_SESSION['cart']);
		$sum=0;
		for($i=0;$i<$items;$i++){
			$proId=$_SESSION['cart'][$i]['productid'];
			$qty=$_SESSION['cart'][$i]['qty'];
			$price=get_item_price($proId);
			$sum+=$price*$qty;
		}
		return $sum;
	}
	
	function get_total_qty()
	{  if(isset($_SESSION['cart']))
	   {
		$items=count($_SESSION['cart']);
		$sum=0;
		for($i=0;$i<$items;$i++){
			$qty=$_SESSION['cart'][$i]['qty'];
			$sum+=$qty;
		}
		return $sum;
	   }
	}
	
	function get_total_price_db()
	{
	  $userid=$_SESSION['UId'];
	  $sql="SELECT * FROM shopcart WHERE UId='$userid'";
	  $res=mysql_query($sql);
	  $sum=0;
	  while($row=mysql_fetch_array($res))
	   {  
		  $price=$row['PPrice'];
		  $qty=$row['Qty'];
		  $sum+=$price*$qty;	  
	   }
	  return $sum;
	}
	
	function get_total_qty_db()
	{
	  $userid=$_SESSION['UId'];
	  $sql="SELECT * FROM shopcart WHERE UId='$userid'";
	  $res=mysql_query($sql);
	  $sum=0;
	  while($row=mysql_fetch_array($res))
	   {  
		  $qty=$row['Qty'];
		  $sum+=$qty;	  
	   }
	  return $sum;
	}

?>