<?php

/**
 * Created by PhpStorm.
 * User: jianchao
 * Date: 15-12-31
 * Time: 上午10:33
 */
class pages_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
        require_once("Page.php");
        require_once("constant.php");
    }

    public function get_papers($auth, $page = 0, $url = 'pages/index/')
    {

        $sql = "SELECT * FROM " . MYSQL_TABLE_NAME . " WHERE " . MYSQL_USER_E . "=$auth AND isdelete=false";
        $query = $this->db->query($sql);
        $count = count($query->result_array());
        //echo $count;

        $this->page_ob = new Page($count, $page, $url);
        $query = $this->db->query(
            "Select * from  " . MYSQL_TABLE_NAME
            . ' where ' . MYSQL_USER_E . ' = ' . $auth
            . ' AND isdelete=false ' . $this->page_ob->get_sql_limit()
        );

        return $query->result_array();
    }

    /**
     * @param $auth
     * @param $id
     * @return mixed
     */
    public function get_paper($auth, $id)
    {
        $sql = 'select * from ' . MYSQL_TABLE_NAME . ' where ' . MYSQL_USER_E . '=' . $auth . ' AND '
            . MYSQL_PAGE_E . '=' . $id;
        $query = $this->db->query($sql);

        return $query->row_array();
    }

    public function insert_db($db_name, $data)
    {
        return $this->db->insert($db_name, $data);
    }

    public function update_db($db_name, $cond_data, $data)
    {
        $this->db->where($cond_data);
        return $this->db->update($db_name, $data);
    }

    public function set_papers($auth, $id = null)
    {

        $this->load->helper('url');

        $create_flag = $this->input->post('create');
        $edit_flag = $this->input->post('edit');
        $cancel_flag = $this->input->post('cancel');

        // create logic
        if (!empty($create_flag)) {

            $data = array(
                MYSQL_USER_E => $auth,
                MYSQL_TITLE_E => $this->input->post(MYSQL_TITLE_E),
                MYSQL_DATE_E => date(MYSQL_DATE_FORMAT, time()),
                MYSQL_CONTENT_E => $this->input->post(MYSQL_CONTENT_E),
                MYSQL_LASTMODIFY_E => date(MYSQL_DATE_FORMAT, time())
            );

            return $this->db->insert(MYSQL_TABLE_NAME, $data);
            //edit logic
        } elseif (!empty($edit_flag)) {

            $data = array(
                MYSQL_TITLE_E => $this->input->post(MYSQL_TITLE_E),
                MYSQL_CONTENT_E => $this->input->post(MYSQL_CONTENT_E),
                MYSQL_LASTMODIFY_E => date(MYSQL_DATE_FORMAT, time())
            );

            $this->db->where(array(MYSQL_PAGE_E => $id, MYSQL_USER_E => $auth));
            return $this->db->update(MYSQL_TABLE_NAME, $data);

        } elseif (!empty($cancel_flag)) {

            return;
        }
    }

    public function delete_paper($auth, $id)
    {
        if (empty($id)) {
            return;
        }

        $cond_data = array(MYSQL_PAGE_E => $id, MYSQL_USER_E => $auth);
        $data = array('isdelete' => true, MYSQL_LASTMODIFY_E => date(MYSQL_DATE_FORMAT, time()));
        return $this->update_db(MYSQL_TABLE_NAME, $cond_data, $data);
    }

    public function search_paper($auth, $key, $url, $page = 0)
    {
        $sql = 'SELECT * FROM ' . MYSQL_TABLE_NAME . ' WHERE title LIKE ' . $key . ' AND ' . MYSQL_USER_E . "=$auth AND isdelete=false";
        $query = $this->db->query($sql);
        $count = count($query->result_array());

        $this->page_ob = new Page($count, $page, $url);

        $sql = 'SELECT * FROM ' . MYSQL_TABLE_NAME . ' WHERE title LIKE ' . $key
            . ' AND ' . MYSQL_USER_E . "=$auth AND isdelete=false "
            . $this->page_ob->get_sql_limit();
        $query = $this->db->query($sql);

        return $query->result_array();
    }

    public function get_neighbor($auth, $id = null, $nORp = '>')
    {
        $str = $nORp === '<' ? "desc" : "";
        $sql = 'Select * from ' . MYSQL_TABLE_NAME
            . ' where  ' . (isset($id) ? (MYSQL_PAGE_E . $nORp . $id . ' AND ') : '') . MYSQL_USER_E . '=' . $auth
            . ' AND isdelete=false order by ' . MYSQL_PAGE_E . ' ' . $str . ' limit 1';

        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function check_usr($usr)
    {
        $sql = 'select * from ' . MYSQL_TABLE_USER .
            ' where ' . MYSQL_USER_USER_E . '=' . $usr;

        $query = $this->db->query($sql);

        return $query->row_array();
    }

    public function verify_usr($usr, $pwd)
    {
        $sql = 'select * from ' . MYSQL_TABLE_USER .
            ' where ' . MYSQL_USER_USER_E . '=' . $usr . ' AND ' . MYSQL_USER_PWD_E . '=' . $pwd;

        $query = $this->db->query($sql);

        return $query->row_array();
    }

    public function insert_usr($data)
    {
        $str_e = '';
        $str_data = '';

        $data_count = count($data);
        $now_row = 1;
        foreach ($data as $db_e => $db_d) {
            $str_e = $str_e . $db_e;
            $str_data = $str_data . $db_d;

            if ($now_row != $data_count) {
                $str_data = $str_data . ',';
                $str_e = $str_e . ',';
            }
            $now_row++;
        }

        $sql = 'insert ' . ' into ' . MYSQL_TABLE_USER . '(' . $str_e . ') values(' . $str_data . ')';
        $query = $this->db->query($sql);
        return $query;
    }

    public $page_ob = '';


}