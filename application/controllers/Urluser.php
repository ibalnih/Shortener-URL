<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Urluser extends CI_Controller {
	
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{	
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->helper('url');
		$this->load->model('inputurl');

		$this->form_validation->set_rules('url_data', 'URL', 'required');
		$this->form_validation->set_rules('url_custom', 'URL CUSTOM', 'required');
		if ($this->form_validation->run() === FALSE) {
			$this->load->view('shorten');
		}else{
			$url = $this->input->post('url_data');
			$urlc = $this->input->post('url_custom');

			if(empty($url)) {
				echo json_encode(array(
					'ststus' => 200,
					'error' => true,
					'message' => 'Url not found',
					'data' => null
				));
			}else{
				$urlcheck = $this->inputurl->checkEM($url);
				$directcheck = $this->inputurl->checkCustom($urlc);
				if (empty($urlcheck[0]['url']) && empty($directcheck[0]['redirect'])) {
					$data = array(
						'id' => '',
						'url' => $url,
						'redirect' => $urlc,
						'visited' => 0
					);
					$this->inputurl->addUrlEM($data);
					echo json_encode(array(
						'ststus' => 200,
						'error' => false,
						'message' => 'Success',
						'data' => array('url' => base_url().$urlc)
					));
				}else{
					echo json_encode(array(
						'ststus' => 200,
						'error' => true,
						'message' => 'Url already exits',
						'data' => null
					));
				}
			}

			// $urls = base_url().substr(sha1($this->input->post('url_data')), 0, 8);
        
			// $urldata = $this->inputurl->getUrl($urll);

			// if (empty($urldata[0]['short_urls'])) {
				
			// 	$this->inputurl->addUrl($urll, $urls);
			// 	echo "Link tersimpan";
			// }else{
			// 	echo "Link sudah ada";
			// }
		}
	}
}