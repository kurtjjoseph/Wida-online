<?php


class Wida_Online
{
	var $ci;
	var $wom;
	var $config = array();

	public function __construct()
	{
		$ci = &get_instance();
		$ci->load->model('wida_online_model');
		$this->loadConfig();
	}

	public function getNextService()
	{
		$wom = new Wida_online_model();
		$event =  $wom->get_last_entry_event();

		$event->bezetting = $wom->getBezetting($event->bezettingID);
		$event->dresscode = $wom->getDresscode($event->dresscodeID);
		$event->songlist = $wom->getPlaylist($event->songlistID);

		return $event;
	}

	public function lastSong()
	{
		$wom = new Wida_online_model();
		return $wom->get_last_entry();

	}

	public function latestSongs()
	{
		$wom = new Wida_online_model();
		return $wom->get_last_ten_entries();

	}

	public function getSong($id)
	{
		$wom = new Wida_online_model();
		return $wom->getSong($id);

	}

	public function getNewSong()
	{
		$wom = new Wida_online_model();
		return $wom->getNewSong();

	}

	public function getSongs($full = false)
	{
		$wom = new Wida_online_model();
		$songset =  $wom->getSongs($full);
		$songlist = array();

		foreach ($songset as $song) {
			$songlist[$song->id]= $song;
		}

		return $songlist;

	}

	public function saveSong($id, $songdata)
	{
		$wom = new Wida_online_model();

		return $wom->saveSong($id,$songdata);

	}

	public function getChord($spelling)
	{
		$wom = new Wida_online_model();
		return $wom->getChord($spelling);

	}

	public function getChords()
	{
		$wom = new Wida_online_model();
		return $wom->getChords();

	}

//Playlists


	public function lastPlaylist()
	{
		$wom = new Wida_online_model();
		return $wom->get_last_entry_songlist();

	}

	public function latestPlaylists()
	{
		$wom = new Wida_online_model();
		return $wom->get_last_ten_entries_songlist();

	}

	public function getPlaylist($id)
	{
		$wom = new Wida_online_model();

		$playlist  =  $wom->getPlaylist($id);

		if(isset($playlist->songIds)){
			$playlist->playlistsongs  = json_decode($playlist->songIds);


		}

		return $playlist;
	}

	public function getNewPlaylist()
	{
		$wom = new Wida_online_model();
		return $wom->getNewPlaylist();

	}

	public function getPlaylists()
	{
		$wom = new Wida_online_model();
		return $wom->getPlaylists();

	}

	public function savePlaylist($id, $playlistdata)
	{
		$wom = new Wida_online_model();

		return $wom->savePlaylist($id,$playlistdata);

	}


	public function getUsers($full = false)
	{
		$wom = new Wida_online_model();
		return $wom->getUsers($full);

	}


	public function loadConfig(){

		$templateName = "material";

		$this->config["js_files"] = array();
		$this->config["css_files"] = array();
		$this->config["pagetitle"] ="Wida Online";
		$this->config["scriptdir"] ="/wida-online/assets/$templateName/";
		$this->config["templatescripts"] ="templates/$templateName/templatescripts";
		$this->config["pagescripts"] ="templates/$templateName/pagescripts";
		$this->config["logo"] ="templates/$templateName/logo";
		$this->config["navbar"]["top"] ="templates/$templateName/navbar";
		$this->config["navbar"]["main"] ="templates/$templateName/navbar_main";
		$this->config["breadcrumb"] ="templates/$templateName/breadcrumb";
		$this->config["content"] ="templates/$templateName/content";
		$this->config["body"] ="templates/$templateName/body";
		$this->config["html_header"] ="templates/$templateName/html_header";
		$this->config["html_footer"] ="templates/$templateName/html_footer";
		$this->config["bootstrap"] ="templates/$templateName/bootstrap";


		$pages =  array();
		$pages['Overzicht'] = 'Home';

		$this->config["pages"] = $pages;



	}

}
