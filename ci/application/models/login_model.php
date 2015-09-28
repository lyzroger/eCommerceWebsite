<?php

class Login_model extends CI_Model
{
	function validate()
	{
		$this->db->where('UName',$this->input->post('username'));
		$this->db->where('UPass',$this->input->post('pw'));
		$query=$this->db->get('customers');
		if($query->num_rows==1)
		{
			foreach($query->result() as $row)
			{
				$customer[]=$row;
			}
			return $customer;
		}
	}
	
	function exist_customer()
	{
		$name=$this->input->post('UName');
		$same=$this->db->query("SELECT UName FROM customers WHERE UName='$name'");
		if($same->num_rows > 0)
		return true;
	}
	
	function create_customer()
	{
		$new_customer = array(	
			'UName' => $this->input->post('UName'),
			'UPass' => $this->input->post('UPass'),
			'FName' => $this->input->post('FName'),
			'LName' => $this->input->post('LName'),
			'UEmail' => $this->input->post('UEmail'),	
			'UAddress' => $this->input->post('UAddress'),
			'UPhone' => $this->input->post('UPhone'),	
			'UZip' => $this->input->post('UZip')						
		);
		
		$insert = $this->db->insert('customers', $new_customer);
		return $insert;
	}
	
	function changeUsername()
	{
		$name=$this->input->post('UName');
		$id=$this->input->post('UId');
		$change=$this->db->query("SELECT UName FROM customers WHERE UId='$id'");
		if($change->num_rows()>0)
		{
			foreach($change->result() as $row)
			{
				if($name!=$row->UName)
			    {
				return true;
			    }
			    else
			    {
				return false;
			    }
			}
			
		}
	}
	
	function updateProfile()
	{
		$id=$this->input->post('UId');
		$update = array(	
			'UName' => $this->input->post('UName'),
			//'UPass' => $this->input->post('UPass'),
			'FName' => $this->input->post('FName'),
			'LName' => $this->input->post('LName'),
			'UEmail' => $this->input->post('UEmail'),	
			'UAddress' => $this->input->post('UAddress'),
			'UPhone' => $this->input->post('UPhone'),	
			'UZip' => $this->input->post('UZip')						
		);
		$this->db->where('UId',$id);
		$updateSuccess=$this->db->update('customers',$update);
		return $updateSuccess;
	}
	
	function oldPasswordMatch()
	{
		$id=$this->input->post('UId');
		$opw=$this->input->post('OPass');
		$get_pw=$this->db->query("SELECT UPass FROM customers WHERE UId='$id'");
		if($get_pw->num_rows() >0)
		{
			foreach($get_pw->result() as $row)
			{
				if($opw==$row->UPass)
				{
					return true;
				}
				else 
				{
					return false;
				}
			}
		}
	}
	
	function updatePassword()
	{
		$id=$this->input->post('UId');
		$update = array(	
			
			'UPass' => $this->input->post('UPass'),
								
		);
		$this->db->where('UId',$id);
		$updateSuccess=$this->db->update('customers',$update);
		return $updateSuccess;
	}
}
