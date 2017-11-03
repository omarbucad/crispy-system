<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Thumbs extends CI_Controller {
 
    public function __construct(){
        parent::__construct();
        $this->load->library('image_lib');
    }
 
    public function products($width, $height, $img){

        // Checking if the file exists, otherwise we use a default image
        $img = is_file('public/upload/images/products/'.$img) ? $img : 'public/img/person-placeholder.jpg';
 
        // If the thumbnail already exists, we just read it
        // No need to use the GD library again
        if( !is_file('public/upload/images/products/thumbnail/'.$width.'x'.$height.'_'.$img) ){
            $config['source_image'] = 'public/upload/images/products/'.$img;
            $config['new_image'] = 'public/upload/images/products/thumbnail/'.$width.'x'.$height.'_'.$img;
            $config['width'] = $width;
            $config['height'] = $height;
            
            $this->image_lib->clear(); 
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
        }
        header('Content-Type: image/jpg');
        readfile('public/upload/images/products/thumbnail/'.$width.'x'.$height.'_'.$img);
    }
}