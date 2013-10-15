<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {
    
	public function index(){
                
		$fb_config = array(
                    'appId'  => APP_ID, 
                   'secret' => APP_SECRET,
					'cookie' => true,
                );
		$this->load->library('facebook', $fb_config);
		$user = $this->facebook->getUser();
                
		if($user){
			try {
				$data['me'] = $this->facebook->api('/me/');
				$data['appId'] = $fb_config['appId'];
                                
                                //propaganda dublins page id for like gate
                                $data['page_id'] = '164667956961351'; 
                                
                                $this->load->model('database_actions');
                                $this->load->model('user_data_model');


                                $me = $data['me'];
                                $this->user_data_model->processUserData($data);

                                //creates admin table if one doesn't already exists
                                if(!$this->database_actions->adminTableExists()){
                                    $me = $data['me'];
                                    //populates admin table with the first users id to log into app
                                    $this->database_actions->createAdminTable($me['id']);
                                }
                                  
			} catch (FacebookApiException $e) {
				error_log($e->getType());
				error_log($e->getMessage());
			}
		} else {
			$data['loginUrl'] = $this->facebook->getLoginUrl(array('canvas' => 1, 'fbconnect' => 0, 'scope' => 'user_birthday,user_education_history,user_location, email, user_hometown,user_likes, publish_actions, publish_stream',  'redirect_uri' => APP_REDIRECT_URL ));
		}
                $this->load->model('competition_Model');
                $data['competition'] = $this->competition_Model->getActiveCompetition();
                $this->load->view('competition_view',$data);
	  
	}
        
        public function entry($competition_id = null){
            
            
            //$this->load->model('competition_Model');
            //$this->load->model('facebook_integration_model');
            $this->load->model('user_data_model');
            
            $tableid = 5;
            echo $competition_id;
            $this->db->insert($competition_id, $this->user_data_model->processContestEntry());
            
            //$this->facebook_integration_model->processWallPost($this->competition_Model->getActiveCompetition());
            
            echo json_encode("<div id=\"confirmationMessage\"> The winner will be announced shortly, keep up to date with the page! </div>");
            
        }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */