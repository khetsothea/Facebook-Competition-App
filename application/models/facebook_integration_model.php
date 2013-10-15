<?php

class Facebook_integration_model extends CI_Model{
    
    function postToOwnWall($data){
        $fb_config = array(
                    'appId'  => APP_ID, 
                   'secret' => APP_SECRET,
					'cookie' => true,
                );
        $this->load->library('facebook', $fb_config);
        $me = $this->facebook->api('/me/');
        
        $to_uid = $me['id'];
        $path = '/'.$to_uid.'/feed/'; 
        
        $method = 'POST';
        $params = array(
                    
                    
                  'name' => $data['wall_post_link'],
                  'message' => $data['wall_post_text'],
                  'caption' => APP_REDIRECT_URL,
                  'link' => PAGE_TAB_URL,
                  'description' => $data['description'], 
                  'picture' => $data['picture'],
                  'actions' => array(array('name' => 'Enter',
                              'link' => PAGE_TAB_URL)));
                    
            try{
                $ret = $this->facebook->api($path, $method, $params);
            }catch(FacebookApiException $e){}
    }
    function processWallPost($data){
        $info = array(
               'picture' => $data[0]->image_link,
               'wall_post_link' => $data[0]->wall_post_link,
               'wall_post_text' => $data[0]->wall_post_text,
               'description' => $data[0]->wall_post_description
            );
        $this->postToOwnWall($info);
    }
    
    function rsvpEvent($event_id){
            
            $fb_config = array(
                    'appId'  => APP_ID, 
                   'secret' => APP_SECRET,
					'cookie' => true,
                );
            $this->load->library('facebook', $fb_config);
            
            $access_token = $this->facebook->getAccessToken();
            $path = '/'.$event_id.'/attending/';
            $method = 'POST';
            try{
               $ret = $this->facebook->api($path, $method);
                   
                } catch (Exception $e){
                    echo "error ";
                    echo $e->getMessage();
            }
        }
    }
?>
