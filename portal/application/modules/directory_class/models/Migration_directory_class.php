<?php
class Migration_directory_class extends CI_Model {

    public $db;
    function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('nvac_lms_2020', TRUE);
    }
    
    function get_all_classes(){
     
        $this->db->select('subjectcode,subjectname,subjectdesc,section,schedule,teacherid,blockclassid');
        $data = $this->db->get('tbl_class');
        $result = $data->result_array();
        return $result;
    }
    function count_all_classes() 
    {
        return $this->db->count_all("tbl_class");
    }

    // function class_lists_by_page($limit, $start) 
    // {
    //     $this->db->limit($limit, $start);
    //     $this->db->order_by("id", "desc");
    //     $this->db->join('tbl_teacher_info', 'staffcode = teacherid', 'left');
    //     $query = $this->db->get("tbl_class");

    //     if ($query->num_rows() > 0) {
    //         foreach ($query->result_array() as $row) {
    //             $data[] = $row;
    //         }
    //         return $data;
    //     }
    //     return false;
    // }
    public function class_list(){
        $this->db->order_by("id", "desc");
        $this->db->join('tbl_teacher_info', 'staffcode = teacherid', 'left');
        $query = $this->db->get("tbl_class");
        return $query;
    }

    function delete_class($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tbl_class');
    }

    function read_class($id)
    {
        $query = $this->db->get_where('tbl_class', array('id' => $id));
        return $query->result_array();
    }

    function update_class($data)
    {
        $data = array(
            'id' => $data['id'],
            'subjectcode' => $data['subjectcode'],
            'subjectname' => $data['subjectname'],
            'subjectdesc' => $data['subjectdesc'],
            'section' => $data['section'],
            'schedule' => $data['schedule'],
            'teacherid' => $data['teacherid'],
            'blockclassid' => $data['blockclassid'],
        );
    
        $this->db->where('id', $data['id']);
        $this->db->update('tbl_class', $data);
    }
    function search_class_where($data)
    {
        $this->db->where('subjectcode', $data); 
        $this->db->order_by('id', 'desc');
        $query = $this->db->get_where('tbl_class');
        return $query->result_array();
    }
    function search_class($data)
    {
        $this->db->like('subjectcode', $data); 
        $this->db->order_by('id', 'desc');
        $query = $this->db->get_where('tbl_class');
        return $query->result_array();
    }

    function load_list_of_teachers()
    {
        $this->db->order_by('teacher_id', 'desc');
        $query = $this->db->get_where('tbl_teacher_info');
        return $query->result_array();
    }
    
    function insert_class($data)
    {
        $this->db->insert('tbl_class', $data);
    }

}/* End of file */


