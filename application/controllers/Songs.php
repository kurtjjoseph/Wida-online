<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Songs extends CI_Controller
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
		$viewScope['pagetitle'] = "Liederen";
		$viewScope['pagelink'] = "/songs";
		$viewScope['pageaddlink'] = "songs/add";
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
		$output["js_files"][] = "/wida-online/assets/common/js/views/songsView.js";
		$output["css_files"] = array();
		$output["output"] = $this->songlist();


		return $output;
	}

	public function render_breadcrumb($viewScope)
	{
		$output = array();
		$output["output"] = "";

		$this->breadcrumbs = new Breadcrumbs();

		// add breadcrumbs
		$this->breadcrumbs->push('Liederen', '/songs');


		// output
		$output["output"] = $this->breadcrumbs->show();
		return $output;
	}

	public function songs_management($viewScope)
	{
		$crud = new grocery_CRUD();
		$crud->set_table('wida_allsongs');
		$crud->set_subject('Songs');
		$output = $crud->render();
		return $output;
	}

	public function song($index)
	{
		$viewScope = array();
		$wida = new Wida_Online();
		$data = array();
		$data["selectedsong"] = $wida->getSong($index);
		$viewScope['content'] = $this->load->view('selectedsong', $data, true);
		$viewScope['pagetitle'] = "Liederen";
		$viewScope['pagelink'] = "/songs";
		$viewScope['pageaddlink'] = "/songs/add";


		$viewScope["css_files"] = array();
		$viewScope["js_files"] = array();
		$viewScope["js_files"][] = "/wida-online/assets/common/js/views/songView.js";

		$this->breadcrumbs = new Breadcrumbs();

		// add breadcrumbs
		$this->breadcrumbs->push('Liederen', '/songs');
		$this->breadcrumbs->push($data['selectedsong']->Title, '/song');
		// output
		$viewScope["breadcrumbdata"]["output"] = $this->breadcrumbs->show();

		$this->render($viewScope);
	}


	public function save($index)
	{
		$viewScope = array();
		$wida = new Wida_Online();

		$songdata = array(

			'Title' => $this->input->post('Title'),
			'Author' => $this->input->post('Author'),
			'Key' => $this->input->post('Key'),
			'Tempo' => $this->input->post('Tempo'),
			'Time' => $this->input->post('Time'),
			'YoutubeLink' => $this->input->post('YoutubeLink'),
			'drumcover' => $this->input->post('drumcover'),
			'basscover' => $this->input->post('basscover'),
			'zangcover' => $this->input->post('zangcover'),
			'pianocover' => $this->input->post('pianocover'),
			'elguitarcover' => $this->input->post('elguitarcover'),
			'acguitarcover' => $this->input->post('acguitarcover'),
			'Data' => $this->input->post('Data'),
			'Text' => $this->input->post('Text')
		);

		$data["selectedsong"] = $wida->saveSong($index, $songdata);
		$viewScope['savedsong'] = true;

		$viewScope['content'] = $this->load->view('editsong', $data, true);
		$viewScope['pagetitle'] = "Liederen";
		$viewScope['pagelink'] = "/songs";
		$viewScope['pageaddlink'] = "/songs/add";
		$viewScope["css_files"] = array();
		$viewScope["js_files"] = array();
		$viewScope["js_files"][] = "/wida-online/assets/common/js/views/songView.js";

		$this->breadcrumbs = new Breadcrumbs();

		// add breadcrumbs
		$this->breadcrumbs->push('Liederen', '/songs');
		$this->breadcrumbs->push($data['selectedsong']->Title, '/song');
		// output
		$viewScope["breadcrumbdata"]["output"] = $this->breadcrumbs->show();

		$this->render($viewScope);

	}

	public function edit($index)
	{
		$viewScope = array();
		$wida = new Wida_Online();
		$data = array();
		$data["selectedsong"] = $wida->getSong($index);
		$viewScope['content'] = $this->load->view('editsong', $data, true);
		$viewScope['pagetitle'] = "Liederen";
		$viewScope['pagelink'] = "/songs";
		$viewScope['pageaddlink'] = "/songs/add";
		$viewScope["css_files"] = array();
		$viewScope["js_files"] = array();
		$viewScope["js_files"][] = "/wida-online/assets/common/js/views/editsongView.js";
		$this->breadcrumbs = new Breadcrumbs();

		// add breadcrumbs
		$this->breadcrumbs->push('Liederen', '/songs');
		$this->breadcrumbs->push($data['selectedsong']->Title, '/song');
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
		$data["selectedsong"] =  $wida->getNewSong();

		//Viewtemplate
		$viewScope['content'] = $this->load->view('editsong', $data, true);

		$viewScope['pagetitle'] = "Liederen";
		$viewScope['pagelink'] = "/songs";
		$viewScope['pageaddlink'] = "/songs/add";
		$viewScope["css_files"] = array();
		$viewScope["js_files"] = array();
		$viewScope["js_files"][] = "/wida-online/assets/common/js/views/songView.js";
		$this->breadcrumbs = new Breadcrumbs();

		// add breadcrumbs
		$this->breadcrumbs->push('Liederen', '/songs');
		$this->breadcrumbs->push($data['selectedsong']->Title, '/song');
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

	public function songlist()
	{
		$wida = new Wida_Online();
		$data = array();
		$data["songs"] = $wida->getSongs(true);
		return $this->load->view('songlist', $data, true);
	}
}
