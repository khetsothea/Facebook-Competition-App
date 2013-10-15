<?php

class Competition_Model extends CI_Model{
    
    public function processFormInput(){
        $data['name'] = $this->input->post('name');
        $data['description'] = $this->input->post('description');
        $data['question'] = $this->input->post('question');
        $data['terms'] = $this->input->post('terms');
        $data['confirmation_message'] = $this->input->post('confirmation_message');
        $data['wall_post_text'] = $this->input->post('wall_post_text');
        $data['wall_post_link'] = $this->input->post('wall_post_link');
        $data['wall_post_description'] = $this->input->post('wall_post_description');
        $data['image_link'] = $this->input->post('image_link');
        
        return $data;
    }
    function getCompetitions(){
        $query = $this->db->query("SELECT * FROM  `competitions` ORDER BY `id`;");
        
        if ($query->num_rows() > 0){
            return $query->result();
        }else{
            return FALSE;
        }
    }
    
    function getActiveCompetition(){
        $query = $this->db->query('SELECT * FROM `competitions` WHERE `active` = '.TRUE);
        $results = $query->result();
        return $results;
    }
    
    function removeActiveCompetition(){
        $data = $this->getActiveCompetition();
        $id = $data[0]->id;
        $this->db->query("UPDATE  `competition`.`competitions` SET  `active` =  '0' WHERE  `competitions`.`id` =".$id);
        
    }
    function setActiveCompetition($competition_id){
        $data['active'] = TRUE;
        $this->db->where('id', $competition_id);
        $this->db->update('competitions', $data);
    }
    
}
?>
