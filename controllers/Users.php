<?php
require 'C:\xampp\htdocs\codeigniter\application\libraries\PHPMailer-master\src\PHPMailer.php';
require 'C:\xampp\htdocs\codeigniter\application\libraries\PHPMailer-master\src\SMTP.php';
require 'C:\xampp\htdocs\codeigniter\application\libraries\PHPMailer-master\src\Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller
{

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



    public function loginP()
    {
        $this->load->view('login.php');
    }

    public function welcome()
    {
        $this->load->view('welcome_message.php');
    }

    public function register()
    {

        if (empty($this->session->userdata('user'))) {
            $this->load->model("Users_model");

            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');


            if ($this->input->server('REQUEST_METHOD') == 'POST') {

                $this->form_validation->set_rules(
                    'username', 'Username',
                    'required|min_length[5]|max_length[12]|is_unique[users.username]',
                    array(
                        'required' => 'You have not provided %s.',
                        'is_unique' => 'This %s already exists.'
                    )
                );
                $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
                $this->form_validation->set_rules('passwordRepeat', 'Password Confirmation', 'required|matches[password]');
                $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]',
                    array(
                        'required' => 'You have not provided %s.',
                        'is_unique' => 'This %s already exists.',
                        'valid_email' => 'You have not provided a valid %s.'
                    )
                );
                if ($this->form_validation->run() == false) {
                    $this->load->view("registration.php");
                } else {
                    $postDataForDB = array(
                        'username' => $this->input->post('username'),
                        'password' => md5($this->input->post('password')),
                        'email' => $this->input->post('email'),
                    );

                    $this->Users_model->insert_User($postDataForDB);
                    redirect('login');
                }

            } else {
                $this->load->view('registration.php');
            }
        } else {
            $this->load->view('logoutFirst.php');
        }

    }


    public function login()
    {
        $this->load->model("Users_model");

        if (empty($this->session->userdata('user'))) {
            if (isset($_POST['user_email'])) {
                $user_email = trim($_POST['user_email']);
                $user_password = md5($_POST['password']);

                if (!$user_email) {
                    $errors[] = 'No mail';
                }

                if (!$user_password) {
                    $errors[] = 'No password';
                }

                if (!empty($errors)) {
                    echo json_encode(array('errors' => $errors));
                    exit;
                }


                $errors = array();

                $this->db->select('*');
                $this->db->from('Users');
                $this->db->where('email', $user_email);
                $query = $this->db->get();
                $user = $query->row_array();

                if (empty($user)) {
                    $errors[] = 'User not found';
                    echo json_encode(array('errors' => $errors));
                    exit;
                }

                if ($user['password'] != $user_password) {
                    $errors[] = 'Passwords do not match';
                }

                if (!empty($errors)) {

                    echo json_encode(array('errors' => $errors));
                    exit;
                }

                $userData = array(
                    'email' => $this->input->post('user_email'),
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'role_id' => $user['role_id']
                );

                $this->session->set_userdata(['user' => $userData]);

                echo json_encode(array('status' => 'ok'));

            } else {
                $this->load->view("login.php");
            }
        } else {
            $this->load->view('alreadyLogged.php');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('/');
    }

    public function home()
    {
        $this->load->model('Users_model');


        $query = $this->db->select('count(userID) AS images_count, userID, file_name, file_ext, date_added')
            ->from('Images')
            ->group_by('userID')
            ->order_by('date_added', 'DESC');
        $query = $this->db->get();
        $raw_last_images = $query->result_array();

        $users_images = [];
        foreach ($raw_last_images as $raw_last_image) {
            $users_images[$raw_last_image['userID']] = $raw_last_image;
        }

        $users = $this->db->select('id, username')->from('Users')->get()->result_array();

        $result_users = [];
        foreach ($users as $user) {

            $user['comments_count'] = $this->db->select('count(id)')->from('comments')->where('user_id', $user['id'])->count_all_results();

            if (isset($users_images[$user['id']])) {
                $result_users[] = array_merge($user, $users_images[$user['id']]);
            }
        }

        $data = [
            'users' => $result_users
        ];

        $this->load->view('home.php', $data);
    }

    public function home2()
    {
        $this->load->model('Image_model');
        $images = $this->Image_model->getLimitImages();

        $data = [
            'images' => $images
        ];

        $this->load->view('home2.php', $data);
    }

    public function allUsers()
    {
        $this->load->model('Users_model');

        if ($this->session->userdata('user')) {
            $this->db->select('count(userID) AS images_count,userID, u.username, u.id');
            $this->db->from('Users as u');
            $this->db->join('Images', 'userID = u.id', 'left');
            $this->db->group_by('u.id');
            $this->db->order_by('images_count', 'DESC');
            $users = $this->db->get()->result_array();

            $data = [
                'users' => $users
            ];

            $this->load->view('users.php', $data);
        } else {
            redirect('login');
        }
    }

    public function updateUserProfile()
    {
        $this->load->view('update_userProfile');
    }

    public function updateUserUsername()
    {
        if (!empty($this->session->userdata('user'))) {

            $this->db->select('id, role_id, username, password')->from('Users')->where('id', $this->session->userdata('user')['id']);
            $userData = $this->db->get()->row_array();

            $this->load->model("Users_model");

            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');

            if ($this->input->server('REQUEST_METHOD') == 'POST') {

                $this->form_validation->set_rules(
                    'username', 'Username',
                    'required|min_length[5]|max_length[12]|is_unique[users.username]',
                    array(
                        'required' => 'You have not provided %s.',
                        'is_unique' => 'This %s already exists.'
                    )
                );
                if (md5($_POST['password']) == $userData['password']) {
                    $this->db->set('username', $_POST['username'])
                        ->where('id', $this->session->userdata('user')['id']);
                    $this->db->update('users');
                    redirect('/user/logout');
                } else {
                    $this->load->view('password_mismatch.php');
                }

            } else {
                $this->load->view('update_username.php');
            }
        } else {
            $this->load->view('unauthorized.php');
        }
    }

    public function updateUserPassword()
    {
        if (!empty($this->session->userdata('user'))) {

            $this->db->select('id, role_id, username, password')->from('Users')->where('id', $this->session->userdata('user')['id']);
            $userData = $this->db->get()->row_array();

            $this->load->model("Users_model");

            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');

            if ($this->input->server('REQUEST_METHOD') == 'POST') {

                $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
                $this->form_validation->set_rules('repeat_password', 'Password Confirmation', 'required|matches[password]',
                    array(
                        'required' => 'You have not provided %s.'
                    ));
                if (md5($_POST['old_password']) == $userData['password']) {
                    $this->db->set('password', md5($_POST['password']))
                        ->where('id', $this->session->userdata('user')['id']);
                    $this->db->update('users');
                    redirect('/user/logout');
                } else {
                    $this->load->view('password_mismatch.php');
                }

            } else {
                $this->load->view('update_password.php');
            }
        } else {
            $this->load->view('unauthorized.php');
        }
    }

    public function updateUserEmail()
    {
        if (!empty($this->session->userdata('user'))) {

            $this->db->select('id, role_id, username, password, email')->from('Users')->where('id', $this->session->userdata('user')['id']);
            $userData = $this->db->get()->row_array();

            $this->load->model("Users_model");

            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');

            if ($this->input->server('REQUEST_METHOD') == 'POST') {

                $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]',
                    array(
                        'required' => 'You have not provided %s.',
                        'is_unique' => 'This %s already exists.',
                        'valid_email' => 'You have not provided a valid %s.'
                    )
                );
                if (md5($_POST['password']) == $userData['password']) {
                    $this->db->set('email', $_POST['email'])
                        ->where('id', $this->session->userdata('user')['id']);
                    $this->db->update('users');
                    redirect('/user/logout');
                } else {
                    $this->load->view('password_mismatch.php');
                }

            } else {
                $this->load->view('update_email.php');
            }
        } else {
            $this->load->view('unauthorized.php');
        }
    }

    public function test()
    {

        /**if ($this->input->server('REQUEST_METHOD') == 'POST') {
        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            //Server settings
                                          // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'viktor.matsanov@gmail.com';                 // SMTP username
            $mail->Password = '123';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 465;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom($_POST['email']);
            $mail->addAddress('viktor.matsanov@gmail.com', 'Viktor');     // Add a recipient

            $mail->setWordWrap(50);


            //Attachments
                // Optional name

            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject =  $_POST['subject'];
            $mail->Body    = $_POST['message'];


            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
        } else {
            $this->load->view('email_form.php');
        }**/




        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            if (isset($_POST['email'])) {
                if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    echo 'Enter a valid email';
                }else{
                    $mail = new PHPMailer();
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                    $mail->SMTPAuth = true;                               // Enable SMTP authentication
                    $mail->Username = 'viktor.matsanov@gmail.com';                 // SMTP username
                    $mail->Password = '';                           // SMTP password
                    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                    $mail->Port = 587;
                    $mail->setFrom('viktor.matsanov@gmail.com','Viktor Matsanov');
                    $mail->addAddress($_POST['email']);
                    $mail->isHTML(true);
                    $mail->Subject = $_POST['subject'];
                    $mail->Body = "<h3>".$_POST['message']."</h3>";

                    $mail->send();
                    /**if ($mail->send()){
                        echo "Email send !";
                    }else{
                        echo "Error";
                    }**/

                }
            }
        }else {
            $this->load->view('email_form.php');
        }
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */