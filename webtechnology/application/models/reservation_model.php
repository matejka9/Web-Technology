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

    public function vyberVhodneStoly($number, $smoking, $window) {
        $smo = 0; if ($smoking === 'true') { $smo = 1;}
        $win = ''; if ($window === 'true') { $win = ' AND okno = 1';}
        $strQuery = 'SELECT * FROM stoly WHERE pocet > ' . $number . ' AND fajciarsky = ' . $smo . $win;
        log_message('error', $strQuery );
        $query = $this->db->query($strQuery);
        return $query->result();
    }

    public function vyberObsadeneStoly($stolyIds, $od, $do){
        if(count($stolyIds) > 0 ){
            $values  = implode(", ", array_values($stolyIds));
            $strQuery = 'SELECT * FROM reservation WHERE id_stol IN (' . $values . ') AND od BETWEEN FROM_UNIXTIME(' . ($od / 1000) . ') AND FROM_UNIXTIME(' . ($do / 1000) . ') OR od + INTERVAL 30 MINUTE BETWEEN FROM_UNIXTIME(' . ($od / 1000) . ') AND FROM_UNIXTIME(' . ($do / 1000) . ')';
            log_message('error', $strQuery );
            $query = $this->db->query($strQuery);
            return $query->result();
        }
        return array();
    }

    public function rezervujStol($goodTableId, $numberOfPersons, $od, $sitAlone, $name){
        $alone = 0; if ($sitAlone === 'true') { $alone = 1;}
        $strQuery = 'INSERT INTO reservation (name, id_stol, od, pocet, sitalone) VALUES ("' . $name . '", ' . $goodTableId . ', FROM_UNIXTIME(' . $od . '), ' . $numberOfPersons . ', ' . $alone . ')';
        log_message('error', $strQuery );
        $this->db->query($strQuery);
        return $this->db->insert_id();
    }

    public function zrusRezervaciu($reservationTableId){
        $strQuery = 'DELETE FROM reservation where id = ' . $reservationTableId;
        log_message('error', $strQuery );
        $this->db->query($strQuery);
    }
}