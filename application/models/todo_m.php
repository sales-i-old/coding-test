<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Todo_m extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getActiveList()
	{
		$this->db->where('complete', 0);
		$query = $this->db->get('to_do_list');
		$result = $query->result_array();

		return $result;
	}

	public function getInactiveList()
	{
		$this->db->where('complete',1);
		$query = $this->db->get('to_do_list');
		$result = $query->result_array();

		return $result;
	}

	public function addItem($item)
	{
		$data = array(
			'item_name' => $item,
			'complete'	=> 0
		);

		$this->db->insert('to_do_list', $data);

		return $this->affected();
	}
    
    public function getItem($id)
    {
        $this->db->where('id', $id);
		$query = $this->db->get('to_do_list');
		$result = $query->result_array();

		return $result[0];
    }
    
    public function editItem($id, $item)
    {
        $data = array(
            'item_name' => $item
        );
        
        $this->db->where('id', $id);
        $this->db->update('to_do_list', $data);
    }

	public function deleteItem($id)
	{
		$data = array('complete' => 1);
		$this->db->where('id', $id);
		$this->db->update('to_do_list', $data);

		return $this->affected();
	}

	public function reinstateItem($id)
	{
        $data = array('complete' => 0);
		$this->db->where('id', $id);
		$this->db->update('to_do_list', $data);

		return $this->affected();
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