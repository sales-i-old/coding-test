<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Todo extends CI_Controller
{
	private $data = array();

	public function __construct()
	{
		parent::__construct();
        
		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->load->helper('url');
        $this->load->helper('messages');
		$this->load->model('todo_m');
        $this->flashdataToArray();
	}

	public function index()
	{
		if($this->input->post())
		{
			$this->form_validation->set_rules('add_item', 'Item Name', 'required');

			if($this->form_validation->run() === true)
			{
				$success = $this->todo_m->addItem($this->input->post('add_item'));
                
                if($success === true)
                {
                    $this->session->set_flashdata('message', array('success' => ADD_SUCCESS));
                }
                else
                {
                    $this->session->set_flashdata('message', array('error' => ADD_ERROR));
                }
                redirect('/');
			}
		}

		$this->data['active_list'] = $this->todo_m->getActiveList();
		$this->data['inactive_list'] = $this->todo_m->getInactiveList();
        
        $this->load->view('partials/header');
		$this->load->view('list', $this->data);
        $this->load->view('partials/footer');
	}

	public function edit($id = false)
	{
        if($this->validID($id) === false)
        {
            $this->session->set_flashdata('message', array('error' => EDIT_ID_ERROR));
            redirect('/');
        }
        else
        {
            if($this->input->post())
            {
                $this->form_validation->set_rules('id', 'ID', 'required|is_natural_no_zero');
                $this->form_validation->set_rules('edit_item', 'Item Name', 'required');

                if($this->form_validation->run() === true)
                {
                    $success = $this->todo_m->editItem($this->input->post('id'), $this->input->post('edit_item'));
                    
                    if($success === true)
                    {
                        $this->session->set_flashdata('message', array('success' => EDIT_SUCCESS));
                    }
                    else
                    {
                        $this->session->set_flashdata('message', array('error' => EDIT_ERROR));
                    }
                    redirect('/');
                }
            }
            
            $this->data['item'] = $this->todo_m->getItem($id);
            $this->load->view('partials/header');
            $this->load->view('edit', $this->data);
            $this->load->view('partials/footer');
        }
	}

	public function complete($id = false)
	{
        if($this->validID($id) === false)
        {
            $this->session->set_flashdata('message', array('error' => COMPLETE_ID_ERROR));
        }
        else
        {
            $success = $this->todo_m->deleteItem($id);
            if($success == true)
            {
                $this->session->set_flashdata('message', array('success' => COMPLETE_SUCCESS));
            }
            else
            {
                $this->session->set_flashdata('message', array('error' => COMPLETE_ERROR));
            }
        }
        redirect('/');
	}
    
    public function reinstate($id = false)
    {
        if($id === false || is_numeric($id) === false)
        {
            $this->session->set_flashdata('message', array('error' => REINSTATE_ID_ERROR));
        }
        else
        {
            $success = $this->todo_m->reinstateItem($id);
            if($success === true)
            {
                $this->session->set_flashdata('message', array('success' => REINSTATE_SUCCESS));
            }
            else
            {
                $this->session->set_flashdata('message', array('error' => REINSTATE_ERROR));
            }
        }
        redirect('/');
    }
    
    private function flashdataToArray()
    {
        $allData = $this->session->all_userdata();
        
        if(array_key_exists('flash:old:message', $allData) && count($allData['flash:old:message']) > 0)
        {
            foreach($allData['flash:old:message'] as $key => $value)
            {
                $this->data['messages'][$key] = $value;
            }
        }
    }
    
    private function validID($id)
    {
        if($id === false || is_numeric($id) === false)
        {
            return false;
        }
        
        return true;
    }
}

/* End of file todo.php */
/* Location: ./application/controllers/todo.php */