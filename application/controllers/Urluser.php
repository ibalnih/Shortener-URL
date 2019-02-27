<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Urluser extends CI_Controller {
	
	public function add()
    {
        $url = $this->input->post('url_data');
        $custom = $this->input->post('url_custom');
        if (empty($url)) {
            echo json_encode(array(
                'status' => 200,
                'error' => true,
                'message' => 'Url not found',
                'data' => null
            ));
        } else {
            if (!$this->inputurl->checkEM($url)) {
                echo json_encode(array(
                    'status' => 200,
                    'error' => true,
                    'message' => 'Url already exist',
                    'data' => null
                ));
            } else {
                if (empty($custom)) {
                    $hash = substr(sha1($url), 0, 8);
                    $data = array(
                        'id' => '',
                        'url' => $url,
                        'redirect' => $hash,
                        'visited' => 0
                    );
                    $this->inputurl->addUrlEM($data);
                    echo json_encode(array(
                        'status' => 200,
                        'error' => false,
                        'message' => 'Success',
                        'data' => array(
                            'url' => base_url() . $hash
                        )
                    ));
                } else {
                    $data = array(
                        'id' => '',
                        'url' => $url,
                        'redirect' => $custom,
                        'visited' => 0
                    );
                    $this->inputurl->addUrlEM($data);
                    echo json_encode(array(
                        'status' => 200,
                        'error' => false,
                        'message' => 'Success',
                        'data' => array(
                            'url' => base_url() . $custom
                        )
                    ));
                }
            }
        }
	}
	
	public function get_url($url)
	{
		if(empty($url)) {
			echo json_encode(array(
                'status' => 200,
                'error' => true,
                'message' => 'Url not found',
                'data' => null
            ));
		} else {
			$find = $this->inputurl->getUrl($url);
			if ($find == false) {
				echo json_encode(array(
					'status' => 500,
					'error' => true,
					'message' => 'Url not found in database',
					'data' => null
				));
			} else {
				echo json_encode(array(
					'status' => 200,
					'error' => false,
					'message' => 'Success',
					'data' => $find
				));
			}
			
		}
	}
}