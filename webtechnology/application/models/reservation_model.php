<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reservation_model extends CI_Model {


    public function getAll()
    {
        $query = $this->db->order_by('date','desc')->get('posts');
        return $query->result();
    }

    public function createPost()
    {
        $id = $this->db->select_max('id')->get('posts')->row()->id;

        $data = array(
            'title'=>$this->input->post('title'),
            'text'=>$this->input->post('text')
        );
        $data['slug'] = create_slug($data['title'],$id);
        $query = $this->db->insert('posts',$data);
        return $query;
    }

    public function showPost($slug)
    {

        $query = $this->db->where('slug',$slug)->get('posts');
        return $query->row();
    }

    public function objednaj(){
    	return true;
    }
}