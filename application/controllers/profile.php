<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Profile extends CI_Controller
{
    function __construct() {
		parent::__construct();
		error_reporting(0);
        ini_set('display_errors', 0);  
		$this->load->library('facebook');
		$this->load->model('user');
    }
    
    public function index(){
		$this->load->view('user_authentication/index');
    }
    
    public function facebook($endpoint){
		$userData = array();
		if(isset($endpoint)){
            $userProfile = $this->facebook->request('get', '/'.$endpoint.'?fields=id,name,about,age_range,birthday,education,context,cover,devices,email,favorite_athletes,first_name,gender,hometown,last_name,locale,location,work,friends{first_name,gender},religion,languages,albums,photos{link,picture},picture');
            echo $datos_json = json_encode($userProfile);
            $data['logoutUrl'] = $this->facebook->logout_url();
        }
        else{
        if($this->facebook->is_authenticated()){
			$userProfile = $this->facebook->request('get', '/me?fields=id,name,about,age_range,birthday,education,context,cover,devices,email,favorite_athletes,first_name,gender,hometown,last_name,locale,location,work,friends{first_name,gender},religion,languages,albums,photos{link,picture},picture');
            echo "Autenticado"; 
            echo $datos_json = json_encode($userProfile);
            
            $userData['oauth_provider'] = 'facebook';
            $userData['oauth_uid'] = $userProfile['id'];
            $userData['first_name'] = $userProfile['first_name'];
            $userData['last_name'] = $userProfile['last_name'];
            $userData['email'] = $userProfile['email'];
            $userData['gender'] = $userProfile['gender'];
            $userData['locale'] = $userProfile['locale'];
            $userData['profile_url'] = 'https://www.facebook.com/'.$userProfile['id'];
            $userData['picture_url'] = $userProfile['picture']['data']['url'];
            $userData['datos_json'] = $datos_json;
            $userID = $this->user->checkUser($userData);
			
			if(!empty($userID)){
                $data['userData'] = $userData;
                $this->session->set_userdata('userData',$userData);
            } else {
               $data['userData'] = array();
            }
			
			$data['logoutUrl'] = $this->facebook->logout_url();
		}else{
            $fbuser = '';
			
			$data['authUrl'] =  $this->facebook->login_url();
        }
        }
        $this->load->view('user_authentication/index',$data);
    }

	public function logout() {
        $this->facebook->destroy_session();
		$this->session->unset_userdata('userData');
		redirect('../profile/facebook');
    }
}
