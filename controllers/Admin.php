<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));

        $this->load->model('Admin_model');
        $this->load->model('Pagination_model');

        $this->load->library('session');
        $this->load->library('pagination');


    }

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *        http://example.com/index.php/welcome
     *    - or -
     *        http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function dashboard(){
        $this->db->select('id, role_id')->from('Users')->where('id',$this->session->userdata('user')['id']);
        $idS = $this->db->get()->row_array();

        if ($idS['role_id'] == 2 ) {

            $lastFiveUsers = $this->Admin_model->lastFiveUsers();
            $images = $this->Admin_model->lastFiveImages();

            $data = [
                'lastFiveUsers' => $lastFiveUsers,
                'images' => $images
            ];

            $this->load->view('Admin/dashboard.php', $data);
        }else{
            $this->load->view('unauthorized.php');
        }
    }

    public function userUpdate($id){
        $this->db->select('id, role_id')->from('Users')->where('id',$this->session->userdata('user')['id']);
        $idS = $this->db->get()->row_array();

        if ($idS['role_id'] == 2 ) {
            $this->db->set('username', $_POST['username'])
                ->where('id', $id);
            $this->db->update('users');
        }else{
            $this->load->view('unauthorized.php');
        }
    }

    public function userDelete($id) {

        $this->db->select('id, role_id')->from('Users')->where('id',$this->session->userdata('user')['id']);
        $idS = $this->db->get()->row_array();

        if ($idS['role_id'] == 2 ) {
            echo $this->db->delete('users', ['id' => $id]);

            redirect('admin/users/table');
        }else{
            $this->load->view('unauthorized.php');
        }
    }

    public function allPictures(){
        $config = array();
        $config["base_url"] = base_url() . "admin/users/allPictures";
        $total_row = $this->Pagination_model->record_count();
        $config["total_rows"] = $total_row;
        $config["uri_segment"] = 4;
        $config["per_page"] = 10;
        $config["use_page_numbers"] = TRUE;
        $config["num_links"] = $total_row;
        $config["cur_tag_open"] = '';
        $config["cur_tag_close"] = '';
        $config["next_link"] = 'Next';
        $config["prev_link"] = 'Previous';

        $config["full_tag_open"] = '<ul class="pagination">';
        $config["full_tag_close"] = '</ul>';
        $config["first_link"] = "&laquo;";
        $config["first_tag_open"] = "<li>";
        $config["first_tag_close"] = "</li>";
        $config["last_link"] = "&raquo;";
        $config["last_tag_open"] = "<li>";
        $config["last_tag_close"] = "</li>";
        $config['next_link'] = '&gt;';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '<li>';
        $config['prev_link'] = '&lt;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '<li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);

        if($this->uri->segment(4)){
            $page = ($this->uri->segment(4)) ;
        }
        else{
            $page = 1;
        }


        /** $data["username"]=$this->db->select('username','id','userID')
        ->from('users')
        ->join('images', 'id = userID')
        ->where(['id' => $image_id])
        ->row_array();
        echo '<pre>' . var_export($data, true) . '</pre>';
        exit;
         **/

        $data["results"] = $this->Pagination_model->fetch_categories($config["per_page"], $page);
        $str_links = $this->pagination->create_links();

        $data["links"] = $str_links;

        $this->load->view('Admin/admin_all_pictures.php',$data);


    }

    public function pictureDelete($id) {

        echo $this->db->delete('images', ['id' => $id]);

        redirect('admin/users/allPictures');
    }

    public function commentDelete($comment_id){
        $this->db->delete('comments',['comment_id' => $comment_id]);
        redirect('admin/users/allPictures');
    }

    public function usersTable(){

        $this->db->select('id, role_id')->from('Users')->where('id',$this->session->userdata('user')['id']);
        $idS = $this->db->get()->row_array();
        if ($idS['role_id'] == 2 ) {
        $users = $this->db->select('id, username, date_added')->from('users')->get()->result_array();

        foreach ($users as &$user) {
            $user['comments_count'] = $this->db->select('id')->from('comments')->where('user_id', $user['id'])->count_all_results();
        }
        
        $data = [
            'users' => $users
        ];

        $this->load->view('Admin/users_table.php', $data);
        }else{
            $this->load->view('unauthorized.php');
        }
    }

    public function userPictures($userID){

        $this->db->select('id, role_id')->from('Users')->where('id',$this->session->userdata('user')['id']);
        $idS = $this->db->get()->row_array();
        if ($idS['role_id'] == 2 ) {
        $images = $this->Admin_model->getImagesByUser($userID);

        $data = [
            'images' => $images
        ];

        $this->load->view('Admin/admin_user_pictures', $data);
        }else{
            $this->load->view('unauthorized.php');
        }
    }

    public function getUserModal($userID) {

        $this->db->select('id, role_id')->from('Users')->where('id',$this->session->userdata('user')['id']);
        $idS = $this->db->get()->row_array();
        if ($idS['role_id'] == 2 ) {
            $user = $this->db->select('*')->from('users')->where('id', $userID)->get()->row_array();


            $data = [
                'user' => $user
            ];

            $this->load->view('Admin/edit_user_modal', $data);
        }else{
            $this->load->view('unauthorized.php');
        }
    }
    
    public function editUser($userID) {
        $this->db->select('id, role_id')->from('Users')->where('id',$this->session->userdata('user')['id']);
        $idS = $this->db->get()->row_array();
        if ($idS['role_id'] == 2 ) {
            $this->db->where('id', $userID)->update('users', $_POST);
        }else{
            $this->load->view('unauthorized.php');
        }
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */