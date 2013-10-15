<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
    
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
                $me = $this->facebook->api('/me/');

                $this->load->model('database_actions');
                $admin = $this->database_actions->isAnAdmin($me['id']);

                if($admin){
                    $this->manage_competitions();
                }else{
                    $this->load->view('redirect_view');
                }

            }catch(FacebookApiException $e) {
                error_log($e->getType());
                error_log($e->getMessage());
            }
        }else {
            $data['loginUrl'] = $this->facebook->getLoginUrl(array('canvas' => 1, 'fbconnect' => 0, 'scope' => 'user_birthday,user_education_history,user_location, email, user_hometown,user_likes, user_events, rsvp_event, publish_actions, publish_stream',  'redirect_uri' => APP_REDIRECT_URL ));
        
            $this->load->view('competition_view',$data);
        }
    }
    
    public function manage_competitions(){
        $this->load->model('competition_Model');
        $competitions = $this->competition_Model->getCompetitions();
        
        $data;
        if($competitions != FALSE){
            $data['competitions'] =$competitions;
        }
        $this->load->view('admin_navbar');
        $this->load->view('manage_competitions_view', $data);
    }
   
    public function createCompetition(){
        $this->load->view('admin_navbar');
        $this->load->view('create_competition_view');
    }
    public function addCompetition() {

        $this->load->model('competition_Model');
        $formData = $this->competition_Model->processFormInput();
        
        $this->load->model('picture_upload');
        
        $imageData = $this->picture_upload->upload_Multiple_Files();
        
            if($imageData != FALSE){

                
                
                $formData['background_image'] = $imageData[0]['file_name'];
                $formData['left_image'] =  $imageData[1]['file_name'];
                $formData['right_image'] =  $imageData[2]['file_name'];

                $this->load->model('database_actions');
                $this->database_actions->createCompetitionsTable();
                $id = $this->database_actions->addCompetition($formData);
                $this->database_actions->createIndividualCompetitionTable($id);
                
                $this->manage_competitions();
                
            }else{
                $this->createCompetition();
            }
    }

    
    // These functions are used to view / download users from the database
    
     public function view_users(){
        $this->load->model('user_download_model');
        $users = $this->user_download_model->printAllUsers();
        $data['users'] = $users;
        $this->load->view('admin_navbar');
        $this->load->view('print_users_view', $data);
    }
    public function downloadAllUsers(){
        $this->load->model('user_download_model');
        $this->user_download_model->downloadAllUsers();
    }
    
    
    // These functions are used to manage the admins
    public function manageAdmin(){
        $this->load->model('database_actions');
        $data['admins'] = $this->database_actions->getAdmins();
        
        $this->load->view('admin_navbar');
        $this->load->view('manage_admin_view',$data);
    }
    public function addAdminView(){
        $this->load->view('admin_navbar');
        $this->load->view('add_admin_view');  
    }
    public function addAdmin(){
        $id = $this->input->post('facebookId');
        $this->load->model('database_actions');
        $this->database_actions->makeAdmin($id);
        $this->manageAdmin();
    }
    public function deleteAdmin(){
        $this->load->model('database_actions');
        $this->database_actions->removeAdmin($this->input->post('user_id'));
        $this->manageAdmin();
    }
    
    // SETTINGS FUNCTIONS
    public function settingsSelectActiveCompetition(){
        $this->load->model('competition_Model');
        $data['competitions'] = $this->competition_Model->getCompetitions();
        $this->load->view('admin_navbar');
        $this->load->view('competition_settings_view', $data);
    }
    public function settingsLikeGate(){
        $this->load->view('admin_navbar');
        $this->load->view('likegate_settings_view');
    }
    
    public function setActiveCompetition(){
        
        $this->load->model('competition_Model');
        $this->competition_Model->removeActiveCompetition();
        $this->competition_Model->setActiveCompetition($this->input->post('user_id'));
        
        $this->manage_competitions();
    }
    

}

?>