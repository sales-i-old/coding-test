<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Todo extends CI_Controller
{
	private $data = array();

	public function __construct()
	{
		ini_set('display_errors', '1');
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('todo_m');
	}

	public function index()
	{

		/*
		 * Handle the post of the new form. Check and send to DB
		 */
		if($this->input->post())
		{
			$this->form_validation->set_rules('add_item', 'Item Name', 'required');

			if($this->form_validation->run())
			{
				// Save to DB
				$success = $this->todo_m->add_item($this->input->post('add_item'));

				if($success == true)
				{
					redirect('/');
				}
			}
		}

		$this->data['active_list'] = $this->todo_m->get_active_list();
		$this->data['inactive_list'] = $this->todo_m->get_inactive_list();
		$this->load->view('list', $this->data);
	}

	public function edit()
	{

	}

	public function complete($id)
	{
		// Validate ID

		// Update DB
		$success = $this->todo_m->delete_item($id);
		if($success == true)
		{
			redirect('/');
		}
		else
		{
			// The DB wasn't updated
		}
	}


}

/* End of file todo.php */
/* Location: ./application/controllers/todo.php */