<?php
class Migration_elearning extends CI_Model {

    public $db;
    function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('nvac_lms_2020', TRUE);
    }

    function insert_upload($data)
    {
        $this->db->insert('tbl_upload', $data);
    }

    function get_all_downloads_by_teacher($data)
    {
        $query = $this->db->get_where('tbl_upload', array('uploaded_by' => $this->session->user_id ,'subjectcode' => $data));
        return $query->result_array();
    }
    public function GetSubjectTeacher(){
    $userID =  $this->session->userdata('user_id');
      $query = $this->db->query("SELECT DISTINCT tbl_subjects.id, tbl_subjects.subjectcode,tbl_subjects.subject_name FROM tbl_subjects WHERE tbl_subjects.teacher_code = '".$userID."' GROUP BY tbl_subjects.subject_name DESC");
            return $query->result();
    }

    function get_all_downloadable_files()
    {
        $query = $this->db->get_where('tbl_upload', array('uploaded_by' => $this->session->user_id));
        return $query->result_array();
    }

    function get_all_subject_by_student()
    {
       $this->db->group_by('subject_name');
        $query = $this->db->get_where('tbl_subjects', array('student_id' => $this->session->user_id));

        return $query->result_array();
    }

    function search_download_by_class($data)
    {
        // $this->db->join('tbl_user_roles', 'role_id = tbl_staff.role');
        $query = $this->db->get_where('tbl_upload', array(
            'subjectcode' => $data,

        ));
        return $query->result_array();
    }

}/* End of file */
