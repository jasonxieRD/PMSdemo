<?php
/**
 * Created by PhpStorm.
 * User: jianchao
 * Date: 15-12-29
 * Time: 下午2:19
 */
class News_model extends CI_Model {



    public function __construct()
    {
        $this->load->database();

    }

    public function get_news($slug = FALSE)
    {
        echo $slug;
        if ($slug === FALSE)
        {
            $query = $this->db->get('news');
            return $query->result_array();
        }

        $query = $this->db->get_where('news', array('slug' => $slug));
        return $query->row_array();
    }

    public function set_news()
    {
        $this->load->helper('url');

        $slug = url_title($this->input->post('title'), 'dash', TRUE);

        $data = array(
            'title' => $this->input->post('title'),
            'slug' => $slug,
            'text' => $this->input->post('text')
        );

        return $this->db->insert('news', $data);
    }
}