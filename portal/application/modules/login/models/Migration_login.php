<?php
class Migration_login extends CI_Model {

    public $db;
    function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('nvac_lms_2020', TRUE);
    }

    function InsertRequest($data)
    {
        $this->db->insert('tbl_frontend_request', $data);
    }

    function search_account_if_existing($data)
    {
        $statement = "select user_id,  email, role_display_name, role_id from tbl_users tu
                        left join tbl_user_roles tur on tur.role_id = tu.role
                        where tu.email like '".$data['email']."' and tu.password like '".$data['password']."' ";
        $execute_query = $this->db->query($statement);
        return $execute_query->result_array();
    }


}
