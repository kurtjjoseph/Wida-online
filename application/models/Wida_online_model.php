<?php


class Wida_online_model  extends CI_Model  {

    public $title;
    public $content;
    public $date;

	public function get_last_entry()
	{
		$last = $this->db->order_by('id',"desc")
			->limit(1)
			->get('wida_allsongs')
			->row();
		return $last;
	}

    public function get_last_ten_entries()
    {
		$last = $this->db->order_by('id',"desc")
			->limit(10)
			->get('wida_allsongs')
			->result();
		return $last;
    }
	public function getSong($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('wida_allsongs');
		return $query->row();
	}

	public function getSongs()
	{
		$list = $this->db->order_by('Title',"Asc")
			->select("`id`, `Title`,`Tempo`, `Time`, `Key`, `YoutubeLink`")
			->get('wida_allsongs')
			->result();
		return $list;
	}


}
