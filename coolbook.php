<?php 

class Coolbook extends CI_Controller
{
	function index()
	{
	    //parent::Controller();
	    $data=array();
		$qCate=$this->homepage_model->getCategory();
		$qSpecial=$this->homepage_model->getSpecialsales();
		
		if($qCate || $qSpecial)
		{
			$data['category']=$qCate;
			$data['specialsales']=$qSpecial;
			
		}
		
		$this->load->view('homepage',$data);
	}
	
	function showCate()
	{
		$qCateSpecial=$this->homepage_model->getCateSpecialsales();
		$qSpecial=$this->homepage_model->getSpecialsales();
		$qCate=$this->homepage_model->getCategory();
		$qCateProduct=$this->homepage_model->getCateProducts();
		if ($this->input->get('ajax')) 
		{
			$data['catespecialsales']=$qCateSpecial;  
			$data['specialsales']=$qSpecial;
			$data['category']=$qCate;
			$data['cateproducts']=$qCateProduct;
			$this->load->view('showContent',$data);			
		} 
		
	}
	
	function checkCustomer()
	{
		$data=array();
		$this->load->model('login_model');
		$query=$this->login_model->validate();
		if($query)
		{
			$data['customer']=$query;

			
		}
		//$this->session->set_userdata($sessionData);
		$this->load->view('customerlogin',$data);
		
	}
	
	function signup()
	{
		$this->load->view('signup');
	}
	
	function createCustomer()
	{
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('UName', 'Username', 'trim|required|min_length[3]|max_length[20]');
		$this->form_validation->set_rules('UPass', 'Password', 'trim|required|min_length[3]|max_length[20]');
		$this->form_validation->set_rules('CPass', 'Password Confirmation', 'trim|required|matches[UPass]');
		$this->form_validation->set_rules('FName', 'First Name', 'trim|required');
		$this->form_validation->set_rules('LName', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('UPhone', 'Phone Number', 'trim|required|numeric|exact_length[10]');
		$this->form_validation->set_rules('UAddress', 'Address', 'trim|required');
		$this->form_validation->set_rules('UEmail', 'Email Address', 'trim|required|valid_email');
		$this->form_validation->set_rules('UZip', 'Zip Code', 'trim|required|numeric|exact_length[5]');
		
		
		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('signup');
		}
		
		else
		{			
			$this->load->model('login_model');
			$query = $this->login_model->exist_customer();
			if(!($query))
			{
				$this->login_model->create_customer();  
				$data = array(
				'username' => $this->input->post('UName')
				);
				$this->load->view('signup_success', $data);
			}
			else
			{
			    $data['exist']=1;
				$this->load->view('signup',$data);			
			}
			 
			 
		}
	}
	
	function logout()
	{
		$this->load->view('customerlogout');
	}
	
	function account()
	{
		/*$data=array();
		$query=$this->homepage_model->getCustomerInfo();
		if($query)
		{
			$data['cus_info']=$query;
		}
		 
		 */
		$this->load->view('viewinfo');
	}
	
	function editProfile()
	{
		$this->load->view('edit_profile');
	}
	
	function saveEditProfile()
	{
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('UName', 'Username', 'trim|required|min_length[3]|max_length[20]');
		$this->form_validation->set_rules('FName', 'First Name', 'trim|required');
		$this->form_validation->set_rules('LName', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('UPhone', 'Phone Number', 'trim|required|numeric|exact_length[10]');
		$this->form_validation->set_rules('UAddress', 'Address', 'trim|required');
		$this->form_validation->set_rules('UEmail', 'Email Address', 'trim|required|valid_email');
		$this->form_validation->set_rules('UZip', 'Zip Code', 'trim|required|numeric|exact_length[5]');
		
		
		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('edit_profile');
		}
		
		else
		{			
			$this->load->model('login_model');
			$query = $this->login_model->changeUsername();
			if(!($query))
			{
				$this->login_model->updateProfile();  
				$data = array(
				'username' => $this->input->post('UName'),
				//'updateSuccess'=>1
				);
				$this->load->view('edit_profile_success', $data);
			}
			else
			{
				$query1 = $this->login_model->exist_customer();
				if($query1)
				{
					$data['exist']=1;
				    $this->load->view('edit_profile',$data);	
				}
				else 
				{
					$this->login_model->updateProfile();  
				    $data = array(
				    'username' => $this->input->post('UName'),
				    //'updateSuccess'=>1
				    );
				    $this->load->view('edit_profile_success', $data);
				}
			    		
			}
			 
			 
		}
		//$this->load->view('edit_profile');
	}

    function changePassword()
	{
		$this->load->view('change_pw');
	}
	
	function savePassword()
	{
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('UPass', 'Password', 'trim|required|min_length[3]|max_length[20]');
		$this->form_validation->set_rules('CPass', 'Password Confirmation', 'trim|required|matches[UPass]');
		if($this->form_validation->run() == false)
		{
			$this->load->view('change_pw');
		}
		else
	    {
			$this->load->model('login_model');
			$query = $this->login_model->oldPasswordMatch();
			if($query)
			{
				$this->login_model->updatePassword();
				$this->load->view('change_pw_success');
				
			}
			else 
			{
				$data['nonmatch']=1;
				$this->load->view('change_pw',$data);
			}
		}
		
	}
	
	function viewOrder()
	{
		$this->load->view('view_order');
	}
	
	function showOrderDetail()
	{
		$data=array();
		$qOrder=$this->homepage_model->getOrderInfo();
		$qOrderItem=$this->homepage_model->getOrderItem();
		//$qItemDetail=$this->homepage_model->getItemDetail();
		
		if($this->input->get('ajax'))
		{
			$data['orderInfo']=$qOrder;
			$data['order_item']=$qOrderItem;
			//$data['item_detail']=$qItemDetail;
			$this->load->view('view_order_detail',$data);
		}
		
	}
	
	function checkout()
	{
		$this->load->view('check');
	}
	
	function shoppingCart()
	{
		$this->load->view('shopcart');
	}
	
	function orderSuccessful()
	{
		$this->load->view('orderSuccess');
	}
}
?>