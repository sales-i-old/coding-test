<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Todo_m extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function get_active_list()
	{
		$this->db->where('complete', 0);
		$query = $this->db->get('to_do_list');
		$result = $query->result_array();

		return $result;
	}

	public function get_inactive_list()
	{
		$this->db->where('complete',1);
		$query = $this->db->get('to_do_list');
		$result = $query->result_array();

		return $result;
	}

	public function add_item($item)
	{
		$data = array(
			'item_name' => $item,
			'complete'	=> 0
		);

		$this->db->insert('to_do_list', $data);

		return $this->affected();
	}

	public function delete_item($id)
	{
		$data = array('complete' => 0);
		$this->db->where('id', $id);
		$this->db->update('to_do_list', $data);

		return $this->affected();
	}

	public function reinstate_item()
	{

	}

	private function affected()
	{
		if($this->db->affected_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

}

/* End of file todo_m.php */
/* Location: ./application/models/todo_m.php */