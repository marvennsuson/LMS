<?php
class Migration_exam extends CI_Model {

    public $db;
    function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('nvac_lms_2020', TRUE);
    }
    
    function insert_exam_header($data)
    {
        $this->db->insert('tbl_exam_header', $data);
    }

    function read_exam_header()
    {
        $this->db->order_by("exam_header_id", "desc");
        $query = $this->db->get_where('tbl_exam_header', array('created_by' => $this->session->user_id));
        return $query->result_array();
    }

    function delete_exam_header($exam_header_id)
    {
        $this->db->where('created_by', $this->session->user_id);
        $this->db->where('exam_header_id', $exam_header_id);
        $this->db->delete('tbl_exam_header');
    }

    function browse_exam_header($exam_header_id)
    {
        $query = $this->db->get_where('tbl_exam_header', array(
            'created_by' => $this->session->user_id, 
            'exam_header_id' => $exam_header_id,
        ));
        return $query->result_array();
    }

    function edit_exam_header($data)
    {
        $data = array(
            'classcode' => '',
            'exam_header_id' => $data['exam_header_id'],
            'term' => $data['term'],
            'type' => $data['type'],
            'exam_title' => $data['exam_title'],
            // 'exam_attempt' => $data['exam_attempt'],
            'expiration_date' => $data['expiration_date'],
            // 'passing_rate' => $data['passing_rate'],
            'time_duration' => $data['time_duration'],
            'instruction' => $data['instruction'],
            'created_by' => $this->session->user_id,
            'updated_at' => date('Y-m-d h:i:s'),
        );
    
        $this->db->where('exam_header_id', $data['exam_header_id']);
        $this->db->update('tbl_exam_header', $data);
    }

    function read_exam_body()
    {
        $this->db->order_by("exam_body_id", "desc");
        $query = $this->db->get_where('tbl_exam_body', array('created_by' => $this->session->user_id));
        return $query->result_array();
    }

    function add_exam_body($data)
    {
        $this->db->insert('tbl_exam_body', $data);
    }

    function edit_exam_body($data)
    {
        $data = array(
            'classcode' => '',
            'exam_body_id' => $data['exam_body_id'],
            'exam_body_title' => $data['exam_body_title'],
            'exam_created_form' => $data['exam_created_form'],
            'total_points' => $data['total_points'],
            // 'is_random' => $data['is_random'],
            'updated_at' => date('Y-m-d h:i:s'),
        );
    
        $this->db->where('exam_body_id', $data['exam_body_id']);
        $this->db->update('tbl_exam_body', $data);
    }

    function browse_exam_body($exam_body_id)
    {
        $query = $this->db->get_where('tbl_exam_body', array(
            'created_by' => $this->session->user_id, 
            'exam_body_id' => $exam_body_id,
        ));
        return $query->result_array();
    }

    function delete_exam_body($exam_body_id)
    {
        $this->db->where('created_by', $this->session->user_id);
        $this->db->where('exam_body_id', $exam_body_id);
        $this->db->delete('tbl_exam_body');
    }

    function browse_all_exam_header()
    {
        $this->db->where('created_by', $this->session->user_id);
        $query = $this->db->get('tbl_exam_header');
        return $query->result_array();
    }

    function browse_all_exam_body()
    {
        $this->db->where('created_by', $this->session->user_id);
        $query = $this->db->get('tbl_exam_body');
        return $query->result_array();
    }
    
    function create_exam($data)
    {
        $this->db->insert('tbl_joined_header_body', $data);
    }

    function browse_exam()
    {
        $this->db->join('tbl_exam_header as teh', 'teh.exam_header_id = tjhb.exam_header_id');
        $this->db->join('tbl_exam_body as teb', 'teb.exam_body_id = tjhb.exam_body_id');
        $query = $this->db->get_where('tbl_joined_header_body as tjhb', array('tjhb.created_by' => $this->session->user_id));
        return $query->result_array();
    }

    function browse_joined_exam($examid)
    {
        $this->db->join('tbl_exam_header', 'tbl_exam_header.exam_header_id = tbl_joined_header_body.exam_header_id');
        $this->db->join('tbl_exam_body', 'tbl_exam_body.exam_body_id = tbl_joined_header_body.exam_body_id');
        $query = $this->db->get_where('tbl_joined_header_body', array(
            'joined_header_body_id' => $examid,
            'tbl_joined_header_body.created_by' => $this->session->user_id,
        ));
        return $query->row_array();
    }

    function edit_exam($data)
    {
        $data = array(
            'joined_header_body_id' => $data['joined_header_body_id'],
            'exam_header_id' => $data['exam_header_id'],
            'exam_body_id' => $data['exam_body_id'],
            'created_by' => $data['created_by'],
            'updated_at' => date('Y-m-d h:i:s'),
        );
    
        $this->db->where('joined_header_body_id', $data['joined_header_body_id']);
        $this->db->update('tbl_joined_header_body', $data);
    }

    function delete_exam($exam_id)
    {
        $this->db->where('created_by', $this->session->user_id);
        $this->db->where('joined_header_body_id', $exam_id);
        $this->db->delete('tbl_joined_header_body');
    }

    function exam_lists($type)
    {
        $this->db->join('tbl_exam_header', 'tbl_exam_header.exam_header_id = tbl_joined_header_body.exam_header_id');
        $this->db->join('tbl_exam_body', 'tbl_exam_body.exam_body_id = tbl_joined_header_body.exam_body_id');
        $this->db->join('tbl_joined_header_body_assigned', 'tbl_joined_header_body_assigned.joined_header_body_id = tbl_joined_header_body.exam_body_id');
        $query = $this->db->get_where('tbl_joined_header_body', array('tbl_exam_header.type' => $type));
        return $query->result_array();
    }

    
    function read_exam($data)
    {
        $this->db->join('tbl_joined_header_body as tjhb', 'tjhb.joined_header_body_id = tjhba.joined_header_body_id');
        $this->db->join('tbl_exam_body as teb', 'teb.exam_body_id = tjhb.exam_body_id');
        $this->db->join('tbl_exam_header as teh', 'teh.exam_header_id = tjhb.exam_header_id');
        
        $query = $this->db->get_where('tbl_joined_header_body_assigned as tjhba', array(
            'tjhba.joined_header_body_id'=> $data));
        return $query->row_array();
    }

    function submit_exam($data)
    {
        $examType = array(
            'type' => $data['type'],
        );

        if($examType['type'] == 'quiz'){

            $examData = array(
                'class_id' => $data['classes_id'],
                // 'joined_header_body_id' => $data['joined_header_body_id'],
                'exam_header_id' => $data['exam_header_id'],
                'exam_body_id' => $data['exam_body_id'],
                'student_id' => $data['student_id'],
                'teacher_id' => $data['teacher_id'],
                'term' => $data['term'],
                'created_at' => date('Y-m-d h:i:s'),
                'qz1' =>  $data['score'],
                // 'updated_at' => date('Y-m-d h:i:s'),
            );

            if($examData['term'] == '1st quarter')
            {
                // $this->db->select('quiz_result_id');
                $query = $this->db->get_where('tbl_test_quiz_result', array(
                    'class_id' => $examData['class_id'],
                    'term' => $examData['term'],
                    'student_id' => $examData['student_id'],
                ));
                $result = $query->row_array();
                if($result)
                {
                    for($i=1; $i<=15; $i++)
                    {
                        if($result['qz'.$i] != NULL)
                        {
                            continue;
                        } else {
                            $examData['score'] = $data['score'];
                            $this->db->set('qz'.$i, $examData['score']);
                            $this->db->where('quiz_result_id', $result['quiz_result_id']);
                            $this->db->where('qz'.$i, NULL);
                            $this->db->update('tbl_test_quiz_result');
                            break;
                        }
                    }
                } else {
                    $this->db->insert('tbl_test_quiz_result', $examData);
                }
            }

            if($examData['term'] == '2nd quarter')
            {
                // $this->db->select('quiz_result_id');
                $query = $this->db->get_where('tbl_test_quiz_result', array(
                    'class_id' => $examData['class_id'],
                    'term' => $examData['term'],
                    'student_id' => $examData['student_id'],
                ));
                $result = $query->row_array();
                if($result)
                {
                    for($i=1; $i<=15; $i++)
                    {
                        if($result['qz'.$i] != NULL)
                        {
                            continue;
                        } else {
                            $examData['score'] = $data['score'];
                            $this->db->set('qz'.$i, $examData['score']);
                            $this->db->where('quiz_result_id', $result['quiz_result_id']);
                            $this->db->where('qz'.$i, NULL);
                            $this->db->update('tbl_test_quiz_result');
                            break;
                        }
                    }
                } else {
                    $this->db->insert('tbl_test_quiz_result', $examData);
                }
            }

            if($examData['term'] == '3rd quarter')
            {
                // $this->db->select('quiz_result_id');
                $query = $this->db->get_where('tbl_test_quiz_result', array(
                    'class_id' => $examData['class_id'],
                    'term' => $examData['term'],
                    'student_id' => $examData['student_id'],
                ));
                $result = $query->row_array();
                if($result)
                {
                    for($i=1; $i<=15; $i++)
                    {
                        if($result['qz'.$i] != NULL)
                        {
                            continue;
                        } else {
                            $examData['score'] = $data['score'];
                            $this->db->set('qz'.$i, $examData['score']);
                            $this->db->where('quiz_result_id', $result['quiz_result_id']);
                            $this->db->where('qz'.$i, NULL);
                            $this->db->update('tbl_test_quiz_result');
                            break;
                        }
                    }
                } else {
                    $this->db->insert('tbl_test_quiz_result', $examData);
                }
            }

            if($examData['term'] == '4th quarter')
            {
                // $this->db->select('quiz_result_id');
                $query = $this->db->get_where('tbl_test_quiz_result', array(
                    'class_id' => $examData['class_id'],
                    'term' => $examData['term'],
                    'student_id' => $examData['student_id'],
                ));
                $result = $query->row_array();
                if($result)
                {
                    for($i=1; $i<=15; $i++)
                    {
                        if($result['qz'.$i] != NULL)
                        {
                            continue;
                        } else {
                            $examData['score'] = $data['score'];
                            $this->db->set('qz'.$i, $examData['score']);
                            $this->db->where('quiz_result_id', $result['quiz_result_id']);
                            $this->db->where('qz'.$i, NULL);
                            $this->db->update('tbl_test_quiz_result');
                            break;
                        }
                    }
                } else {
                    $this->db->insert('tbl_test_quiz_result', $examData);
                }
            }
        }


        if($examType['type'] == 'exam'){

            $examData = array(
                'class_id' => $data['classes_id'],
                // 'joined_header_body_id' => $data['joined_header_body_id'],
                'exam_header_id' => $data['exam_header_id'],
                'exam_body_id' => $data['exam_body_id'],
                'student_id' => $data['student_id'],
                'teacher_id' => $data['teacher_id'],
                'term' => $data['term'],
                'created_at' => date('Y-m-d h:i:s'),
                'exm1' =>  $data['score'],
                // 'updated_at' => date('Y-m-d h:i:s'),
            );

            if($examData['term'] == '1st quarter')
            {
                $query = $this->db->get_where('tbl_test_exam_result', array(
                    'class_id' => $examData['class_id'],
                    'term' => $examData['term'],
                    'student_id' => $examData['student_id'],
                ));
                $result = $query->row_array();
                if($result)
                {
                    for($i=1; $i<=10; $i++)
                    {
                        if($result['exm'.$i] != NULL)
                        {
                            continue;
                        } else {
                            $examData['score'] = $data['score'];
                            $this->db->set('exm'.$i, $examData['score']);
                            $this->db->where('exam_result_id', $result['exam_result_id']);
                            $this->db->where('exm'.$i, NULL);
                            $this->db->update('tbl_test_exam_result');
                            break;
                        }
                    }
                } else {
                    $this->db->insert('tbl_test_exam_result', $examData);
                }
            }

            if($examData['term'] == '2nd quarter')
            {
                $query = $this->db->get_where('tbl_test_exam_result', array(
                    'class_id' => $examData['class_id'],
                    'term' => $examData['term'],
                    'student_id' => $examData['student_id'],
                ));
                $result = $query->row_array();
                if($result)
                {
                    for($i=1; $i<=10; $i++)
                    {
                        if($result['exm'.$i] != NULL)
                        {
                            continue;
                        } else {
                            $examData['score'] = $data['score'];
                            $this->db->set('exm'.$i, $examData['score']);
                            $this->db->where('exam_result_id', $result['exam_result_id']);
                            $this->db->where('exm'.$i, NULL);
                            $this->db->update('tbl_test_exam_result');
                            break;
                        }
                    }
                } else {
                    $this->db->insert('tbl_test_exam_result', $examData);
                }
            }

            if($examData['term'] == '3rd quarter')
            {
                $query = $this->db->get_where('tbl_test_exam_result', array(
                    'class_id' => $examData['class_id'],
                    'term' => $examData['term'],
                    'student_id' => $examData['student_id'],
                ));
                $result = $query->row_array();
                if($result)
                {
                    for($i=1; $i<=10; $i++)
                    {
                        if($result['exm'.$i] != NULL)
                        {
                            continue;
                        } else {
                            $examData['score'] = $data['score'];
                            $this->db->set('exm'.$i, $examData['score']);
                            $this->db->where('exam_result_id', $result['exam_result_id']);
                            $this->db->where('exm'.$i, NULL);
                            $this->db->update('tbl_test_exam_result');
                            break;
                        }
                    }
                } else {
                    $this->db->insert('tbl_test_exam_result', $examData);
                }
            }

            if($examData['term'] == '4th quarter')
            {
                $query = $this->db->get_where('tbl_test_exam_result', array(
                    'class_id' => $examData['class_id'],
                    'term' => $examData['term'],
                    'student_id' => $examData['student_id'],
                ));
                $result = $query->row_array();
                if($result)
                {
                    for($i=1; $i<=10; $i++)
                    {
                        if($result['exm'.$i] != NULL)
                        {
                            continue;
                        } else {
                            $examData['score'] = $data['score'];
                            $this->db->set('exm'.$i, $examData['score']);
                            $this->db->where('exam_result_id', $result['exam_result_id']);
                            $this->db->where('exm'.$i, NULL);
                            $this->db->update('tbl_test_exam_result');
                            break;
                        }
                    }
                } else {
                    $this->db->insert('tbl_test_exam_result', $examData);
                }
            }
        }


        if($examType['type'] == 'final exam'){

            $examData = array(
                'class_id' => $data['classes_id'],
                // 'joined_header_body_id' => $data['joined_header_body_id'],
                'exam_header_id' => $data['exam_header_id'],
                'exam_body_id' => $data['exam_body_id'],
                'student_id' => $data['student_id'],
                'teacher_id' => $data['teacher_id'],
                'term' => $data['term'],
                'created_at' => date('Y-m-d h:i:s'),
                'fexm' =>  $data['score'],
                // 'updated_at' => date('Y-m-d h:i:s'),
            );

            if($examData['term'] == '1st quarter')
            {
                $query = $this->db->get_where('tbl_test_final_result', array(
                    'class_id' => $examData['class_id'],
                    'term' => $examData['term'],
                    'student_id' => $examData['student_id'],
                ));
                $result = $query->row_array();
                if($result)
                {
                    for($i=1; $i<=5; $i++)
                    {
                        if($result['fexm'.$i] != NULL)
                        {
                            continue;
                        } else {
                            $examData['score'] = $data['score'];
                            $this->db->set('fexm'.$i, $examData['score']);
                            $this->db->where('final_result_id', $result['final_result_id']);
                            $this->db->where('fexm'.$i, NULL);
                            $this->db->update('tbl_test_final_result');
                            break;
                        }
                    }
                } else {
                    $this->db->insert('tbl_test_final_result', $examData);
                }
            }

            if($examData['term'] == '2nd quarter')
            {
                $query = $this->db->get_where('tbl_test_final_result', array(
                    'class_id' => $examData['class_id'],
                    'term' => $examData['term'],
                    'student_id' => $examData['student_id'],
                ));
                $result = $query->row_array();
                if($result)
                {
                    for($i=1; $i<=5; $i++)
                    {
                        if($result['fexm'.$i] != NULL)
                        {
                            continue;
                        } else {
                            $examData['score'] = $data['score'];
                            $this->db->set('fexm'.$i, $examData['score']);
                            $this->db->where('final_result_id', $result['final_result_id']);
                            $this->db->where('fexm'.$i, NULL);
                            $this->db->update('tbl_test_final_result');
                            break;
                        }
                    }
                } else {
                    $this->db->insert('tbl_test_final_result', $examData);
                }
            }

            if($examData['term'] == '3rd quarter')
            {
                $query = $this->db->get_where('tbl_test_final_result', array(
                    'class_id' => $examData['class_id'],
                    'term' => $examData['term'],
                    'student_id' => $examData['student_id'],
                ));
                $result = $query->row_array();
                if($result)
                {
                    for($i=1; $i<=5; $i++)
                    {
                        if($result['fexm'.$i] != NULL)
                        {
                            continue;
                        } else {
                            $examData['score'] = $data['score'];
                            $this->db->set('fexm'.$i, $examData['score']);
                            $this->db->where('final_result_id', $result['final_result_id']);
                            $this->db->where('fexm'.$i, NULL);
                            $this->db->update('tbl_test_final_result');
                            break;
                        }
                    }
                } else {
                    $this->db->insert('tbl_test_final_result', $examData);
                }
            }

            if($examData['term'] == '4th quarter')
            {
                $query = $this->db->get_where('tbl_test_final_result', array(
                    'class_id' => $examData['class_id'],
                    'term' => $examData['term'],
                    'student_id' => $examData['student_id'],
                ));
                $result = $query->row_array();
                if($result)
                {
                    for($i=1; $i<=5; $i++)
                    {
                        if($result['fexm'.$i] != NULL)
                        {
                            continue;
                        } else {
                            $examData['score'] = $data['score'];
                            $this->db->set('fexm'.$i, $examData['score']);
                            $this->db->where('final_result_id', $result['final_result_id']);
                            $this->db->where('fexm'.$i, NULL);
                            $this->db->update('tbl_test_final_result');
                            break;
                        }
                    }
                } else {
                    $this->db->insert('tbl_test_final_result', $examData);
                }
            }
        }
        
    }


    function assign_exam($data)
    {
        $this->db->insert('tbl_joined_header_body_assigned', $data);
    }

    function config_exam($data)
    {
        $data = array(
            'joined_header_body_id' => $data['joined_header_body_id'],
            'allow_retake' => $data['allow_retake'],
            'publish_score_to_student' => $data['publish_score_to_student'],
            'make_exam_visible' => $data['make_exam_visible'],
            'updated_at' => date('Y-m-d h:i:s'),
        );
    
        $this->db->where('joined_header_body_id', $data['joined_header_body_id']);
        $this->db->update('tbl_joined_header_body_assigned', $data);
    }

    function browse_classes_by_teacher()
    {
        $query = $this->db->get_where('tbl_classes', array(
            'tbl_classes.teacher' => $this->session->user_id,
        ));
    }

    function browse_assigned_exam($data)
    {
        // $this->db->join('tbl_subjects as tsub', 'tsub.subjectcode = tbl_joined_header_body_assigned.class');
        $this->db->join('tbl_joined_header_body', 'tbl_joined_header_body.joined_header_body_id = tbl_joined_header_body_assigned.joined_header_body_id');
        $query = $this->db->get_where('tbl_joined_header_body_assigned', array(
            'tbl_joined_header_body.created_by' => $this->session->user_id,
            'tbl_joined_header_body_assigned.joined_header_body_id' => $data,
        ));
        return $query->result_array();
    }

    function delete_assigned_exam($assignedExamID)
    {
        $this->db->where('joined_header_body_assigned_id', $assignedExamID);
        $this->db->delete('tbl_joined_header_body_assigned');
    }

    function get_all_subject_by_student()
    {
        $this->db->join('tbl_teacher_info', 'tbl_teacher_info.staffcode = tbl_subjects.teacher_code');
        $query = $this->db->get_where('tbl_subjects', array('student_id' => $this->session->user_id));
        return $query->result_array();
    }

    function browse_exam_by_subject($term, $type, $subjectcode)
    {
        // $this->db->join('tbl_exam_header', 'tbl_exam_header.exam_header_id = tbl_joined_header_body.exam_header_id');
        // $this->db->join('tbl_exam_body', 'tbl_exam_body.exam_body_id = tbl_joined_header_body.exam_body_id');
        // $this->db->join('tbl_joined_header_body', 'tbl_joined_header_body.joined_header_body_id = tbl_joined_header_body_assigned.joined_header_body_id');

        $this->db->join('tbl_joined_header_body as tjhb', 'tjhb.joined_header_body_id = tjhba.joined_header_body_id');
        $this->db->join('tbl_exam_header as teh', 'teh.exam_header_id = tjhb.exam_header_id');
        $this->db->join('tbl_exam_body as teb', 'teb.exam_body_id = tjhb.exam_body_id');
        $query = $this->db->get_where('tbl_joined_header_body_assigned as tjhba', array(
            'teh.term' => $term,
            'teh.type' => $type,
            'tjhba.class' => $subjectcode,
        ));
        return $query->result_array();
    }

    function test_test_quiz($term, $subjectcode, $userID)
    {
        $this->db->join('tbl_exam_header as teh', 'teh.exam_header_id = ttqr.exam_header_id');
        $query = $this->db->get_where('tbl_test_quiz_result as ttqr', array(
            'ttqr.term' => $term,
            'ttqr.class_id' => $subjectcode,
            'ttqr.student_id' => $userID,
        ));
        return $query->row_array();
    }

}
