<?php


class wida_online
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

	public function getSongs()
	{
		$wom = new Wida_online_model();
		return $wom->getSongs();

	}


	public function loadConfig(){

		$this->config["js_files"] = array();
		$this->config["css_files"] = array();
		$this->config["pagetitle"] ="Wida Online";
		$this->config["scriptdir"] ="/wida-online/assets/bootstrap/";
		$this->config["templatescripts"] ="templates/Bootstrap/templatescripts";
		$this->config["pagescripts"] ="templates/Bootstrap/pagescripts";
		$this->config["navbar"] ="templates/Bootstrap/navbar";
		$this->config["breadcrumb"] ="templates/Bootstrap/breadcrumb";
		$this->config["content"] ="templates/Bootstrap/content";
		$this->config["body"] ="templates/Bootstrap/body";
		$this->config["html_header"] ="templates/Bootstrap/html_header";
		$this->config["html_footer"] ="templates/Bootstrap/html_footer";
		$this->config["bootstrap"] ='templates/Bootstrap/bootstrap';


		$pages =  array();
		$pages['Overzicht'] = 'Home';

		$this->config["pages"] = $pages;



	}

}
