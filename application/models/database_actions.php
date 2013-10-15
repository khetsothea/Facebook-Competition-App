<?php

class Database_actions extends CI_Model{
    
    public function getData(){
        
        //query sends a standard sql query
        $query = $this->db->query("SELECT * FROM persons");
        
        //results function puts infromation returned from query into array
        return $query->result();
    }
    
    public function getBookings($event_id){
        $query = $this->db->query("SELECT CONCAT(persons.firstname, ' ',persons.lastname) AS name, 
                                    persons.email, 
                                    persons.phone,
                                    events.event_name,
                                    bookings.group_size,
                                    bookings.message,
                                    bookings.booking_id
                                    FROM `persons`, `bookings`, `events`
                                    WHERE persons.id = bookings.user_id
                                    AND bookings.event_id = events.id
                                    AND bookings.event_id =".$event_id.
                                    " ORDER BY events.event_date DESC");
        return $query->result();
    }
    
    public function insertData($data){
        $this->db->insert("persons", $data);
    }
    public function update($userId, $data){
        $this->db->where('id', $userId);
        $this->db->update('persons', $data); 
    }
    public function addCompetition($data){
        $this->db->insert("competitions",$data);
        return $this->db->insert_id(); 
    }
    
    function ifValueExists($value){
        $this->db->where('id',$value);
        $query = $this->db->get('persons');
        
        if ($query->num_rows() > 0){
            return true;
        }
        else{
            return false;
        }
    }

    function createUserTable(){
        $this->db->query("CREATE TABLE IF NOT EXISTS `persons` (
                            `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                            `id` varchar(100) NOT NULL,
                            `firstname` varchar(50) NOT NULL,
                            `lastname` varchar(50) NOT NULL,
                            `gender` varchar(50) NOT NULL,
                            `friends` int(50) DEFAULT NULL,
                            `birthday` varchar(50) NOT NULL,
                            `email` varchar(200) DEFAULT NULL,
                            `phone` varchar(200) DEFAULT NULL,
                            `hometown` varchar(50) DEFAULT NULL,
                            `current_city` varchar(250) DEFAULT NULL,
                            `school` varchar(200) DEFAULT NULL,
                            `college` varchar(200) DEFAULT NULL,
                            `link` varchar(200) NOT NULL,
                            PRIMARY KEY (`id`)
                          ) ENGINE=InnoDB DEFAULT CHARSET=latin1;"
                );
    }
    
    function createCompetitionsTable(){
        $this->db->query("CREATE TABLE IF NOT EXISTS `competitions` (
                            `id` int(50) NOT NULL AUTO_INCREMENT,
                            `name` varchar(250) NOT NULL,
                            `description` varchar(500) NOT NULL,
                            `question` varchar(250) NOT NULL,
                            `terms` varchar(500) NOT NULL,
                            `confirmation_message` varchar(250) NOT NULL,
                            `wall_post_text` varchar(250) NOT NULL,
                            `wall_post_link` varchar(250) NOT NULL,
                            `wall_post_description` varchar(500) NOT NULL,
                            `image_link` varchar(100) NOT NULL,
                            `background_image` varchar(100) NOT NULL,
                            `left_image` varchar(100) NOT NULL,
                            `right_image` varchar(100) NOT NULL,
                            `active` varchar(10) DEFAULT NULL,
                            PRIMARY KEY (`id`)
                          ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;");
    }
    
    function createIndividualCompetitionTable($tableName){
        $this->db->query("CREATE TABLE IF NOT EXISTS `".$tableName."` (
                        `id` int(20) NOT NULL AUTO_INCREMENT,
                        `user_id` varchar(100) NULL,
                        `name` varchar(100) NOT NULL,
                        `email` varchar(100) NOT NULL,
                        `phone` varchar(100) NULL,
                        PRIMARY KEY (`id`)
                        ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;");
    }
    
    function createAdminTable($user_id){
        $this->db->query("CREATE TABLE IF NOT EXISTS `admin` (
                            `user_id` varchar(100) NOT NULL,
                             PRIMARY KEY (`user_id`)
                        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;");
        $data = array(
            'user_id' => $user_id,
        );
        
        $this->db->insert("admin", $data);
    }
    function getAdmins(){
        $query = $this->db->query("SELECT `persons`.`firstname`, `persons`.`id`, `persons`.`lastname` FROM `persons`,`admin` WHERE `admin`.`user_id` = `persons`.`id`");
        return $query->result();;
    }
    
    function makeAdmin($user_id){
        $data = array(
            'user_id' => $user_id,
        );
        $this->db->insert("admin", $data);
    }
    function removeAdmin($user_id){
        $this->db->delete('admin', array('user_id' => $user_id));
    }
    
    function createBookingsTable(){
        $this->db->query("CREATE TABLE IF NOT EXISTS `bookings` (
                            `booking_id` int(20) NOT NULL AUTO_INCREMENT,
                            `user_id` varchar(100) NOT NULL,
                            `event_id` int(20) NOT NULL,
                            `group_size` int(20) NOT NULL,
                            `message` varchar(200) DEFAULT NULL,
                            PRIMARY KEY (`booking_id`)
                          ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;");
    }
    function adminTableExists(){
        return $this->db->table_exists('admin');
    }
    function insertEventData($data){
        
        $this->db->insert("events", $data);
    }
    function isAnAdmin($user_id){
        $this->db->where('user_id',$user_id);
        $query = $this->db->get('admin');
        if ($query->num_rows() > 0){
            return true;
        }
        else{
            return false;
        }
    }
    

}
?>
