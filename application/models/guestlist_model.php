<?php

class Guestlist_model extends CI_Model{
    
    function isAlreadyAttending($user_id, $event_id){

        $query = $this->db->get_where($event_id, array('user_id' => $user_id));
        $results = $query->result();
        
        if ($query->num_rows() > 0){
            return true;
        }
        else{
            return false;
        }
    }
    
    function  getList($user_id, $event_id){

        $query = $this->db->get_where($event_id, array('user_id' => $user_id));
        $results = $query->result();
        
        if ($query->num_rows() > 0){
            return $results[0]->guestlist_cheaplist;  
        }
    }
}
?>
