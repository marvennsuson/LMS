<?php
class Migration_activities extends CI_Model {

    public $db;
    function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('nvac_lms_2020', TRUE);
    }

    function create_seatwork($data)
    {
        $this->db->insert('tbl_activities_seatwork', $data);
    }

    function create_homework($data)
    {
        $this->db->insert('tbl_activities_homework', $data);
    }

    public function GetSubject(){
    $userID  = $this->session->userdata('user_id');
      $query=$this->db->query("SELECT DISTINCT tbl_subjects.subjectcode,
tbl_subjects.classcode,
tbl_subjects.subject_name
FROM tbl_subjects left join tbl_teacher_info ON tbl_subjects.teacher_code = tbl_teacher_info.staffcode WHERE tbl_subjects.teacher_code = '".$userID."' GROUP BY tbl_subjects.subject_name DESC");
        return $query->result_array();
    }



    public function GetSeatworkBySubjectCode($params = array(),$quarter){
          $userID  = $this->session->userdata('user_id');
          // $quarter = "1st quarter";
      if(array_key_exists("conditions",$params)){
          foreach ($params['conditions'] as $key => $value) {
            $query = $this->db->query("SELECT DISTINCT tbl_activities_seatwork.seatwork_id,
                    tbl_activities_seatwork.seatwork_title,
                    tbl_activities_seatwork.editor_content,
                    tbl_activities_seatwork.attached_file,
                    tbl_activities_seatwork.type,
                    tbl_activities_seatwork.term,
                    tbl_activities_seatwork.score,
                    tbl_activities_seatwork.status,
                    tbl_activities_seatwork.deadline,
                    tbl_activities_seatwork.created_at,
                    tbl_subjects.subject_name
FROM tbl_activities_seatwork LEFT JOIN tbl_subjects ON tbl_subjects.subjectcode = tbl_activities_seatwork.subject_id
WHERE tbl_activities_seatwork.teacher_id = '".$userID."' AND tbl_activities_seatwork.term = '".$quarter."' AND tbl_activities_seatwork.subject_id = '".$value."'");
          }
      }
      $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
      return $result;
    }



    public function GetHomeworkbySubjectCode($params = array(),$quarter){
          $userID  = $this->session->userdata('user_id');
      if(array_key_exists("conditions",$params)){
          foreach ($params['conditions'] as $key => $value) {
            $query = $this->db->query("SELECT DISTINCT
                    tbl_activities_homework.homework_id,
                    tbl_activities_homework.homework_title,
                    tbl_activities_homework.editor_content,
                    tbl_activities_homework.attached_file,
                    tbl_activities_homework.type,
                    tbl_activities_homework.term,
                    tbl_activities_homework.score,
                    tbl_activities_homework.status,
                    tbl_activities_homework.deadline,
                    tbl_activities_homework.created_at,
                    tbl_subjects.subject_name
FROM tbl_activities_homework LEFT JOIN tbl_subjects ON tbl_subjects.subjectcode = tbl_activities_homework.subject_id
WHERE tbl_activities_homework.teacher_id = '".$userID."' AND tbl_activities_homework.term = '".$quarter."' AND tbl_activities_homework.subject_id = '".$value."'");
          }
      }
      $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
      return $result;
    }




    function browse_classes_by_teacher($userCode)
    {
        // $this->db->select('tbl_subjects');
        // // $this->db->group_by('classcode');
        // $this->db->join('tbl_teacher_info', 'tbl_teacher_info.staffcode = tbl_subjects.teacher_code');
        // $query = $this->db->get_where('tbl_subjects', array(
        //     'teacher_code' => $this->session->teacher_code,
        // ));
      $query=$this->db->query("SELECT DISTINCT tbl_subjects.subjectcode,
tbl_subjects.classcode,
tbl_subjects.subject_name

FROM tbl_subjects left join tbl_teacher_info ON tbl_subjects.teacher_code = tbl_teacher_info.staffcode WHERE tbl_subjects.teacher_code = '".$userCode."' GROUP BY tbl_subjects.subject_name DESC");
        return $query->result_array();
    }

    function search_class_info($data)
    {
        $this->db->group_by('tbl_subjects.classcode');
        $this->db->join('tbl_subjects', 'tbl_subjects.classcode = tbl_students.classcode');
        $query = $this->db->get_where('tbl_students', array(
            'tbl_students.classcode' => $data,
        ));
        return $query->result_array();
    }

    function search_classcode_info($data)
    {
        // $this->db->group_by('classcode');
        // $this->db->join('tbl_subject', 'tbl_subject.subject_id = tbl_students.classcode');
        $query = $this->db->get_where('tbl_subjects', array(
            'subjectcode' => $data,
        ));
        return $query->result_array();
    }

    function search_class_info_quiz($data, $term)
    {
        // $this->db->join('tbl_students_sub as tstudsub', 'tstudsub.student_id = ttqr.student_id');
        $this->db->join('tbl_students as tstud', 'tstud.student_number = ttqr.student_id');
        $query = $this->db->get_where('tbl_test_quiz_result as ttqr', array(
            'ttqr.class_id' => $data,
            'ttqr.term' => $term,
            'ttqr.teacher_id' => $this->session->user_id,
        ));
        return $query->result_array();
    }

    function search_class_info_exam($data, $term)
    {
        // $this->db->join('tbl_students_sub as tstudsub', 'tstudsub.student_id = tter.student_id');
        $this->db->join('tbl_students as tstud', 'tstud.student_number = tter.student_id');
        $query = $this->db->get_where('tbl_test_exam_result as tter', array(
            'tter.class_id' => $data,
            'tter.term' => $term,
            'tter.teacher_id' => $this->session->user_id,
        ));
        return $query->result_array();
    }

    function search_class_info_final_exam($data, $term)
    {
        // $this->db->join('tbl_students_sub as tstudsub', 'tstudsub.student_id = ttfr.student_id');
        $this->db->join('tbl_students as tstud', 'tstud.student_number = ttfr.student_id');
        $query = $this->db->get_where('tbl_test_final_result as ttfr', array(
            'ttfr.class_id' => $data,
            'ttfr.term' => $term,
            'ttfr.teacher_id' => $this->session->user_id,
        ));
        return $query->result_array();
    }

    function search_student($data)
    {
        $this->db->like('firstname', $data);
        $this->db->or_like('middlename', $data);
        $this->db->or_like('lastname', $data);
        $this->db->or_like('student_number', $data);
        $this->db->order_by('admission_id', 'desc');
        $query = $this->db->get_where('tbl_students');
        return $query->result_array();
    }

    function search_class($data)
    {
        $this->db->like('subjectcode', $data);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get_where('tbl_subjects', array('teacher_code' => $this->session->user_id));
        return $query->result_array();
    }

    function search_student_by_teacher($data)
    {
        // $this->db->group_by('tsub.classcode');
        $this->db->join('tbl_subjects as tsub', 'tsub.classcode = tstud.classcode', 'left');
        $this->db->join('tbl_teacher_info as tti', 'tti.staffcode = tsub.teacher_code', 'left');

        $query = $this->db->get_where('tbl_students as tstud', array(
            'tti.staffcode' => $data,
        ));
        return $query->result_array();
    }

    function search_class_by_teacher()
    {
        // $this->db->group_by('tsub.classcode');
        // // $this->db->join('tbl_subjects as tsub', 'tsub.classcode = tstud.classcode', 'left');
        // // $this->db->join('tbl_teacher_info as tti', 'tti.staffcode = tsub.teacher_code', 'left');
        // // $this->db->distinct();
        // // $this->db->select('tsub.classcode', 'tsub.subjectcode', 'tsub.id');
        // $query = $this->db->get_where('tbl_subjects as tsub', array(
        //     'tsub.teacher_code' => $data,
        // ));
        // return $query->result_array();
        $userId = $this->session->userdata('user_id');
        $query=$this->db->query("SELECT DISTINCT tbl_subjects.subjectcode,
  tbl_subjects.classcode,
  tbl_subjects.subject_name,
    tbl_subjects.schedule
  FROM tbl_subjects left join tbl_teacher_info ON tbl_subjects.teacher_code = tbl_teacher_info.staffcode WHERE tbl_subjects.teacher_code = '".$userId."' GROUP BY tbl_subjects.subject_name DESC");

      $result = ($query->num_rows() > 0) ? $query->result_array() :FALSE;
          return $result;
    }


      public function GetHomeworkClass(){
        $userId = $this->session->userdata('user_id');
        $query=$this->db->query("SELECT DISTINCT tbl_subjects.subjectcode,
  tbl_subjects.classcode,
  tbl_subjects.subject_name,
    tbl_subjects.schedule
  FROM tbl_subjects left join tbl_teacher_info ON tbl_subjects.teacher_code = tbl_teacher_info.staffcode WHERE tbl_subjects.teacher_code = '".$userId."' GROUP BY tbl_subjects.subject_name DESC");

      $result = ($query->num_rows() > 0) ? $query->result() :FALSE;
          return $result;

      }


    function browse_seatworks($data)
    {
        $this->db->select('tblsub.subject_name,tblsub.subjectcode , tblseat.seatwork_id,
                tblseat.seatwork_title,
                tblseat.editor_content,
                tblseat.attached_file,
                tblseat.type,
                tblseat.term,
                tblseat.score,
                tblseat.status,
                tblseat.deadline,
                tblseat.created_at ');
        $this->db->distinct();
        $this->db->from('tbl_activities_seatwork as tblseat');
        $this->db->join('tbl_subjects as tblsub', 'tblsub.subjectcode = tblseat.subject_id' , 'left');
        // $query = $this->db->get_where('tblseat', array(
        //     'term' => $data,
        //     'teacher_id' => $this->session->user_id,
        // ));\
      $this->db->where('term' , $data);
      $this->db->where('teacher_id' , $this->session->user_id);
          $query =  $this->db->get();
        return $query->result_array();
    }

    function browse_homeworks($data)
    {
        // $query = $this->db->get_where('tbl_activities_homework', array(
        //     'term' => $data,
        //     'teacher_id' => $this->session->user_id,
        // ));
        //
        // return $query->result_array();
        $this->db->select('tblsub.subject_name,
                tblsub.subjectcode ,
                tblhome.homework_id,
                tblhome.homework_title,
                tblhome.editor_content,
                tblhome.attached_file,
                tblhome.type,
                tblhome.term,
                tblhome.score,
                tblhome.status,
                tblhome.deadline,
                tblhome.created_at');
        $this->db->distinct();
        $this->db->from('tbl_activities_homework as tblhome');
        $this->db->join('tbl_subjects as tblsub', 'tblsub.subjectcode = tblhome.subject_id' , 'left');
      $this->db->where('term' , $data);
      $this->db->where('teacher_id' , $this->session->user_id);
          $query =  $this->db->get();
        return $query->result_array();
    }

    function browse_seatwork_by_id($data)
    {
        $query = $this->db->get_where('tbl_activities_seatwork', array(
            'seatwork_id' => $data,
        ));
        return $query->result_array();
    }

    function browse_homework_by_id($data)
    {
        $query = $this->db->get_where('tbl_activities_homework', array(
            'homework_id' => $data,
        ));
        return $query->result_array();
    }

    function delete_seatwork($seatwork_id)
    {
        $this->db->where('seatwork_id', $seatwork_id);
        $this->db->delete('tbl_activities_seatwork');
    }

    function delete_homework($homework_id)
    {
        $this->db->where('homework_id', $homework_id);
        $this->db->delete('tbl_activities_homework');
    }

    function update_seatwork($data)
    {
        $data = array(
            'seatwork_id' => $data['seatwork_id'],
            'teacher_id' => $this->session->user_id,
            'subject_id' => $data['subject_id'],
            'student_id' => $data['student_id'],
            'seatwork_title' => $data['seatwork_title'],
            'editor_content' => $data['editor_content'],
            // 'attached_file' => trim($this->input->post('userfile')),
            'type' => 'seatwork',
            'term' => $data['term'],
            'score' => $data['score'],
            'status' => 1,
            'deadline' => $data['deadline'],
            // 'created_at' => date('Y-m-d h:i:s'),
            'updated_at' => date('Y-m-d h:i:s'),
        );

        $this->db->where('seatwork_id', $data['seatwork_id']);
        $this->db->update('tbl_activities_seatwork', $data);
    }

    function update_homework($data)
    {
        $data = array(
            'homework_id' => $data['homework_id'],
            'teacher_id' => $this->session->user_id,
            'subject_id' => $data['subject_id'],
            'student_id' => $data['student_id'],
            'homework_title' => $data['homework_title'],
            'editor_content' => $data['editor_content'],
            // 'attached_file' => trim($this->input->post('userfile')),
            'type' => 'homework',
            'term' => $data['term'],
            'score' => $data['score'],
            'status' => 1,
            'deadline' => $data['deadline'],
            // 'created_at' => date('Y-m-d h:i:s'),
            'updated_at' => date('Y-m-d h:i:s'),
        );

        $this->db->where('homework_id', $data['homework_id']);
        $this->db->update('tbl_activities_homework', $data);
    }

    function toggle_publish_quiz($is_published, $quiz_result_id)
    {
        $data = array(
            'quiz_result_id' => $quiz_result_id,
            'is_publish' => $is_published,
        );

        $this->db->where('quiz_result_id', $data['quiz_result_id']);
        $this->db->update('tbl_test_quiz_result', $data);
    }

    function toggle_publish_exam($is_published, $exam_result_id)
    {
        $data = array(
            'exam_result_id' => $exam_result_id,
            'is_publish' => $is_published,
        );

        $this->db->where('exam_result_id', $data['exam_result_id']);
        $this->db->update('tbl_test_exam_result', $data);
    }

    function toggle_publish_final_exam($is_published, $final_result_id)
    {
        $data = array(
            'final_result_id' => $final_result_id,
            'is_publish' => $is_published,
        );

        $this->db->where('final_result_id', $data['final_result_id']);
        $this->db->update('tbl_test_exam_result', $data);
    }






    function read_subjects_by_class()
    {

        // $query = $this->db->get_where('tbl_subjects', array(
        //     'subjectcode' => $data,
        //     'teacher_code' => $this->session->user_id
        // ));
        // return $query->result_array();
  $userId = $this->session->userdata('user_id');
        $query = $this->db->query("SELECT DISTINCT tbl_subjects.subjectcode , tbl_subjects.subject_name
          FROM tbl_subjects WHERE tbl_subjects.student_id = '".$userId."' GROUP BY tbl_subjects.subject_name DESC");
          return $query->result_array();

    }

    function browse_seatworks_stud_class($class, $term)
    {
        // $this->db->where('subject_id', $class);
        // $query = $this->db->get_where('tbl_activities_seatwork', array(
        //     'term' => $term,
        // ));
        //
        // return $query->result_array();
        $userId = $this->session->userdata('user_id');
$query = $this->db->query("SELECT DISTINCT tbl_activities_seatwork.seatwork_id ,
tbl_activities_seatwork.seatwork_title,
tbl_activities_seatwork.editor_content,
tbl_activities_seatwork.attached_file,
tbl_activities_seatwork.type,
tbl_activities_seatwork.term,
tbl_activities_seatwork.score,
tbl_activities_seatwork.status,
tbl_activities_seatwork.deadline,
tbl_activities_seatwork.created_at,
tbl_teacher_info.name,
tbl_teacher_info.email
FROM tbl_activities_seatwork LEFT JOIN tbl_subjects
ON tbl_activities_seatwork.subject_id = tbl_subjects.subjectcode
INNER JOIN tbl_teacher_info ON tbl_teacher_info.staffcode = tbl_subjects.teacher_code
WHERE tbl_subjects.student_id = '".$userId."' AND tbl_subjects.subjectcode = '".$class."' AND tbl_activities_seatwork.term = '".$term."'  ORDER BY tbl_activities_seatwork.created_at DESC");
return $query->result_array();

    }

    function browse_seatworks_stud_term($term)
    {
        // $query = $this->db->get_where('tbl_activities_seatwork', array(
        //     'term' => $term,
        //     'student_id'=> $this->session->user_id
        // ));
        //
        // return $query->result_array();
        $userId = $this->session->userdata('user_id');
$query = $this->db->query("SELECT DISTINCT tbl_activities_seatwork.seatwork_id ,
tbl_activities_seatwork.seatwork_title,
tbl_activities_seatwork.editor_content,
tbl_activities_seatwork.attached_file,
tbl_activities_seatwork.type,
tbl_activities_seatwork.term,
tbl_activities_seatwork.score,
tbl_activities_seatwork.status,
tbl_activities_seatwork.deadline,
tbl_activities_seatwork.created_at,
tbl_teacher_info.name,
tbl_teacher_info.email
FROM tbl_activities_seatwork LEFT JOIN tbl_subjects
ON tbl_activities_seatwork.subject_id = tbl_subjects.subjectcode
INNER JOIN tbl_teacher_info ON tbl_teacher_info.staffcode = tbl_subjects.teacher_code
WHERE tbl_subjects.student_id = '".$userId."' AND tbl_activities_seatwork.term = '".$term."'  ORDER BY tbl_activities_seatwork.created_at DESC");
return $query->result_array();

    }

    function browse_submitted_seatworks_class($class, $term)
    {
        // $this->db->where('subject_id', $class);
        // $query = $this->db->get_where('tbl_activities_seatwork_reply', array(
        //     'term' => $term,
        // ));
        //
        // return $query->result_array();
        $userID = $this->session->userdata('user_id');
        $query = $this->db->query("SELECT DISTINCT tbl_activities_seatwork_reply.sw_reply_id ,
        tbl_activities_seatwork_reply.seatwork_title,
        tbl_activities_seatwork_reply.editor_content,
        tbl_activities_seatwork_reply.attached_file,
        tbl_activities_seatwork_reply.type,
        tbl_activities_seatwork_reply.term,
        tbl_activities_seatwork_reply.student_score,
        tbl_activities_seatwork_reply.status,
        tbl_activities_seatwork_reply.subject_id,
        tbl_activities_seatwork_reply.created_at,
        tbl_activities_seatwork_reply.seatwork_id,
        tbl_activities_seatwork.score FROM tbl_activities_seatwork_reply LEFT JOIN tbl_activities_seatwork ON tbl_activities_seatwork.seatwork_id = tbl_activities_seatwork_reply.seatwork_id
        WHERE tbl_activities_seatwork_reply.teacher_id  = '".$userID."' AND tbl_activities_seatwork_reply.term = '".$term."' AND   tbl_activities_seatwork_reply.subject_id = '".$class."' ");
        return $query->result_array();
    }

    function browse_submitted_seatworks_term($term)
    {
        // $query = $this->db->get_where('tbl_activities_seatwork_reply', array(
        //     'term' => $term,
        // ));
        $userID = $this->session->userdata('user_id');
        $query = $this->db->query("SELECT DISTINCT tbl_activities_seatwork_reply.sw_reply_id ,
                tbl_activities_seatwork_reply.seatwork_title,
                tbl_activities_seatwork_reply.editor_content,
                tbl_activities_seatwork_reply.attached_file,
                tbl_activities_seatwork_reply.type,
                tbl_activities_seatwork_reply.term,
                tbl_activities_seatwork_reply.student_score,
                tbl_activities_seatwork_reply.status,
                tbl_activities_seatwork_reply.created_at,
                tbl_activities_seatwork_reply.seatwork_id,
                tbl_activities_seatwork.score FROM tbl_activities_seatwork_reply LEFT JOIN tbl_activities_seatwork ON tbl_activities_seatwork.seatwork_id = tbl_activities_seatwork_reply.seatwork_id
                WHERE tbl_activities_seatwork_reply.teacher_id  = '".$userID."' AND tbl_activities_seatwork_reply.term = '".$term."' ");
          return $query->result_array();
    }


    function open_seatwork($seatwork_id)
    {
        $query = $this->db->get_where('tbl_activities_seatwork', array(
            'seatwork_id' => $seatwork_id,
        ));
        return $query->result_array();
    }

    function open_seatwork_teacher($sw_reply_id)
    {
        $this->db->join('tbl_activities_seatwork as tas', 'tas.seatwork_id = tasr.seatwork_id');
        $this->db->select('tas.score, tasr.*');
        $query = $this->db->get_where('tbl_activities_seatwork_reply as tasr', array(
            'tasr.sw_reply_id' => $sw_reply_id,
        ));
        return $query->result_array();
    }

    function submit_seatwork($data)
    {
        $this->db->insert('tbl_activities_seatwork_reply', $data);
    }

    function submit_seatwork_score($data)
    {
        $data = array(
            'sw_reply_id' => $data['sw_reply_id'],
            'seatwork_id' => $data['seatwork_id'],
            'student_score' => $data['student_score'],
            'updated_at' => date('Y-m-d h:i:s'),
        );

        $this->db->where(array(
            'sw_reply_id' => $data['sw_reply_id'],
            'seatwork_id' => $data['seatwork_id'],
        ));
        $this->db->update('tbl_activities_seatwork_reply', $data);
    }



    function browse_homeworks_stud_class($class, $term)
    {
      $userID = $this->session->userdata('user_id');
$query = $this->db->query("SELECT DISTINCT tbl_activities_homework.homework_id,
tbl_activities_homework.homework_title,
tbl_activities_homework.editor_content,
tbl_activities_homework.attached_file,
tbl_activities_homework.type,
tbl_activities_homework.term,
tbl_activities_homework.score,
tbl_activities_homework.status,
tbl_activities_homework.deadline,
tbl_activities_homework.created_at
FROM tbl_activities_homework LEFT JOIN tbl_subjects ON tbl_subjects.subjectcode = tbl_activities_homework.subject_id WHERE tbl_subjects.student_id = '".$userID."' AND tbl_activities_homework.term = '".$term."' AND tbl_activities_homework.subject_id = '".$class."' ");
return $query->result_array();
    }

    function browse_homeworks_stud_term($term)
    {
        // $query = $this->db->get_where('tbl_activities_homework', array(
        //     'term' => $term,
        //     'student_id'=> $this->session->user_id
        // ));
              $userID = $this->session->userdata('user_id');
        $query = $this->db->query("SELECT DISTINCT tbl_activities_homework.homework_id,
tbl_activities_homework.homework_title,
tbl_activities_homework.editor_content,
tbl_activities_homework.attached_file,
tbl_activities_homework.type,
tbl_activities_homework.term,
tbl_activities_homework.score,
tbl_activities_homework.status,
tbl_activities_homework.deadline,
tbl_activities_homework.created_at
FROM tbl_activities_homework LEFT JOIN tbl_subjects ON tbl_subjects.subjectcode = tbl_activities_homework.subject_id WHERE tbl_subjects.student_id = '".$userID."' AND tbl_activities_homework.term = '".$term."'");
        return $query->result_array();
    }

    function browse_submitted_homeworks_class($class, $term)
    {
        // $this->db->where('subject_id', $class);
        // $query = $this->db->get_where('tbl_activities_homework_reply', array(
        //     'term' => $term,
        // ));
        //
        // return $query->result_array();
        $userID = $this->session->userdata('user_id');
          $query = $this->db->query("SELECT DISTINCT tbl_activities_homework_reply.hw_reply_id ,
  tbl_activities_homework_reply.homework_title,
  tbl_activities_homework_reply.editor_content,
  tbl_activities_homework_reply.attached_file,
  tbl_activities_homework_reply.type,
  tbl_activities_homework_reply.term,
  tbl_activities_homework_reply.student_score,
  tbl_activities_homework_reply.status,
  tbl_activities_homework_reply.subject_id,
  tbl_activities_homework_reply.created_at,
  tbl_activities_homework.homework_id,
  tbl_activities_homework.score FROM tbl_activities_homework_reply LEFT JOIN tbl_activities_homework ON tbl_activities_homework.homework_id = tbl_activities_homework_reply.homework_id
  WHERE tbl_activities_homework_reply.teacher_id  = '".$userID."' AND tbl_activities_homework_reply.term = '".$term."' AND   tbl_activities_homework_reply.subject_id = '".$class."' ");
            return $query->result_array();
    }

    function browse_submitted_homeworks_term($term)
    {
        // $query = $this->db->get_where('tbl_activities_homework_reply', array(
        //     'term' => $term,
        // ));
        //
        // return $query->result_array();
        $userID = $this->session->userdata('user_id');
          $query = $this->db->query("SELECT DISTINCT
      tbl_activities_homework_reply.hw_reply_id ,
  tbl_activities_homework_reply.homework_title,
  tbl_activities_homework_reply.editor_content,
  tbl_activities_homework_reply.attached_file,
  tbl_activities_homework_reply.type,
  tbl_activities_homework_reply.term,
  tbl_activities_homework_reply.student_score,
  tbl_activities_homework_reply.status,
  tbl_activities_homework_reply.created_at,
  tbl_activities_homework.homework_id,
  tbl_activities_homework.score
  FROM tbl_activities_homework_reply LEFT JOIN tbl_activities_homework ON tbl_activities_homework.homework_id = tbl_activities_homework_reply.homework_id
  WHERE tbl_activities_homework_reply.teacher_id  = '".$userID."' AND tbl_activities_homework_reply.term = '".$term."' ");
            return $query->result_array();
    }

    function open_homework($homework_id)
    {
        $query = $this->db->get_where('tbl_activities_homework', array(
            'homework_id' => $homework_id,
        ));
        return $query->result_array();
    }

    function open_homework_teacher($hw_reply_id)
    {
        $this->db->join('tbl_activities_homework as tah', 'tah.homework_id = tahr.homework_id');
        $this->db->select('tah.score, tahr.*');
        $query = $this->db->get_where('tbl_activities_homework_reply as tahr', array(
            'tahr.hw_reply_id' => $hw_reply_id,
        ));
        return $query->result_array();
    }

    function submit_homework($data)
    {
        $this->db->insert('tbl_activities_homework_reply', $data);
    }

    function submit_homework_score($data)
    {
        $data = array(
            'homework_id' => $data['homework_id'],
            'student_score' => $data['student_score'],
            'updated_at' => date('Y-m-d h:i:s'),
        );

        $this->db->where('homework_id', $data['homework_id']);
        $this->db->update('tbl_activities_homework_reply', $data);
    }



    function read_subjects_by_teacher_sw()
    {
        $this->db->join('tbl_subjects', 'subject_id = id', 'left');
        $query = $this->db->get_where('tbl_activities_seatwork_reply', array(
            'teacher_code' => $this->session->user_id,
        ));
        return $query->result_array();
    }

    function read_subjects_by_teacher_hw()
    {
        $this->db->join('tbl_subjects', 'subject_id = id', 'left');
        $query = $this->db->get_where('tbl_activities_homework_reply', array(
            'teacher_code' => $this->session->user_id,
        ));
        return $query->result_array();
    }

    function get_all_subject_by_teacher()
    {
        // $this->db->distinct();
        // $this->db->select('subjectcode');
        // $query = $this->db->get_where('tbl_subjects', array(
        //     'teacher_code' => $this->session->user_id,
        // ));
        // return $query->result_array();
        $userId = $this->session->userdata('user_id');
        $query=$this->db->query("SELECT DISTINCT tbl_subjects.subjectcode,
  tbl_subjects.classcode,
  tbl_subjects.subject_name
  FROM tbl_subjects left join tbl_teacher_info ON tbl_subjects.teacher_code = tbl_teacher_info.staffcode WHERE tbl_subjects.teacher_code = '".$userId."' GROUP BY tbl_subjects.subject_name DESC");
      $result = ($query->num_rows() > 0) ? $query->result_array() :FALSE;
          return $result;
    }



// START PLAYYLIST VIDEO
    public function GetMylistSubject(){
      $userId = $this->session->userdata('user_id');
          $query =$this->db->query("SELECT DISTINCT  tbl_subjects.id, tbl_subjects.subjectcode , tbl_subjects.subject_name FROM tbl_subjects WHERE tbl_subjects.student_id = '".$userId."' GROUP BY tbl_subjects.subject_name ASC");
          $result = ($query->num_rows() > 0) ?$query->result() :FALSE;
          return $result;
    }

public function GetplayList($params = array()){
    $userId = $this->session->userdata('user_id');

    if(array_key_exists("conditions",$params)){
        foreach ($params['conditions'] as $key => $value) {
  $query = $this->db->query("SELECT DISTINCT
tbl_subjects.subjectcode ,
tbl_subjects.subject_name,
tbl_videolesson.id,
tbl_videolesson.lesson_number,
tbl_videolesson.lesson_topic,
tbl_videolesson.lesson_instruct,
tbl_videolesson.youtube_link,
tbl_videolesson.created_at,
tbl_teacher_info.name,
tbl_teacher_info.email
FROM tbl_subjects RIGHT JOIN tbl_videolesson ON tbl_videolesson.Subject_code = tbl_subjects.subjectcode LEFT JOIN tbl_teacher_info ON tbl_teacher_info.staffcode = tbl_videolesson.Teacher_id
 WHERE tbl_subjects.student_id = '".$userId."' AND
tbl_subjects.subjectcode = '".$value."' ORDER BY tbl_videolesson.created_at DESC");
}
}
$result = ($query->num_rows() > 0) ?$query->result_array() :FALSE;
return $result;
}

public function LessonId($params = array()){
  $userId = $this->session->userdata('user_id');

  if(array_key_exists("conditions",$params)){
      foreach ($params['conditions'] as $key => $value) {
$query = $this->db->query("SELECT DISTINCT
tbl_subjects.subjectcode ,
tbl_subjects.subject_name,
tbl_videolesson.id,
tbl_videolesson.lesson_number,
tbl_videolesson.lesson_topic,
tbl_videolesson.lesson_instruct,
tbl_videolesson.youtube_link,
tbl_videolesson.created_at,
tbl_teacher_info.name,
tbl_teacher_info.email
FROM tbl_subjects RIGHT JOIN tbl_videolesson ON tbl_videolesson.Subject_code = tbl_subjects.subjectcode LEFT JOIN tbl_teacher_info ON tbl_teacher_info.staffcode = tbl_videolesson.Teacher_id
WHERE tbl_subjects.student_id = '".$userId."' AND
tbl_videolesson.id = '".$value."' ORDER BY tbl_videolesson.created_at DESC");
}
}
$result = ($query->num_rows() > 0) ?$query->result_array() :FALSE;
return $result;
}










}
