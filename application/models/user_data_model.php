<?php

class User_data_model extends CI_Model{
    
    function processContestEntry(){
        
        $data['user_id'] = $this->input->post('user_id');
        $data['name'] = $this->input->post('full_name');
        $data['email'] = $this->input->post('email');
        
        return $data;
            
    }
    
    function findCollege($me){
    	if(isset($me['education'])){
    	
        	$education = $me['education'];
        
                    
        	foreach($education as $edu){
            
            
            	if($edu['type'] == 'College'){
                	return $edu['school']['name'];
            	}      
        	}
        }else{
        	return NULL;
    	}             
    }
    
    function findSchool($me){
    	if(isset($me['education'])){
        	$education = $me['education'];
        
                    
        	foreach($education as $edu){
            
            
            	if($edu['type'] == 'High School'){
                	return $edu['school']['name'];
            	}      
        	}
    	}else{
    		return NULL;
    	}             
    }
    
    function checkHometown($me){
        if(isset($me['hometown']['name'])){
            return $me['hometown']['name'];
        }else{
            return NULL;
        }
    }
    
    function checkCurrentLocations($me){
        if(isset($me['location']['name'])){
            return $me['location']['name'];
        }else{
            return NULL;
        }
    }
    function checkEmail($me){
        if(isset($me['email'])){
            return $me['email'];
        }else{
            return NULL;
        }
    }
    
    function checkBirthday($me){
        if(isset($me['birthday'])){
            return $me['birthday'];
        }else{
            return NULL;
        }
    }
    function countFriends($friends){
        if(isset($friends)){
            return count($friends['data']);
        }else{
            return NULL;
        }
    }
    function processUserData($data){
        
        $me = $data['me'];
        
        if(isset($data['friends_list'])){
            $friends = $data['friends_list'];
            $newRow['friends'] = $this->countFriends($friends);
        }
        
        $this->load->model('database_actions');
        $this->database_actions->createUserTable();

        $college = $this->findCollege($me);
        $school = $this->findSchool($me);
        $hometown = $this->checkHometown($me);
        $currentLocation = $this->checkCurrentLocations($me);
        $email = $this->checkEmail($me);
        $birthday = $this->checkBirthday($me);
        
                
        $newRow = array(
            "id" => $me['id'],
            "firstname" => $me['first_name'],
            "lastname" =>  $me['last_name'],
            "gender" => $me['gender'],
            "link" => $me['link'],
            "birthday" => $birthday,
            "email" => $email,
            "hometown" => $hometown,
            "current_city" => $currentLocation,
            "school" => $school,
            "college" => $college
        );
                
       //checks if the users information is already in the database, if not it adds it
       if($this->database_actions->ifValueExists($me['id'])){
           
           
       } else{
            
            $this->database_actions->insertData($newRow);
       }
    }
}
?>
