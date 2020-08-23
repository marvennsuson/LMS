<?php
class Migration_directory_student extends CI_Model {

    public $db;
    function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('nvac_lms_2020', TRUE);
    }
    
    function count_all_students() 
    {
        return $this->db->count_all("tbl_students");
    }


    function student_lists_by_page($limit, $start) 
    {

        $this->db->limit($limit, $start);
        $this->db->order_by("id", "desc");
        $query = $this->db->get("tbl_students");

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function student_list(){
        $this->db->order_by("id", "desc");
        $query = $this->db->get("tbl_students");
        return $query;
    }
    function delete_student($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tbl_students');
    }

    function read_student($id)
    {
        $query = $this->db->get_where('tbl_students', array('id' => $id));
        return $query->result_array();
    }

    function update_student($data)
    {
        $data = array(
            'id' => $data['id'],
            'firstname' => $data['firstname'],
            'middlename' => $data['middlename'],
            'lastname' => $data['lastname'],
            'sex' => $data['sex'],
            'birthdate' => $data['birthdate'],
            'email' => $data['email'],
            'cellphone' => $data['cellphone'],
            'student_type' => $data['student_type'],
            'address' => $data['address'],
            'guardian_name' => $data['guardian_name'],
            'guardian_email' => $data['guardian_email'],
            'guardian_mobile' => $data['guardian_mobile'],
            'guardian_address' => $data['guardian_address'],
            // 'created_at' => date('Y-m-d h:i:s'),
            'updated_at' => date('Y-m-d h:i:s'),
        );
    
        $this->db->where('id', $data['id']);
        $this->db->update('tbl_students', $data);
    }

    function search_student($data)
    {
        $this->db->like('firstname', $data); 
        $this->db->or_like('middlename', $data);
        $this->db->or_like('lastname', $data);
        $this->db->or_like('student_number', $data);
        $this->db->or_like('grade', $data);
        $this->db->or_like('course', $data);
        $this->db->or_like('strand', $data);
        $this->db->or_like('student_type', $data);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get_where('tbl_students');
        return $query->result_array();
    }

    function insert_student($data)
    {
        $this->db->insert('tbl_students', $data);
    }
    

    function get_all_students(){
        $this->db->select('student_number,student_type,status,grade,strand,course,firstname,middlename,lastname,birthdate,sex,address,cellphone,email,guardian_name,guardian_mobile,guardian_email,guardian_address');
        $data = $this->db->get('tbl_students');
        $result = $data->result_array();
        return $result;
    }
    


    // subjects

    function subject_lists_by_page($limit, $start) 
    {

        $this->db->join("tbl_students", "student_id = tbl_students.student_number");
        $this->db->join("tbl_teacher_info", "teacher_code = tbl_teacher_info.staffcode");
        $this->db->limit($limit, $start);
        $this->db->order_by("tbl_subjects.id", "desc");
        $query = $this->db->get("tbl_subjects");

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function subject_list(){
        $this->db->select('tbl_subjects.id, tbl_subjects.subjectcode,tbl_subjects.classcode,tbl_subjects.subject_name,tbl_subjects.teacher_code,tbl_teacher_info.name,tbl_subjects.section,tbl_subjects.schedule,tbl_subjects.adviser_teacher,tbl_subjects.student_id,tbl_students.firstname,tbl_students.middlename,tbl_students.lastname,tbl_students.student_type,tbl_subjects.subject_description');
        $this->db->join("tbl_students", "student_id = tbl_students.student_number");
        $this->db->join("tbl_teacher_info", "teacher_code = tbl_teacher_info.staffcode");
        $this->db->order_by("tbl_subjects.id", "desc");
        $query = $this->db->get("tbl_subjects");
        return $query;
    }

    function search_subject_id($data){
        $query = $this->db->get_where('tbl_subjects', $data);
        return $query->result_array();
    }

    function update_subject($data)
    {
        
        $data = array(
            'id' => $data['id'],
            'classcode' => $data['classcode'],
            'subject_name' => $data['subject_name'],
            'teacher_code' => $data['teacher_code'],
            // 'gender' => trim($this->input->post('select_gender')),
            'section' => $data['section'],
            'schedule' => $data['schedule'],
            'adviser_teacher' => $data['adviser_teacher'],
            'subject_description' => $data['subject_description'],
            // 'created_at' => date('Y-m-d h:i:s'),
            'updated_at' => date('Y-m-d h:i:s'),
        );
        
        $this->db->where('id', $data['id']);
        $this->db->update('tbl_subjects', $data);
    }

    function insert_subject($data)
    {
        $this->db->insert('tbl_subjects', $data);
    }

    function delete_subject($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tbl_subjects');
    }

    function get_all_subjects(){
        $this->db->select('subjectcode,classcode,subject_name,teacher_code,section,schedule,adviser_teacher,student_id,subject_description');
        $data = $this->db->get('tbl_subjects');
        $result = $data->result_array();
        return $result;
    }

    function count_all_subjects() 
    {
        return $this->db->count_all("tbl_subjects");
    }


    public function search_subject_code($subjCode){
        $this->db->like('subjectcode', $subjCode);
        $data = $this->db->get('tbl_class');
        $result = $data->result_array();
        return $result;
    }

    public function search_block_code($blckCode){
        $this->db->like('blockclassid', $blckCode);
        $this->db->select('blockclassid');  
        $this->db->distinct();
        $query = $this->db->get('tbl_class');
        $result = $query->result_array();
        return $result;
    }
    public function get_block_subjects($id){
        $query = $this->db->get_where('tbl_class', array('blockclassid' => $id));
        return $query->result_array();
    }
    
    public function get_subject_code_by_id($id){
        $query = $this->db->get_where('tbl_class', array('id' => $id));
        return $query->row_array();
    }

    public function get_subject_by_id($id){
        $query = $this->db->get_where('tbl_class', array('id' => $id));
        return $query->result_array();
    }
    public function get_subject_by_subj_code($id){
        $query = $this->db->get_where('tbl_class', array('subjectcode' => $id));
        return $query->result_array();
    }

    public function get_subject_by_subj_code_single($id){
        $query = $this->db->get_where('tbl_class', array('subjectcode' => $id));
        return $query->row_array();
    }

    public function register_student($insertData){
        $this->db->insert_batch('tbl_subjects', $insertData); 
    }

    public function get_subject_registered_students($id){
        $this->db->select("tbl_subjects.id,tbl_subjects.student_id,tbl_students.firstname,tbl_students.middlename,tbl_students.lastname");
        $this->db->join('tbl_students','tbl_subjects.student_id = tbl_students.student_number');
        $query = $this->db->get_where('tbl_subjects', array('subjectcode' => $id));
        return $query->result_array();
    }

    public function get_registered_subject_Code($id){
        $query = $this->db->get_where('tbl_subjects', array('id' => $id));
        return $query->row_array();
    }

    public function get_block_registered_students($id){
        $this->db->group_by('tbl_subjects.student_id');
        $this->db->join('tbl_students','tbl_subjects.student_id = tbl_students.student_number');
        $query = $this->db->get_where('tbl_subjects', array('classcode' => $id));
        return $query->result_array();
    }

    public function delete_block($stId,$blockCode)
    {
        $condition = array(
            "classcode" => $blockCode,
            "student_id" => $stId
        );

        $this->db->delete('tbl_subjects',$condition);
    
    }


}/* End of file */


