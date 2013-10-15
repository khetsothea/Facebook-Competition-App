<?php

    class User_download_model extends CI_Model{
        
    
        function downloadAllUsers(){
            
            $query = $this->db->query("SELECT * FROM `persons` ORDER BY `firstname`, `lastname` DESC");
            
            $results = $query->result();
            
           
            $filename ="users.xls";
            $contents = "First Name \t Last Name \t Gender \t Birthday \t Link \t Email \t College";
            header('Content-type: application/ms-excel');
            header('Content-Disposition: attachment; filename='.$filename);
            
            echo $contents;
			echo "\n";
            foreach($results as $fields){
                echo $fields->firstname ."\t";
                echo $fields->lastname ."\t";
                echo $fields->gender ."\t";
                echo $fields->birthday ."\t";
                echo $fields->link ."\t";
                echo $fields->email ."\t";
                echo $fields->college ."\t"; 
                echo "\n";
            }
            
        }
        
        function printAllUsers(){
            $query = $this->db->query("SELECT CONCAT(  `firstname` ,  ' ',  `lastname` ) AS  `name` , `id`, `link`, YEAR( 
                                        CURRENT_TIMESTAMP ) - YEAR( STR_TO_DATE( birthday,  '%m/%d/%Y' ) ) - ( RIGHT( 
                                        CURRENT_TIMESTAMP , 5 ) < RIGHT( STR_TO_DATE( birthday,  '%m/%d/%Y' ) , 5 ) ) AS age,  `birthday` ,  `email` ,  `link` AS  `Facebook Page` ,  `current_city` ,  `school` ,  `college` 
                                        FROM  `persons` 
                                        ORDER BY `Name` ASC 
                                        ");
            
            $results = $query->result();
            
            return $results;   
        }
    }
?>