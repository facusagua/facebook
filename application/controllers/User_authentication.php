<?php defined('BASEPATH') OR exit('No direct script access allowed');
class User_Authentication extends CI_Controller
{
    function __construct() {
		parent::__construct();
		error_reporting(0);
            ini_set('display_errors', 0);  
		// Load facebook library
		$this->load->library('facebook');
		
		//Load user model
		$this->load->model('user');
    }
    
    public function index(){
		$userData = array();
		
		if($this->facebook->is_authenticated()){
			$userProfile = $this->facebook->request('get', '/me?fields=id,name,about,age_range,birthday,education,context,cover,devices,email,favorite_athletes,first_name,gender,hometown,last_name,locale,location,work,friends{first_name,gender},religion,languages,albums,photos{link,picture},picture');
            echo $datos_json = json_encode($userProfile);
            // Preparing data for database insertion
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
			
            // Insert or update user data
            $userID = $this->user->checkUser($userData);
			
			// Check user data insert or update status
            if(!empty($userID)){
                $data['userData'] = $userData;
                $this->session->set_userdata('userData',$userData);
            } else {
               $data['userData'] = array();
            }
			
			// Get logout URL
			$data['logoutUrl'] = $this->facebook->logout_url();
		}else{
            $fbuser = '';
			
			// Get login URL
            $data['authUrl'] =  $this->facebook->login_url();
        }
		
		// Load login & profile view
        $this->load->view('user_authentication/index',$data);
    }
    
    public function facebook($endpoint){
		$userData = array();
		if(isset($endpoint)){
            $userProfile = $this->facebook->request('get', '/'.$endpoint.'?fields=id,name,about,age_range,birthday,education,context,cover,devices,email,favorite_athletes,first_name,gender,hometown,last_name,locale,location,work,friends{first_name,gender},religion,languages,albums,photos{link,picture},picture');
            echo $datos_json = json_encode($userProfile);
        }
        else{
        if($this->facebook->is_authenticated()){
			$userProfile = $this->facebook->request('get', '/me?fields=id,name,about,age_range,birthday,education,context,cover,devices,email,favorite_athletes,first_name,gender,hometown,last_name,locale,location,work,friends{first_name,gender},religion,languages,albums,photos{link,picture},picture');
            echo $datos_json = json_encode($userProfile);
            // Preparing data for database insertion
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
			
            // Insert or update user data
            $userID = $this->user->checkUser($userData);
			
			// Check user data insert or update status
            if(!empty($userID)){
                $data['userData'] = $userData;
                $this->session->set_userdata('userData',$userData);
            } else {
               $data['userData'] = array();
            }
			
			// Get logout URL
			$data['logoutUrl'] = $this->facebook->logout_url();
		}else{
            $fbuser = '';
			
			// Get login URL
            $data['authUrl'] =  $this->facebook->login_url();
        }
		
		// Load login & profile view
        $this->load->view('user_authentication/index',$data);
        }    
    }

	public function logout() {
        echo "entre aqui";
		// Remove local Facebook session
		$this->facebook->destroy_session();
		// Remove user data from session
		$this->session->unset_userdata('userData');
		// Redirect to login page
        redirect('/user_authentication');
    }
}
