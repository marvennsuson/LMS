<?php
class Migration_directory_staff extends CI_Model {

    public $db;
    function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('nvac_lms_2020', TRUE);
    }
    
    function count_all_staffs() 
    {
        return $this->db->count_all("tbl_teacher_info");
    }

    function staff_lists_by_page($limit, $start) 
    {

        $this->db->limit($limit, $start);
        $this->db->join('tbl_user_roles', 'role_id = tbl_teacher_info.role');
        $this->db->order_by("teacher_id", "desc");
        $query = $this->db->get("tbl_teacher_info");

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function staff_list(){

        $this->db->join('tbl_user_roles', 'tbl_user_roles.role_id = tbl_teacher_info.role');
        $this->db->order_by("tbl_teacher_info.teacher_id", "desc");
        $query = $this->db->get("tbl_teacher_info");
        return $query;
    }

    function delete_staff($id)
    {
        $this->db->where('teacher_id', $id);
        $this->db->delete('tbl_teacher_info');
    }

    function read_staff($id)
    {
        $this->db->join('tbl_user_roles', 'role_id = tbl_teacher_info.role');
        $query = $this->db->get_where('tbl_teacher_info', array('teacher_id' => $id));
        return $query->result_array();
    }

    function update_staff($data)
    {
        $data = array(
            'teacher_id' => $data['teacher_id'],
            'name' => $data['name'],
            'role' => $data['role'],
            'birthday' => $data['birthday'],
            'email' => $data['email'],
            'mobile' => $data['mobile'],
            'address' => $data['address'],
            'age' => $data['age'],
            'gender' => $data['gender'],
            'teaching_load' => $data['teaching_load']
        );
        
        $this->db->where('teacher_id', $data['teacher_id']);
        $this->db->update('tbl_teacher_info', $data);
    }

    function search_staff($data)
    {
        
        $this->db->join('tbl_user_roles', 'role_id = tbl_teacher_info.role');
        $this->db->like('name', $data); 
        $this->db->or_like('tbl_teacher_info.staffcode', $data);
        $this->db->order_by('tbl_teacher_info.teacher_id', 'desc');
        $query = $this->db->get_where('tbl_teacher_info');
        return $query->result_array();
    }

    function role_lists()
    {
        $query = $this->db->get_where('tbl_user_roles');
        return $query->result_array();
    }

    function insert_staff($data)
    {
        $this->db->insert('tbl_teacher_info', $data);
    }
    
    
    function get_all_teachers(){
     
        $this->db->select('name,email,address,age,birthday,mobile,gender,staffcode,role,teaching_load');
        $data = $this->db->get('tbl_teacher_info');
        $result = $data->result_array();
        return $result;
    }
}/* End of file */


