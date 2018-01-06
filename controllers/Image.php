<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Image extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('Image_model');

        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->model('Pagination_model');

    }

    public function index() {

        $images = $this->Image_model->getAll();

        $data = [
            'images' => $images
        ];

        $this->load->view('images', $data);
    }

    public function index2() {

        $config = array();
        $config["base_url"] = base_url() . "Image/index2";
        $total_row = $this->Pagination_model->record_count();
        $config["total_rows"] = $total_row;
        $config["uri_segment"] = 3;
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

        if($this->uri->segment(3)){
            $page = ($this->uri->segment(3)) ;
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

         $this->load->view('images2',$data);
    }


    public function upload() {

        $imagesCount = $this->db->select('count(userID)')->from('Images')->where('userID',$this->session->userdata('user')['id'])
                       ->get()->row_array();

        if ($imagesCount['count(userID)'] <= 9) {
            if (!$_FILES) {

                if ($this->session->userdata('user')) {
                    $this->load->view('upload_image');
                } else {
                    redirect('login');
                }

            } else {

                $config['upload_path'] = './data/images';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = 100;
                $config['max_width'] = 5000;
                $config['max_height'] = 5000;
                $config['encrypt_name'] = true;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('image')) {
                    $error = array('error' => $this->upload->display_errors());
                    var_dump($error);
                    //$this->load->view('upload_form', $error);
                } else {
                    $data = array('upload_data' => $this->upload->data());
                    $insertData = [
                        'userID' => $this->session->userdata('user')['id'],
                        'file_name' => $data['upload_data']['raw_name'],
                        'file_ext' => $data['upload_data']['file_ext'],
                        'title' => $_POST['title'],
                        'description' => $_POST['description']
                    ];

                    $this->Image_model->addImage($insertData);

                    $this->load->view('upload_success', $data);
                }


            }
        }else{
            $this->load->view('max_pics_reached.php');
        }

    }

    public function userImages() {

        $images = $this->Image_model->getImagesByUser();


        if($this->session->userdata('user')) {
            $data = [
                'images' => $images
            ];

            $this->load->view('users_images2', $data);
        }else{
            redirect('login');
        }

    }

    public function comment($image_id){

            $comments_count = $this->db->select('count(image_id) as comment_count')->from('comments')->where('image_id',$image_id)->get()->row_array();


         if ($comments_count['comment_count']>10){
             echo json_encode(['status' => 0, 'errors' => 'Maximum comments reached']);exit;
         }
            if (!$this->session->userdata('user')) { //!$this->session->has_userdata('user')) {
                echo json_encode(['status' => 'error', 'reason' => 'User is not logged in!']);
            }

            if (isset($_POST['comment'])) {

                $commentData = [
                    'comment_text' => $_POST['comment'],
                    'image_id' => $image_id,
                    'user_id' => $this->session->userdata('user')['id']
                ];

                $inserted = $this->Image_model->addComment($commentData);

                if ($inserted) {
                    $comment_id = $this->db->insert_id();
                    $comment = $this->db->select("comment_text")->from('comments')->where('comment_id', $comment_id)->get()->row_array();

                    echo json_encode(['status' => 1, 'comment' => $comment['comment_text']]);

                } else {

                    echo json_encode(['status' => 0, 'errors' => 'Comment not inserted!']);
                }

            } else {

                // TODO
                echo json_encode(['status' => 'error', 'errors' => 'Comment not set!']);
            }



    }

    public function allComments ($image_id){

        $commentsAndUsers = $this->Image_model->getCommentsByImageId($image_id);

        $data = [
            'comments' => $commentsAndUsers
        ];

        $comments = $this->load->view('comments', $data, true);

        $result = array('status' => 'ok', 'comments' => $comments);
        echo json_encode($result);
    }

    public function pictureDelete($id) {

        echo $this->db->delete('images', ['id' => $id]);

        redirect('image/user');
    }

    public function maxComments(){
        $this->load->view('max_comments_reached.php');
    }
}