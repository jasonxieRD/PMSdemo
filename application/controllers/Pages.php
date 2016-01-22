<?php

/**
 * Created by PhpStorm.
 * User: jianchao
 * Date: 15-12-29
 * Time: 上午11:29
 */
class Pages extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("pages_model");

        $this->load->helper('url_helper');
        $this->load->helper('form');

        $this->load->library('session');
        $this->load->library('form_validation');

        require_once('CONSTANT.php');
    }

    /**
     * 主页方法，$auth的主页
     * @param string $auth <p>
     * 作者名 默认为null</p>
     * @param int $index <p>
     * 当前页数，默认值为0（即第一页）。使用了分页 </p>
     */
    public function index($auth = null, $index = 0)
    {
        $html_body = '';
        $usr = $this->get_user();
        $index = is_numeric($index) ? (int)$index : 0;

        if (!isset($auth) && !isset($usr)) {
            $data[HTML_TITLE] = HTML_LOGIN_TITLE;
            $html_body = 'login';

        } else {

            if (!isset($auth)) {
                $auth = $usr;
            }

            $data[HTML_AUTH] = $auth;
            $data[HTML_USER] = $usr;

            $auth_pre = $auth;
            $auth = $this->db->escape($auth);

            $ret = $this->pages_model->check_usr($auth);
            if (empty($ret)) {
                show_404();
            }

            $data[HTML_PAGES] = $this->pages_model->get_papers($auth, $index, 'pages/index/' . $auth_pre . '/');
            $data[HTML_TITLE] = empty($usr) ? HTML_DEFAULT_USERNAME : $usr;

            $html_body = 'index';
        }

        $this->load_view_page($html_body, $data);
    }

    /**
     * 文章编辑器
     */
    public function editor( )
    {
        $usr = $this->check_login();
        $create_flag = false;
        if( empty($usr)) {
            $data[HTML_TITLE] = HTML_LOGIN_TITLE;
            redirect('pages/login');
            return;
        } else {
            $uri = $this->uri->segment_array();

            if (array_key_exists( URI_SEG_EDITOR_PAPERID, $uri)) {
                $id = $uri[URI_SEG_EDITOR_PAPERID];
                $data[HTML_USER] = $usr;
                $id = (int)$id;

                $ret = $this->pages_model->get_paper($this->db->escape($usr), $id);

                if (empty($ret)) {
                    show_404("NO $usr's paper");
                    return;
                }

                $data['page'] = $ret;
                $data[HTML_TITLE] = HTML_EDIT_TITLE;
            } elseif (empty($id)) {
                $create_flag = true;
                $data[HTML_TITLE] = HTML_CREATE_TITLE;
            } else {
                show_404("wrong paperID");
                return;
            }
            $data['create_flag'] = $create_flag;
            $this->load_view_page('editor', $data);
        }
    }

    /**
     * 文章页，显示$auth和$id对应的文章
     * @param string $auth
     * 作者名
     * @param int $id
     * 文章ID
     */
    public function paper($auth=null, $id=null)
    {
        if (isset($auth) && isset($id)) {

            $data[HTML_AUTH] = $auth;
            $data[HTML_USER] = $this->get_user();

            $auth_pre = $auth;
            $auth = $this->db->escape($auth);
            $ret = $this->pages_model->check_usr($auth);
            if (empty($ret)) {
                show_404();
            }

            if (!empty($id)) {
                $id = is_numeric($id) ? (int)$id : 0;
                $data['page'] = $this->pages_model->get_paper($auth, $id);

                if (!empty($data['page'])) {
                    $data[HTML_TITLE] = $data['page'][HTML_TITLE];
                    $data[MYSQL_ISDELETE_E] = $data['page'][MYSQL_ISDELETE_E];
                    $data[HTML_PREPAPER_LINK] = $this->pages_model->get_neighbor($auth, $id, '<');
                    $data[HTML_NEXTPAPER_LINK] = $this->pages_model->get_neighbor($auth, $id, '>');

                    $this->load_view_page('showpage', $data);
                    return;
                }
            }
        }

        redirect('pages/index/' . $auth_pre);
    }

    /**
     * 根据$id删除文章
     * @param int $id
     * 文章ID
     */
    public function delete($id)
    {
        $usr = $this->check_login();
        $data[HTML_USER] = $usr;

        if( !is_numeric( $id ) ){
            show_404();
            return;
        } else {
            $id = (int)$id;
        }

        if ( !empty($id) )
            $this->pages_model->delete_paper($usr, $id);

        redirect("pages/paper/$usr/$id");
    }

    /**
     * @return string
     * 返回当前SESSION['usr']值
     */
    private function get_user()
    {
        return $this->session->usr;
    }

    /**
     * 判断是否已经登陆
     * @return string|void
     */
    private function check_login()
    {
        $usr = $this->get_user();
        if (empty($usr)) {
            $this->load->view('pages/login');
            return;
        } else {
            return $usr;
        }
    }

    /**
     * 添加文章
     */
    public function add()
    {
        $this->process();
    }

    /**
     * @param int $id
     * 用户ID
     */
    public function update($id)
    {
        if(is_numeric($id)) {
            $id = (int)$id;
        } else {
            show_404();
            return;
        }

        $this->process($id);
    }

    /**
     * 处理文章 添加 和 编辑 的逻辑
     * @param int $id default null
     * 文章ID
     */
    private function process($id = null)
    {
        $auth = $this->check_login();
        if (empty($auth)) {
            return;
        }
        $create_flag = $this->input->post(HTML_POST_CREATE);
        $edit_flag = $this->input->post(HTML_POST_EDIT);

        // 添加逻辑
        if (!empty($create_flag)) {
            $data = array(
                MYSQL_USER_E => $auth,
                MYSQL_TITLE_E => $this->input->post(MYSQL_TITLE_E),
                MYSQL_DATE_E => date(MYSQL_DATE_FORMAT, time()),
                MYSQL_CONTENT_E => $this->input->post(MYSQL_CONTENT_E),
                MYSQL_LASTMODIFY_E => date(MYSQL_DATE_FORMAT, time())
            );

            $this->pages_model->insert_db(MYSQL_TABLE_NAME, $data);
            $paper = $this->pages_model->get_neighbor($this->db->escape($auth), null, '<');
            $id = $paper[MYSQL_PAGE_E];

            // 编辑逻辑
        } elseif (!empty($edit_flag)) {

            $data = array(
                MYSQL_TITLE_E => $this->input->post(MYSQL_TITLE_E),
                MYSQL_CONTENT_E => $this->input->post(MYSQL_CONTENT_E),
                MYSQL_LASTMODIFY_E => date(MYSQL_DATE_FORMAT, time())
            );
            $cond_data = array(MYSQL_PAGE_E => $id, MYSQL_USER_E => $auth);

            $this->pages_model->update_db(MYSQL_TABLE_NAME, $cond_data, $data);

        }
        $this->paper($auth, $id);
    }

    /**
     * 查询逻辑
     */
    public function search()
    {
        $uri = $this->uri->segment_array();
        $page = 0;
        $data = array();

        if ( isset($uri[URI_SEG_SEARCH_AUTH]) ) {
            $auth = $uri[URI_SEG_SEARCH_AUTH];
            $data[HTML_AUTH] = $auth;
            $data[HTML_USER] = $this->get_user();
        } else {
            $auth = $this->check_login();
            $data[HTML_AUTH] = $data[HTML_USER] = $auth;
            if (empty($auth)) {
                return;
            }
        }

        if (!isset($uri[URI_SEG_SEARCH_KEY])) {
            $key = $this->input->post(HTML_POST_SEARCH_KEY);
        } else {
            $key = $uri[URI_SEG_SEARCH_KEY];
        }

        if(isset($uri[URI_SEG_SEARCH_PAGE])) {
            $page  = $uri[URI_SET_SEARCH_PAGE];
        }

        $data[HTML_PAGES] = $this->pages_model->search_paper(
            $this->db->escape($auth),
            $this->db->escape('%' . $key . '%'),
            'pages/search/' . $auth . '/' . $key . '/', $page
        );
        $data['key'] = $key;

        $data[HTML_TITLE] = HTML_SEARCH_TITLE;
        $this->load_view_page('index', $data);
    }

    /**
     * 登陆
     */
    public function login()
    {
        $usr = $this->get_user();

        if (empty($usr)) {
            $usr = $this->input->post(HTML_POST_USERNAME);
            $usr = trim($usr);
            $usr_pre = $usr;

            $pwd = $this->input->post(HTML_POST_PASSWORD);
            $pwd = trim($pwd);
            $pwd_pre = $pwd;

            if (!empty($usr) && !empty($pwd)) {
                $pwd = $this->db->escape($pwd);
                $usr = $this->db->escape($usr);

                $ret = $this->pages_model->verify_usr($usr, $pwd);

                $data = array();
                if (!empty($ret)) {
                    $this->session->usr = $usr_pre;
                    redirect('pages/index/' . $usr_pre);
                    return;
                } else {
                    $data['login_error'] = true;
                }
            }
            $data[HTML_TITLE] = HTML_LOGIN_TITLE;
            $this->load_view_page('login', $data);
        } else {
            redirect('pages/index/' . $usr);
        }
    }

    /**
     * @param string $html_body
     * 页面主体文件名
     * @param array $data
     * 需要在VIEW层调用的变量
     */
    private function load_view_page($html_body, $data)
    {
        $this->load->view('templates/header', $data);
        $this->load->view('templates/top');
        $this->load->view('pages/' . $html_body, $data);
//        $this->load->view('templates/footer');
    }

    /**
     * 注册
     */
    public function register()
    {
        $usr = $this->get_user();
        if (empty($usr)) {
            $usr = $this->input->post(HTML_POST_USERNAME);
            $pwd = $this->input->post(HTML_POST_PASSWORD);
            $data = array();

            if (!empty($usr) && !empty($pwd)) {
                $ret = $this->pages_model->check_usr($this->db->escape($usr));

                if (!empty($ret)) {
                    $data['hasusr'] = true;
                } else {
                    if (!$this->check_pwd_format($pwd)) {

                    } else {
                        $db_data=array(
                            MYSQL_USER_USER_E => $usr,
                            MYSQL_USER_PWD_E => $pwd
                        );

                        if ($this->pages_model->insert_usr($db_data)) {
                            $this->session->usr = $usr;
                            $this->session->pwd = $pwd;

                            redirect('pages/index/' . $usr);
                        } else {
                            show_404('rigister error');
                        }
                        return;
                    }
                }
            } else {
                $data[HTML_TITLE] = 'register';
            }
            $this->load_view_page('register', $data);
        } else {
            redirect('pages/index/' . $usr);
        }
    }

    /**
     * 注销用户
     */
    public function logout()
    {
        $usr = $this->check_login();
        if (!isset($usr)) {
            return;
        }
        $this->session->sess_destroy();
        redirect('/pages/index/' . $usr);
    }

    /**
     * 检查密码格式 @todo
     * @param string $pwd
     * 密码
     * @return bool true=>正确 false=>错误
     */
    private function check_pwd_format($pwd)
    {
        $len = strlen($pwd);
        return true;
    }

}
