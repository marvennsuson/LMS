<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Elearning_model extends CI_Model{

   public function __construct()
   {
     parent::__construct();
     //Codeigniter : Write Less Do More

     $this->load->database();
   }




  public function GetSectionBySubjCode(){
$query = $this->db->query("SELECT DISTINCT tbl_subjects.subjectcode, tbl_subjects.subject_name FROM tbl_subjects GROUP BY tbl_subjects.subject_name");
  $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
  return $result;

  }
  public function GetFilePDF($data){
    $query = $this->db->query("SELECT DISTINCT tbl_ebooks.filename ,tbl_ebooks.status ,tbl_ebooks.type ,tbl_ebooks.created_at FROM tbl_ebooks WHERE tbl_ebooks.ebook_id = '".$data."' ORDER BY tbl_ebooks.created_at ASC");
    $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
    return $result;

  }


  function Bookslist()
  {
      return $this->db->count_all("tbl_ebooks");
  }


  function GetEbooksList($limit, $start)
  {

    $this->db->select('tbl_ebooks.ebook_id, tbl_ebooks.filename ,tbl_ebooks.status ,tbl_ebooks.type ,tbl_ebooks.created_at');
    $this->db->distinct();
    $this->db->from("tbl_ebooks");
      $this->db->order_by("tbl_ebooks.created_at", "desc");
        $this->db->limit($limit, $start);
      $query = $this->db->get();

      if ($query->num_rows() > 0) {
          foreach ($query->result_array() as $row) {
              $data[] = $row;
          }
          return $data;
      }
      return false;
  }

// END OF FILTER MODEL


}
