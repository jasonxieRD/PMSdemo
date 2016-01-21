<?php
/**
 * Created by PhpStorm.
 * User: jianchao
 * Date: 15-12-29
 * Time: 下午2:30
 */
class News extends CI_Controller {

    public function __construct()
    {
        parent::__construct( );
        //var_dump($this->load);
        $this->load->model( 'news_model' );
        $this->load->helper('url_helper' );
    }

    public function index( )
    {
        echo "index";
        $data['news'] = $this->news_model->get_news( );
        $data['title'] = 'News archive';

        $this->load->view('templates/header', $data);
        $this->load->view('news/index', $data);
        $this->load->view('templates/footer');
    }

    public function view($slug = NULL)
    {
        $data['news_item'] = $this->news_model->get_news( $slug );
        if (empty($data['news_item']))
        {
            show_404();
        }

        $data['title'] = $data['news_item']['title'];

        $this->load->view('templates/header', $data);
        $this->load->view('news/view', $data );
        $this->load->view('templates/footer');
    }

    public function create( )
    {
        $this->load->helper( 'form' );
        $this->load->library( 'form_validation' );

        $data['title'] = 'Create a news item';

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('text', 'Text', 'required');
        if ($this->form_validation->run() === FALSE )
        {
            echo "---create first---";
            $this->load->view('templates/header', $data);
            $this->load->view('news/create');
            $this->load->view('templates/footer');

        }
        else
        {
            echo "---create second---";
            $this->news_model->set_news();
            $this->load->view('news/success');
        }
    }

}