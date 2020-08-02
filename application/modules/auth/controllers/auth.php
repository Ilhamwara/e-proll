<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller{

    public function __construct(){        
        parent::__construct();

        $this->load->model('user_mdl');
        
    }

    public function index(){

        if($this->session->userdata('authenticated'))
            redirect('admin/overview');

        $this->load->view('login');
    }

    public function login(){

        if($this->input->post('username') or $this->input->post('password'))            
        {            

            $username = strtolower($this->input->post("username"));
            $password = md5($this->input->post("password"));            
            
            $user = $this->user_mdl->get($username);
            
            if(empty($user)) {
                $this->session->set_flashdata('message', 'Username not found!');
                redirect('auth');
            }else{
                if($password == $user->password){
                    $session = array(
                        'authenticated'=>true,
                        'username'=>$user->username,
                        'fullname'=>$user->user_fullname
                    );

                    $this->session->set_userdata($session);
                    redirect('admin/overview');
                }else{
                    $this->session->set_flashdata('message', 'Password salah'); // Buat session flashdata
                    redirect('auth'); // Redirect ke halaman login

                }
            }

        }
    }

    public function logout(){
        $this->session->sess_destroy(); // Hapus semua session
        redirect('auth'); // Redirect ke halaman login
    }


}

?>