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

	public function getNewSong()
	{
		$data = array(
			'Title' => '',
		);
		$this->db->insert('wida_allsongs',$data);
		return $this->getSong($this->db->insert_id());
	}

	public function getSongs()
	{
		$list = $this->db->order_by('Title',"Asc")
			->select("`id`, `Title`,`Tempo`, `Time`,`Text`, `Key`, `Author`, `YoutubeLink`")
			->get('wida_allsongs')
			->result();
		return $list;
	}


	public function saveSong($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('wida_allsongs', $data);
		return $this->getSong($id);
	}



	public function get_last_entry_songlist()
	{
		$last = $this->db->order_by('id',"desc")
			->limit(1)
			->get('wida_song_list')
			->row();
		return $last;
	}

	public function get_last_ten_entries_songlist()
	{
		$last = $this->db->order_by('id',"desc")
			->limit(10)
			->get('wida_song_list')
			->result();
		return $last;
	}
	public function getPlaylist($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('wida_song_list');
		return $query->row();
	}

	public function getNewPlaylist()
	{
		$data = array(
			'Title' => '',
		);
		$this->db->insert('wida_song_list',$data);
		return $this->getPlaylist($this->db->insert_id());
	}

	public function getPlaylists()
	{
		$list = $this->db->order_by('Title',"Asc")
			->select("`id`, `Title`,`Listtext`, `UserID`, `DateUpdated`, `DateScheduled`")
			->get('wida_song_list')
			->result();
		return $list;
	}


	public function savePlaylist($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('wida_song_list', $data);
		return $this->getPlaylist($id);
	}






	public function getChord($spelling)
	{
		$this->db->where('spelling', $spelling);
		$query = $this->db->get('wida_chords');
		return $query->row();
	}

	public function getChords()
	{
		$list = $this->db->order_by('Name',"Asc")
			->get('wida_chords')
			->result();
		return $list;
	}


}
