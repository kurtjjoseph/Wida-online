<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Playlists extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('grocery_CRUD');
		$this->load->library('Wida_Online');
		// load Breadcrumbs
		$this->load->library('breadcrumbs');
		$this->load->helper('url');
	}

	public function index()
	{
		$wida = new Wida_Online();

		$viewScope = array();

		$contentdata = $this->render_content($viewScope);

		$viewScope['js_files'] = $contentdata['js_files'];
		$viewScope['css_files'] = $contentdata['css_files'];
		$viewScope['content'] = $this->load->view($wida->config['content'], (array)$contentdata, true);


		$viewScope['breadcrumbdata'] = $this->render_breadcrumb($viewScope);
		$viewScope['breadcrumb'] = $this->load->view($wida->config['breadcrumb'], $viewScope, true);


		$viewScope['js_files'] = $viewScope['js_files'] + $wida->config['js_files'];
		$viewScope['css_files'] = $viewScope['css_files'] + $wida->config['css_files'];
		$viewScope['pagetitle'] = "Playlists";
		$viewScope['pagelink'] = "/playlists";
		$viewScope['pageaddlink'] = "playlists/add";
		$viewScope['scriptdir'] = $wida->config['scriptdir'];

		$viewScope['templatescripts'] = $this->load->view($wida->config['templatescripts'], $viewScope, true);
		$viewScope['pagescripts'] = $this->load->view($wida->config['pagescripts'], $viewScope, true);
		$viewScope['logo'] = $this->load->view($wida->config['logo'], $viewScope, true);
		$viewScope['navbar']["top"] = $this->load->view($wida->config['navbar']["top"], $viewScope, true);
		$viewScope['navbar']["main"] = $this->load->view($wida->config['navbar']["main"], $viewScope, true);
		$viewScope['body'] = $this->load->view($wida->config['body'], $viewScope, true);
		$viewScope['html_header'] = $this->load->view($wida->config['html_header'], $viewScope, true);
		$viewScope['html_footer'] = $this->load->view($wida->config['html_footer'], $viewScope, true);

		$this->load->view($wida->config['bootstrap'], $viewScope);
	}

	public function render_content($viewScope)
	{
		$output = array();

		$output["js_files"] = array();
		$output["js_files"][] = "/wida-online/assets/common/js/views/playlistsView.js";
		$output["css_files"] = array();
		$output["output"] = $this->playlists();


		return $output;
	}

	public function render_breadcrumb($viewScope)
	{
		$output = array();
		$output["output"] = "";

		$this->breadcrumbs = new Breadcrumbs();

		// add breadcrumbs
		$this->breadcrumbs->push('Playlists', '/playlists');


		// output
		$output["output"] = $this->breadcrumbs->show();
		return $output;
	}

	public function playlists_management()
	{
		$crud = new grocery_CRUD();
		$crud->set_table('wida_song_list');
		$crud->set_subject('Playlists');
		$output = $crud->render();
		return $output;
	}

	public function playlist($index)
	{
		$viewScope = array();
		$wida = new Wida_Online();
		$data = array();
		$data["selectedplaylist"] = $wida->getplaylist($index);
		$viewScope['content'] = $this->load->view('selectedplaylist', $data, true);

		$viewScope['pagetitle'] = "Playlists";
		$viewScope['pagelink'] = "/playlists";
		$viewScope['pageaddlink'] = "/playlists/add";
		$viewScope["css_files"] = array();
		$viewScope["js_files"] = array();
		$viewScope["js_files"][] = "/wida-online/assets/common/js/views/playlistView.js";

		$this->breadcrumbs = new Breadcrumbs();

		// add breadcrumbs
		$this->breadcrumbs->push('Playlists', '/playlists');
		$this->breadcrumbs->push($data['selectedplaylist']->title, '/playlist');
		// output
		$viewScope["breadcrumbdata"]["output"] = $this->breadcrumbs->show();

		$this->render($viewScope);
	}

	public function save($index)
	{
		$viewScope = array();
		$wida = new Wida_Online();

		//(`id`, `title`, `userID`, `dateUpdated`, `dateScheduled`, `listtext`, `description`, `eventId`)

		$array = $this->input->post("playlistsongs");
		$newArray = array();
		if(!empty($array)){

			foreach (array_keys($array) as $fieldKey) {
				foreach ($array[$fieldKey] as $key => $value) {
					$newArray[$key][$fieldKey] = $value;
				}
			}


		}
		print_r($array);
		print_r($newArray);
		$playlistdata = array(

			'title' => $this->input->post('title'),
			'userID' => $this->input->post('userID'),
			'dateScheduled' => $this->input->post('dateScheduled'),
			'listtext' => $this->input->post('listtext'),
			'description' => $this->input->post('description'),
			'eventId' => $this->input->post('eventId'),
			'songIds' => json_encode ($newArray),
			'Data' => $this->input->post('Data'),
			'Text' => $this->input->post('Text')
		);

		$data["selectedplaylist"] = $wida->saveplaylist($index, $playlistdata);
		$viewScope['savedplaylist'] = true;

//		$viewScope['content'] = $this->load->view('editplaylist', $data, true);
//		$viewScope['pagetitle'] = "Playlists";
//		$viewScope['pagelink'] = "/playlists";
//		$viewScope['pageaddlink'] = "/playlists/add";
//		$viewScope["css_files"] = array();
//		$viewScope["js_files"] = array();
//		$viewScope["js_files"][] = "/wida-online/assets/common/js/views/playlistsView.js";
//
//		$this->breadcrumbs = new Breadcrumbs();
//
//		$data["songlist"] = $wida->getSongs(false);
//		$data["userlist"] = $wida->getUsers(false);
//
//		// add breadcrumbs
//		$this->breadcrumbs->push('Playlists', '/playlists');
//		$this->breadcrumbs->push($data['selectedplaylist']->title, '/playlist');
//		// output
//		$viewScope["breadcrumbdata"]["output"] = $this->breadcrumbs->show();
//
//		$this->render($viewScope);

		$this->edit($index);

	}

	public function edit($index)
	{
		$viewScope = array();
		$wida = new Wida_Online();
		$data = array();
		$data["songlist"] = $wida->getSongs(false);
		$data["userlist"] = $wida->getUsers(false);

		$data["selectedplaylist"] = $wida->getplaylist($index);
		print_r($data["selectedplaylist"]);

		$viewScope['content'] = $this->load->view('editplaylist', $data, true);
		$viewScope['pagetitle'] = "Playlists";
		$viewScope['pagelink'] = "/playlists";
		$viewScope['pageaddlink'] = "/playlists/add";
		$viewScope["css_files"] = array();
		$viewScope["js_files"] = array();
		$viewScope["js_files"][] = "/wida-online/assets/common/js/views/editplaylistView.js";
		$this->breadcrumbs = new Breadcrumbs();

		// add breadcrumbs
		$this->breadcrumbs->push('Playlists', '/playlists');
		$this->breadcrumbs->push($data['selectedplaylist']->title, '/playlist');
		// output
		$viewScope["breadcrumbdata"]["output"] = $this->breadcrumbs->show();

		$this->render($viewScope);
	}

	public function add()
	{
		$viewScope = array();
		$wida = new Wida_Online();
		$data = array();

		//Viewmodel
		$data["selectedplaylist"] =  $wida->getNewplaylist();

		//Viewtemplate
		$viewScope['content'] = $this->load->view('editplaylist', $data, true);

		$viewScope['pagetitle'] = "Playlists";
		$viewScope['pagelink'] = "/playlists";
		$viewScope['pageaddlink'] = "/playlists/add";
		$viewScope["css_files"] = array();
		$viewScope["js_files"] = array();
		$viewScope["js_files"][] = "/wida-online/assets/common/js/views/addplaylistView.js";
		$this->breadcrumbs = new Breadcrumbs();

		// add breadcrumbs
		$this->breadcrumbs->push('Playlists', '/playlists');
		$this->breadcrumbs->push($data['selectedplaylist']->title, '/playlist');
		// output
		$viewScope["breadcrumbdata"]["output"] = $this->breadcrumbs->show();

		$this->render($viewScope);
	}

	public function render($viewScope)
	{
		$wida = new Wida_Online();

		$viewScope['breadcrumbdata'] = $this->render_breadcrumb($viewScope);
		$viewScope['breadcrumb'] = $this->load->view($wida->config['breadcrumb'], $viewScope, true);
		$viewScope['js_files'] =  $wida->config['js_files'] + $viewScope['js_files'];
		$viewScope['css_files'] =  $wida->config['css_files'] + $viewScope['css_files'];
		$viewScope['scriptdir'] = $wida->config['scriptdir'];

		$viewScope['templatescripts'] = $this->load->view($wida->config['templatescripts'], $viewScope, true);
		$viewScope['pagescripts'] = $this->load->view($wida->config['pagescripts'], $viewScope, true);
		$viewScope['logo'] = $this->load->view($wida->config['logo'], $viewScope, true);
		$viewScope['navbar']["top"] = $this->load->view($wida->config['navbar']["top"], $viewScope, true);
		$viewScope['navbar']["main"] = $this->load->view($wida->config['navbar']["main"], $viewScope, true);
		$viewScope['body'] = $this->load->view($wida->config['body'], $viewScope, true);
		$viewScope['html_header'] = $this->load->view($wida->config['html_header'], $viewScope, true);
		$viewScope['html_footer'] = $this->load->view($wida->config['html_footer'], $viewScope, true);

		$this->load->view($wida->config['bootstrap'], $viewScope);


	}

	public function playlists()
	{
		$wida = new Wida_Online();
		$data = array();
		$data["playlists"] = $wida->getplaylists();
		return $this->load->view('playlists', $data, true);
	}
}
