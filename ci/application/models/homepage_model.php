<?php

class Homepage_model extends CI_Model
{
	
	function getCategory()
	{
		$sql = "SELECT DISTINCT PCate FROM product";
		$res= $this->db->query($sql);
	    if($res->num_rows()>0)
		{
			foreach($res->result() as $row)
			{
				$cate[]=$row;
			}
			return $cate;
		}
	}
	
	function getSpecialsales()
	{
		$special = "SELECT * FROM product, specialsale, detail WHERE product.PId=specialsale.PId and product.PId = detail.PId";
		$resSpecial = $this->db->query($special);
		if($resSpecial->num_rows()>0)
		{
			foreach($resSpecial->result() as $row)
			{
				$specialSales[]=$row;
			}
			return $specialSales;
		}
	}
	
	function getCateSpecialsales()
	{
		//if(isset($_GET['category']))
		//{
		$getCategory=$this->input->get('category');
		$cateSpecial = "SELECT * FROM product p,detail d,specialsale s WHERE PCate='$getCategory' AND p.PId=d.PId AND p.PId=s.PId";
		$resSpecial = $this->db->query($cateSpecial);
		if($resSpecial->num_rows()>0)
		{
			foreach($resSpecial->result() as $row)
			{
				$cateSpecialSales[]=$row;
			}
			return $cateSpecialSales;
		}
		//}
	}
	
	function getCateProducts()
	{
		$getCategory=$this->input->get('category');
		$sql = "SELECT * FROM product p,detail d WHERE PCate='$getCategory' AND p.PId=d.PId";
		$res= $this->db->query($sql);
		if($res->num_rows()>0)
		{
			foreach($res->result() as $row)
			{
				$cateProducts[]=$row;
			}
			return $cateProducts;
		}
	}
	
	/*function checkIfSpecial()
	{
		$this->getCateProducts();
		if(isset($cateProducts))
		{
			$specialID=$cateProducts->PId;
			$get_special="SELECT SPrice FROM specialsale WHERE PId = $specialID";
			$res=$this->db->query($get_special);
			if($res->num_rows()>0)
			{
			
			}
		}
	}
	
	function checkSame()
	{   
		$query=$this->db->get('product');
	}*/
	
	/*function getCustomerInfo()
	{
		$this->load->model('login_model');
		$this->login_model->validate();
		
			$userid=$customer->UId;
			$this->db->where('UId',$userid);
			$query=$this->db->get('customers');
			if($query->num_rows == 1)
			{
				foreach($query->result() as $row)
				{
					$customer[]=$row;
				}
				return $customer;
			}
		
		
	}
	 
	 */
	 
	 function getOrderInfo()
	 {
	 	$oid=$this->input->get('orderid');
		$general = "SELECT * FROM orders WHERE order_id = '$oid'";
		$res = $this->db->query($general);
		if($res->num_rows() > 0)
		{
			foreach($res->result() as $row)
			{
				$orderInfo[]=$row;
			}
			return $orderInfo;
		}
	 }
	 
	 function getOrderItem()
	 {
	 	$oid=$this->input->get('orderid');
		$detail = "SELECT * FROM order_item WHERE order_id = '$oid'";
        $res = $this->db->query($detail);
		if($res->num_rows() > 0)
		{
			foreach($res->result() as $row)
			{
				$orderItem[]=$row;
			}
			return $orderItem;
		}
	 }
	 
	 /*function getItemDetail()
	 {
	 	
	 	$qItems=$this->getOrderItem();
		foreach($qItems as $query)
		{
		$pid=$query->pro_id;
		$pro = "SELECT PName,Image FROM product,detail WHERE product.PId='$pid' and product.PId=detail.PId"; 
		$res = $this->db->query($pro);
		if($res->num_rows() > 0)
		{
			foreach($res->result() as $row)
			{
				$ItemDetail[]=$row;
			}
			return $ItemDetail;
		}
		}
	 }
	  */
	 
	 
}
?>