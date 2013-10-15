<?php

class Event_model extends CI_Model{
    
    function numOfEvents(){
        $this->load->model('Database_Actions');
        
        $this->Database_Actions->createEventsTable();
                
        return $this->db->count_all('events');
    }
    
    function sortEvents(){
        //date function returns todays date
        //$date = date("Y/m/d");
        //$time = date("H/m/s");
        
        $this->load->model('Database_Actions');
        
        $query = $this->db->query("SELECT * 
                                    FROM  `events` 
                                    WHERE  `event_date` = CURDATE( ) 
                                    AND  `event_close_time` > CURTIME( ) 
                                    UNION ALL 
                                    SELECT * 
                                    FROM  `events` 
                                    WHERE  `event_date` > CURDATE( ) 
                                    ORDER BY  `event_date`
                                    Limit 4");
        
        if ($query->num_rows() > 0){
            return $query->result();
        }else{
            return FALSE;
        }

    }
    
    public function addNameToEvent($event_id,$data){
        $this->db->insert($event_id, $data);
    }
    
   
    
    function getEventName($event_id){
        $query = $this->db->get_where('events', array('id' => $event_id));
        $results = $query->result();
        return $results[0]->event_name;
    }
    
    function getFacebookEventID($event_id){
        $query = $this->db->get_where('events', array('id' => $event_id));
        $results = $query->result();
        return $results[0]->facebook_event_id;
    }
    
    function guestlistAllowance($event_id){
        $query = $this->db->query('SELECT `free_in` FROM `events` WHERE `id` = '.$event_id);
        $results = $query->result();
        return $results[0]->free_in;
    }
}
?>
