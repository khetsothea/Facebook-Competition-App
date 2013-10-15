<?php

class Picture_upload extends CI_Model {

    var $image_upload_path;

    function do_file_Upload() {

        $config = Array(
            'allowed_types' => 'gif|jpg|png|jpng',
            'upload_path' => './static/resources/images'
        );


        $this->load->library('upload', $config);
        if ($this->upload->do_upload()) {
            return TRUE;
        } else {
            $errors = $this->upload->display_errors();
            echo $errors;
            return FALSE;
        }
    }

    function upload_Multiple_Files() {

        $config['upload_path'] = './static/resources/images/';
        $path = $config['upload_path'];
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        //$config['max_size'] = '1024';
        //$config['max_width'] = '1920';
        //$config['max_height'] = '1280';
        $this->load->library('upload');
        
        $counter =0;
        foreach ($_FILES as $fieldname => $fileObject) {  //fieldname is the form field name
            if (!empty($fileObject['name'])) {
                $this->upload->initialize($config);
                if (!$this->upload->do_upload($fieldname)) {
                    $errors = $this->upload->display_errors();
                    echo $errors;
                    return FALSE;
                }else{
                    $data[$counter] = $this->upload->data();
                }
                
            }
            $counter++;
        }
       
        return $data;
    }

    function deleteFile($filePath) {
        unlink($filePath);
    }

}

?>
