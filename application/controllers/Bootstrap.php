<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bootstrap extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->database();

		$this->load->library('grocery_CRUD');

		$this->load->library('wida_online');
	}

	public function index()
	{
		$viewScope = array();


		$contentdata = $this->songs_management($viewScope);
		$viewScope["js_files"] = $contentdata->js_files;
		$viewScope["css_files"] = $contentdata->css_files;


		$viewScope["pagetitle"] = "Wida Online";

		$viewScope["scriptdir"] = "/wida-online/assets/bootstrap/";
		$viewScope["templatescripts"] = $this->load->view('templates/Bootstrap/templatescripts', $viewScope, true);
		$viewScope["pagescripts"] = $this->load->view('templates/Bootstrap/pagescripts', $viewScope, true);
		$viewScope["navbar"] = $this->load->view('templates/Bootstrap/navbar', $viewScope, true);
		$viewScope["breadcrumb"] = $this->load->view('templates/Bootstrap/breadcrumb', $viewScope, true);


		$viewScope["content"] = $this->load->view('templates/Bootstrap/content', (array)$contentdata, true);
		$viewScope["body"] = $this->load->view('templates/Bootstrap/body', $viewScope, true);
		$viewScope["html_header"] = $this->load->view('templates/Bootstrap/html_header', $viewScope, true);
		$viewScope["html_footer"] = $this->load->view('templates/Bootstrap/html_footer', $viewScope, true);

		$this->load->view('templates/Bootstrap/bootstrap', $viewScope);
	}


	public function header()
	{
		$viewScope = array();

		$this->load->view('html_header', $viewScope);
	}


	public function songs_management($viewScope)
	{
		$crud = new grocery_CRUD();

		$crud->set_table('wida_allsongs');
		$crud->set_subject('Songs');


		$output = $crud->render();

		return $output;
	}
}

/* End of file Main.php */
/* Location: ./application/controllers/Main.php */
