<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chords extends CI_Controller {

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
		$viewScope['breadcrumb'] = $this->load->view($wida->config['breadcrumb'] , $viewScope, true);


		$viewScope['js_files'] = $viewScope['js_files'] + $wida->config['js_files'] ;
		$viewScope['css_files'] = $viewScope['css_files'] + $wida->config['css_files'] ;
		$viewScope['pagetitle'] = "Chords" ;
		$viewScope['pagelink'] = "/chords" ;
		$viewScope['pageaddlink'] = "chords/addchord" ;
		$viewScope['scriptdir'] = $wida->config['scriptdir'] ;

		$viewScope['templatescripts'] = $this->load->view($wida->config['templatescripts'], $viewScope, true);
		$viewScope['pagescripts'] = $this->load->view($wida->config['pagescripts'] , $viewScope, true);
		$viewScope['logo'] = $this->load->view($wida->config['logo'] , $viewScope, true);
		$viewScope['navbar']["top"] = $this->load->view($wida->config['navbar']["top"] , $viewScope, true);
		$viewScope['navbar']["main"] = $this->load->view($wida->config['navbar']["main"], $viewScope, true);
		$viewScope['body'] = $this->load->view($wida->config['body'] , $viewScope, true);
		$viewScope['html_header'] = $this->load->view($wida->config['html_header'] , $viewScope, true);
		$viewScope['html_footer'] = $this->load->view($wida->config['html_footer'] , $viewScope, true);

		$this->load->view($wida->config['bootstrap'], $viewScope);
	}


	public function render_content($viewScope)
	{
		$output = array();

		$output["js_files"] = array();
		$output["js_files"][] = "/wida-online/assets/common/js/views/chordsView.js";

		$output["css_files"] = array();
		$output["output"] = $this->chordlist();


		return $output;
	}

	public function render_breadcrumb($viewScope)
	{
		$output = array();
		$output["output"] = "";

		$this->breadcrumbs = new Breadcrumbs();

		// add breadcrumbs
		$this->breadcrumbs->push('Chords', '/chords');


		// output
		$output["output"] = $this->breadcrumbs->show();
		return $output;
	}

	public function chords_management($viewScope)
	{
		$crud = new grocery_CRUD();
		$crud->set_table('wida_chords');
		$crud->set_subject('Chords');
		$output = $crud->render();
		return $output;
	}

	public function chord($spelling)
	{
		$viewScope = array();
		$wida = new Wida_Online();
		$data = array();
		$data["selectedchord"] = $wida->getChord($spelling);
		$viewScope['content'] = $this->load->view('selectedchord', $data, true);
		$viewScope['pagetitle'] = "Liederen";
		$viewScope['pagelink'] = "/chords" ;
		$viewScope['pageaddlink'] = "/chords/add" ;

		$this->breadcrumbs = new Breadcrumbs();

		// add breadcrumbs
		$this->breadcrumbs->push('Liederen', '/chords');
		$this->breadcrumbs->push($data['selectedchord']->Title, '/chord');
		// output
		$viewScope["breadcrumbdata"]["output"] = $this->breadcrumbs->show();

		$this->render($viewScope);
	}


	public function save($index)
	{
		$viewScope = array();
		$wida = new Wida_Online();

		$chorddata = array(

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

		$data["selectedchord"] = $wida->savechord($index, $chorddata);
		$viewScope['savedchord'] =  true;

		$viewScope['content'] = $this->load->view('editchord', $data, true);
		$viewScope['pagetitle'] = "Liederen";
		$viewScope['pagelink'] = "/chords" ;
		$viewScope['pageaddlink'] = "/chords/add" ;

		$this->breadcrumbs = new Breadcrumbs();

		// add breadcrumbs
		$this->breadcrumbs->push('Liederen', '/chords');
		$this->breadcrumbs->push($data['selectedchord']->Title, '/chord');
		// output
		$viewScope["breadcrumbdata"]["output"] = $this->breadcrumbs->show();

		$this->render($viewScope);

	}
	public function edit($index)
	{
		$viewScope = array();
		$wida = new Wida_Online();
		$data = array();
		$data["selectedchord"] = $wida->getChord($index);
		$viewScope['content'] = $this->load->view('editchord', $data, true);
		$viewScope['pagetitle'] = "Chords";
		$viewScope['pagelink'] = "/chords" ;
		$viewScope['pageaddlink'] = "/chords/add" ;

		$this->breadcrumbs = new Breadcrumbs();

		// add breadcrumbs
		$this->breadcrumbs->push('Chords', '/chords');
		$this->breadcrumbs->push($data['selectedchord']->Title, '/chord');
		// output
		$viewScope["breadcrumbdata"]["output"] = $this->breadcrumbs->show();

		$this->render($viewScope);
	}

	public function render($viewScope)
	{
		$wida = new Wida_Online();


		$viewScope['breadcrumbdata'] = $this->render_breadcrumb($viewScope);
		$viewScope['breadcrumb'] = $this->load->view($wida->config['breadcrumb'] , $viewScope, true);

		$viewScope['js_files'] = $viewScope['js_files'] + $wida->config['js_files'];
		$viewScope['css_files'] = $viewScope['css_files'] + $wida->config['css_files'];
		$viewScope['scriptdir'] = $wida->config['scriptdir'] ;

		$viewScope['templatescripts'] = $this->load->view($wida->config['templatescripts'], $viewScope, true);
		$viewScope['pagescripts'] = $this->load->view($wida->config['pagescripts'] , $viewScope, true);
		$viewScope['logo'] = $this->load->view($wida->config['logo'] , $viewScope, true);
		$viewScope['navbar']["top"] = $this->load->view($wida->config['navbar']["top"] , $viewScope, true);
		$viewScope['navbar']["main"] = $this->load->view($wida->config['navbar']["main"], $viewScope, true);
		$viewScope['body'] = $this->load->view($wida->config['body'] , $viewScope, true);
		$viewScope['html_header'] = $this->load->view($wida->config['html_header'] , $viewScope, true);
		$viewScope['html_footer'] = $this->load->view($wida->config['html_footer'] , $viewScope, true);

		$this->load->view($wida->config['bootstrap'], $viewScope);


	}

	public function chordlist()
	{
		$wida = new Wida_Online();
		$data = array();
		$data["chords"] = $wida->getChords();
		return $this->load->view('chords', $data,true);
	}
}
