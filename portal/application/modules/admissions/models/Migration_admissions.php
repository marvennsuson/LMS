<?php
class Migration_admissions extends CI_Model {

    public $db;
    function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('nvac_lms_2020', TRUE);
    }

    function count_all_admissions() 
    {
        return $this->db->count_all("tbl_students");
    }
    
    function admission_lists_by_page($limit, $start) 
    {
        $this->db->distinct();
        $this->db->group_by('tt.admission_id');
        
        $this->db->limit($limit, $start);
        $this->db->order_by("tt.admission_id", "desc");
        $query = $this->db->get("tbl_students as tt");

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    function read_admission($admission_id)
    {
        $query = $this->db->get_where('tbl_students', array('admission_id' => $admission_id));
        return $query->result_array();
    }

    function read_admission_row($admission_id)
    {
        $query = $this->db->get_where('tbl_students', array('admission_id' => $admission_id));
        return $query->row_array();
    }

    function read_teachers()
    {
        $query = $this->db->get('tbl_teachers');
        return $query->result_array();
    }

    function read_subjects()
    {
        $query = $this->db->get('tbl_subjects');
        return $query->result_array();
    }

    function read_sections()
    {
        $query = $this->db->get('tbl_sections');
        return $query->result_array();
    }

    function read_schedules()
    {
        $query = $this->db->get('tbl_schedules');
        return $query->result_array();
    }

    function read_classes()
    {
        $query = $this->db->get('tbl_classes');
        return $query->result_array();
    }

    function read_class_details($classcode)
    {
        // $this->db->distinct();
        // $this->db->join('tbl_classcode as tcc', 'tcc.classcode = tc.classcode');
        // $this->db->join('tbl_teachers as tt', 'tt.teacher_id = tcc.teacher');
        // $this->db->join('tbl_subjects as tsub', 'tsub.subject_id = tcc.subject');
        // $this->db->join('tbl_sections as tsec', 'tsec.section_id = tcc.section');
        $this->db->join('tbl_classcode as tcc', 'tcc.classcode = tc.classcode');
        $query = $this->db->get_where('tbl_classes  as tc', array('tc.classcode LIKE' => $classcode));
        return $query->result_array();
    }

    function delete_admission($admission_id)
    {
        $this->db->where('admission_id', $admission_id);
        $this->db->delete('tbl_students');
    }

    function register_student($data)
    {
        $this->db->set('classcode', $data['classcode']);
        $this->db->set('enrollment_process', $data['enrollment_process']);
        $this->db->where('admission_id', $data['admission_id']);
        $this->db->update('tbl_students');
    }

    function for_bulk_registration($enrollment_process)
    {
        $query = $this->db->get_where('tbl_students as ts', array('ts.enrollment_process LIKE' => $enrollment_process));
        return $query->result_array();
    }

    function search_student_by_level($data)
    {
        $query = $this->db->get_where('tbl_students as ts', array(
            'ts.grade LIKE' => $data,
            'ts.enrollment_process' => 'admission',
         ));
        return $query->result_array();
    }

    function create_account($data)
    {
        $data = array(
            'email' => $data['email'],
            'password' => md5($data['password']),
            'student_number' => $data['student_number'],
            'role' => $data['role'],
            'created_at' => date('Y-m-d h:i:s'),
            'updated_at' => date('Y-m-d h:i:s'),
        );

        $this->db->insert('tbl_users', $data);
    }

    
}

