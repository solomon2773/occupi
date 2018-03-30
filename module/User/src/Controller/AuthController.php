<?php

namespace User\Controller;

use User\Entity\UserFacebook;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Authentication\Result;
use Zend\Uri\Uri;
use User\Form\LoginForm;
use User\Entity\User;
use User\Service\UserManager;
use Facebook\Facebook;
use Facebook\FacebookRequest;
use Abraham\TwitterOAuth\TwitterOAuth;
use Google_Client;
use Google_Service_Oauth2;
/**
 * This controller is responsible for letting the user to log in and log out.
 */
class AuthController extends AbstractActionController
{
    /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager 
     */
    private $entityManager;
    
    /**
     * Auth manager.
     * @var User\Service\AuthManager 
     */
    private $authManager;
    
    /**
     * Auth service.
     * @var \Zend\Authentication\AuthenticationService
     */
    private $authService;
    
    /**
     * User manager.
     * @var User\Service\UserManager
     */
    private $userManager;


 //   private $oauth_token;
 //   private $oauth_token_secret;
    private $oauth_callback_confirmed;
  //  private $oauth_verifier;

    private $twitter_CONSUMER_KEY = 'lVRyOVflRfVIc82rG1uEhFkji';
    private $twitter_CONSUMER_SECRET = '3kvvfyNr6N1bdz7z4FgfsHzsi4ckmeVGrMpi9S19956NwpDq5x';


    private function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 16; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }
    /**
     * Constructor.
     */
    public function __construct($entityManager, $authManager, $authService, $userManager)
    {
        $this->entityManager = $entityManager;
        $this->authManager = $authManager;
        $this->authService = $authService;
        $this->userManager = $userManager;
    }

    /**
     * Authenticates user given email address and password credentials.     
     */
    public function loginAction()
    {

        // Retrieve the redirect URL (if passed). We will redirect the user to this
        // URL after successfull login.
        $redirectUrl = (string)$this->params()->fromQuery('redirectUrl', '');
        if (strlen($redirectUrl)>2048) {
            throw new \Exception("Too long redirectUrl argument passed");
        }
        
        // Check if we do not have users in database at all. If so, create 
        // the 'Admin' user.
        $this->userManager->createAdminUserIfNotExists();
        
        // Create login form
        $form = new LoginForm(); 
        $form->get('redirect_url')->setValue($redirectUrl);
        
        // Store login status.
        $isLoginError = false;
        
        // Check if user has submitted the form
        if ($this->getRequest()->isPost()) {
            
            // Fill in the form with POST data
            $data = $this->params()->fromPost();            
            
            $form->setData($data);
            
            // Validate form
            if($form->isValid()) {
                
                // Get filtered and validated data
                $data = $form->getData();
                
                // Perform login attempt.
                $result = $this->authManager->login($data['email'], 
                        $data['password'], $data['remember_me']);
                
                // Check result.
                if ($result->getCode() == Result::SUCCESS) {
                    
                    // Get redirect URL.
                    $redirectUrl = $this->params()->fromPost('redirect_url', '');
                    
                    if (!empty($redirectUrl)) {
                        // The below check is to prevent possible redirect attack 
                        // (if someone tries to redirect user to another domain).
                        $uri = new Uri($redirectUrl);
                        if (!$uri->isValid() || $uri->getHost()!=null)
                            throw new \Exception('Incorrect redirect URL: ' . $redirectUrl);
                    }

                    // If redirect URL is provided, redirect the user to that URL;
                    // otherwise redirect to Home page.
                    if(empty($redirectUrl)) {
                        return $this->redirect()->toRoute('home');
                    } else {
                        $this->redirect()->toUrl($redirectUrl);
                    }
                } else {
                    $isLoginError = true;
                }                
            } else {
                $isLoginError = true;
            }           
        } 
        
        return new ViewModel([
            'form' => $form,
            'isLoginError' => $isLoginError,
            'redirectUrl' => $redirectUrl
        ]);
    }
    public function appLoginAction()
    {

        // Retrieve the redirect URL (if passed). We will redirect the user to this
        // URL after successfull login.
        $redirectUrl = (string)$this->params()->fromQuery('redirectUrl', '');
        if (strlen($redirectUrl)>2048) {
            throw new \Exception("Too long redirectUrl argument passed");
        }

        $appLogin_result = array();
        $appLogin_post = $_POST;
        if (empty($appLogin_post)){
            exit;
        }
        // Create login form
        $form = new LoginForm();
        $form->get('redirect_url')->setValue($redirectUrl);

        // Store login status.
        $isLoginError = false;

        // Check if user has submitted the form
       // if ($this->getRequest()->isPost()) {

            // Fill in the form with POST data
          //  $data = $this->params()->fromPost();

           // $form->setData($data);

            // Validate form
          //  if($form->isValid()) {

                // Get filtered and validated data
              //  $data = $form->getData();

                // Perform login attempt.
                $result = $this->authManager->login($appLogin_post['email'],
                    $appLogin_post['password'], 1);

                // Check result.

                if ($result->getCode() == Result::SUCCESS) {
                    $appLogin_result['login_result'] = 'LOGIN SUCCESS';
                    $appLogin_result['error'] = '0';




                        $appLogin_result['uid'] = '1';
                    //    $appLogin_result['user'] = '1';
                        $appLogin_result['name'] = 'occupi';
                        $appLogin_result['email'] = $appLogin_post['email'];
                        $appLogin_result['created_at'] = time(0);
                    // Get redirect URL.
                    /*
                    $redirectUrl = $this->params()->fromPost('redirect_url', '');

                    if (!empty($redirectUrl)) {
                        // The below check is to prevent possible redirect attack
                        // (if someone tries to redirect user to another domain).
                        $uri = new Uri($redirectUrl);
                        if (!$uri->isValid() || $uri->getHost()!=null)
                            throw new \Exception('Incorrect redirect URL: ' . $redirectUrl);
                    }

                    // If redirect URL is provided, redirect the user to that URL;
                    // otherwise redirect to Home page.
                    if(empty($redirectUrl)) {
                        return $this->redirect()->toRoute('home');
                    } else {
                        $this->redirect()->toUrl($redirectUrl);
                    }*/
                } else {
                    $appLogin_result['login_result'] = 'LOGIN ERROR';
                    $appLogin_result['error'] = '1';
                }
        //    } else {
         //       $isLoginError = true;
         //   }
       // }

        echo json_encode($appLogin_result);
        die();
    }
    //https://www.facebook.com/v2.10/dialog/oauth?scope=public_profile,user_friends,email&client_id=121251241872143&redirect_uri=https://www.yottatrend.com/login/facebookloginCallback
    public function facebookloginCallbackAction(){
        ///?error=access_denied&error_code=200&error_description=Permissions+error&error_reason=user_denied
        //$callback_error_code = $_GET['error'];
        if (!empty($_GET['error'])){
            return $this->redirect()->toRoute('home');
        }
        $callback_code = $_GET['code'];
        $facebook_app_client_id = '121251241872143';
        $facebook_app_secret = 'c9025b142f183aae218d4bec0127bd4a';
        $facebook_app_redirect_uri = 'https://www.yottatrend.com/login/facebookloginCallback';
        $default_graph_version = 'v2.10';
        $fb = new Facebook([
            'app_id' => $facebook_app_client_id,
            'app_secret' => $facebook_app_secret,
            'default_graph_version' => $default_graph_version,
            //'default_access_token' => '{access-token}', // optional
        ]);

      //  echo $callback_code;
        if (!empty($callback_code)){
            $facebook_get_response = file_get_contents("https://graph.facebook.com/v2.10/oauth/access_token?client_id=$facebook_app_client_id&redirect_uri=$facebook_app_redirect_uri&client_secret=$facebook_app_secret&code=$callback_code");
            //print_r($facebook_get_response);
            //{"access_token":"EAABuRwEzSw8B....x5e6kXZCIr22yvd6","token_type":"bearer","expires_in":5176238}
            $facebook_get_response_decode = json_decode($facebook_get_response);
            $facebook_get_response_decode_access_token = $facebook_get_response_decode->access_token;
            $facebook_get_response_decode_token_type = $facebook_get_response_decode->token_type;
            $facebook_get_response_decode_expires_in = $facebook_get_response_decode->expires_in;
            try {

                // Get the \Facebook\GraphNodes\GraphUser object for the current user.
                // If you provided a 'default_access_token', the '{access-token}' is optional.
                $response = $fb->get('/me?fields=id,friends,email,name,first_name,last_name,cover,link,gender,locale,picture,timezone,updated_time,verified', $facebook_get_response_decode_access_token);

            } catch(\Facebook\Exceptions\FacebookResponseException $e) {
                // When Graph returns an error
                echo 'Graph returned an error: ' . $e->getMessage();
                exit;
            } catch(\Facebook\Exceptions\FacebookSDKException $e) {
                // When validation fails or other local issues
                echo 'Facebook SDK returned an error: ' . $e->getMessage();
                exit;
            }
         //   print_r($response);

            $me = $response->getGraphUser();
          //  $graphNode = $response->getGraphNode();
          //  $friends = $graphNode->getField('friends');
          //  echo '<pre>';
          //  print_r($friends);
          //  echo '</pre>';
            $me_id = $me->getField('id');
            $me_email =  $me->getField('email');
            $me_name =  $me->getField('name');
            $me_first_name =  $me->getField('first_name');
            $me_last_name =  $me->getField('last_name');
            $me_cover =  $me->getField('cover');
            $me_link =  $me->getField('link');
            $me_gender =  $me->getField('gender');
            $me_locale =  $me->getField('locale');
            $me_picture =  $me->getField('picture');
            $me_timezone =  $me->getField('timezone');
          //  echo $me->getField('updated_time');
            $me_verified =  $me->getField('verified');


            //////after get access token from facebook
            $fb2 = new Facebook([
                'app_id' => $facebook_app_client_id,
                'app_secret' => $facebook_app_secret,
                'default_graph_version' => $default_graph_version,
                'default_access_token' => $facebook_get_response_decode_access_token, // optional
            ]);
            $facebook_permission_get_request = $fb2->request('GET', '/me/permissions');
            $facebook_permission_get_response = $fb2->getClient()->sendRequest($facebook_permission_get_request);
            $facebook_permission_get_response_getBody = $facebook_permission_get_response->getBody();

            $updateUserFacebookpermission_result = $this->userManager->updateUserFacebookpermission($facebook_permission_get_response_getBody,$me_id);
            // Perform login attempt.
            $rememberMe = true;
            $result = $this->authManager->loginviafacebook($me_email, $rememberMe);


           // echo 'Logged in as ' . $me->getName();
            $user_data['email']=$me_email;
            $user_data['full_name']=$me_name;
            $user_data['status']='1';
            $user_data['password']=$this->randomPassword();
            $user_data['roles'] = array('2');
            $user_data['first_name'] = $me_first_name;
            $user_data['last_name'] = $me_last_name;
            $user_data['fb_userID'] = $me_id;
            $user_data['fb_email'] = $me_email;
            $user_data['fb_cover'] = $me_cover;
            $user_data['fb_link'] = $me_link;
            $user_data['fb_gender'] = $me_gender;
            $user_data['fb_locale'] = $me_locale;
            $user_data['fb_picture'] = $me_picture;
            $user_data['fb_timezone'] = $me_timezone;
            $user_data['fb_verified'] = $me_verified;
            $user_data['fb_user_token'] = $facebook_get_response_decode_access_token;
            $user_data['fb_user_token_type'] = $facebook_get_response_decode_token_type;
            $user_data['fb_user_token_expiresin'] = $facebook_get_response_decode_expires_in;


            if ($result->getCode() == Result::SUCCESS) {

                //Zend\Authentication\Result Object ( [code:protected] => 1 [identity:protected] => solomon2773@yahoo.com [messages:protected] => Array ( [0] => Authenticated successfully. ) )
                // Get redirect URL.
                $this->userManager->updateUserFacebooklogin($user_data);


            } else {

                $this->userManager->addUserFacebooklogin($user_data);
                //Zend\Authentication\Result Object ( [code:protected] => -1 [identity:protected] => [messages:protected] => Array ( [0] => Invalid credentials. ) )


            }
            // Perform login attempt.
            $rememberMe = true;
            $result = $this->authManager->loginviafacebook($me_email, $rememberMe);
            $redirectUrl = $this->params()->fromPost('redirect_url', '');

            if (!empty($redirectUrl)) {
                // The below check is to prevent possible redirect attack
                // (if someone tries to redirect user to another domain).
                $uri = new Uri($redirectUrl);
                if (!$uri->isValid() || $uri->getHost()!=null)
                    throw new \Exception('Incorrect redirect URL: ' . $redirectUrl);
            }

            // If redirect URL is provided, redirect the user to that URL;
            // otherwise redirect to Home page.
            if(empty($redirectUrl)) {
                return $this->redirect()->toRoute('home');
            } else {
                $this->redirect()->toUrl($redirectUrl);
            }

        } else {
            return $this->redirect()->toRoute('home');
        }
        die();
    }

    public function twitterloginbtnAction(){

        $method    = "POST";
        $nonce     = md5(time());

        $url = 'https://api.twitter.com/oauth/request_token';
        $oauth_callback = 'https://www.yottatrend.com/login/twitterloginCallback';

        $twitter = new TwitterOAuth($this->twitter_CONSUMER_KEY, $this->twitter_CONSUMER_SECRET );
        $result = $twitter->oauth('oauth/request_token', ['oauth_callback' => $oauth_callback]);
        ////Array ( [oauth_token] => YIlhvgAAAAAA2llCAAABXuYWmSc [oauth_token_secret] => I8WjCmUjeVGlhaEs1R91IBhRlgMLaU4o [oauth_callback_confirmed] => true )
        $_SESSION['twitter_oauth_token'] = $result['oauth_token'];
        $_SESSION['twitter_oauth_token_secret'] = $result['oauth_token_secret'];
        $this->oauth_callback_confirmed = $result['oauth_callback_confirmed'];
        if ($this->oauth_callback_confirmed == 'true'){
            echo '<script>
            window.location = "https://api.twitter.com/oauth/authenticate?oauth_token='.$_SESSION['oauth_token'].'";
            </script>';
        } else {
            echo '<div style="color: red;">Twitter Login Error!!</div>';
        }

        die();
    }

    public function googleloginCallbackAction(){

       // print_r($_POST);
      //  print_r($_GET);
        //Array ( [code] => 4/dwATJza34WQH5BgcrWkI7JiGzNr0rEpPzZkGeo9iVXE [scope] => https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/plus.me https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/youtube https://www.googleapis.com/auth/youtube.force-ssl https://www.googleapis.com/auth/youtube.readonly https://www.googleapis.com/auth/youtubepartner https://www.googleapis.com/auth/youtubepartner-channel-audit https://www.googleapis.com/auth/plus.circles.members.read https://www.googleapis.com/auth/plus.profile.agerange.read https://www.googleapis.com/auth/plus.profile.language.read https://www.googleapis.com/auth/plus.moments.write [authuser] => 0 [session_state] => 371291b48c13b0e3951060de951925e5375bd50d..7415 [prompt] => none )
        $g_callback_code = $_GET['code'];
        $client = new Google_Client();
        $client->setAuthConfig(ROOT_PATH . '/config/client_secrets/client_secret_1023095614270-q0bntmf1f5jkvhkd6q2uppcsk9kda8cp.apps.googleusercontent.com.json');
        $client->setAccessType("offline");        // offline access
        $client->setIncludeGrantedScopes(true);   // incremental auth
       // $client->addScope(Google_Service_Drive::DRIVE_METADATA_READONLY);

        $access_token = $client->fetchAccessTokenWithAuthCode($g_callback_code);
      //  print_r($access_token);
        //Array ( [access_token] => ya29.GlveB....KoI6O39h-FaqAhYtJFG-RMsLNVLPXm9Z9E [token_type] => Bearer [expires_in] => 3600 [id_token] => eyJhbGciOiJSUzI1NiIsImtpZCI6Ijc0MjQzM....aKPO0SZ2vsKfk3HYYJTXwOoNH_0AQ6d0pg [created] => 1507503619 )
        if (! isset($_GET['code'])) {
            echo '<div style="color: red;">Google Login Error!!</div>';

        } else {
            $_SESSION['google_access_token'] = $access_token['access_token'];
            $client->setAccessToken($access_token['access_token']);
            $oauth2 = new Google_Service_Oauth2($client);
            $userInfo = $oauth2->userinfo->get();
            //print_r($userInfo);

            $rememberMe = true;
            $user_data['roles'] = array('2');
            $user_data['scope'] =$_GET['scope'];
            $user_data['password']=$this->randomPassword();
            $user_data['access_token'] = $access_token['access_token'];
            $user_data['token_type'] = $access_token['token_type'];
            $user_data['expires_in'] = $access_token['expires_in'];
            $user_data['id_token'] = $access_token['id_token'];
            $user_data['created'] = $access_token['created'];
            $user_data['email'] = $userInfo->email;
            $user_data['familyName'] = $userInfo->familyName;
            $user_data['gender'] = $userInfo->gender;
            $user_data['givenName'] = $userInfo->givenName;
            $user_data['hd'] = $userInfo->hd;
            $user_data['google_id'] = $userInfo->id;
            $user_data['link'] = $userInfo->link;
            $user_data['locale'] = $userInfo->locale;
            $user_data['name'] = $userInfo->name;
            $user_data['picture'] = $userInfo->picture;
            $user_data['verifiedEmail'] = $userInfo->verifiedEmail;
            $result = $this->authManager->loginviagoogle($userInfo->email, $rememberMe);
            if ($result->getCode() == Result::SUCCESS) {

                //Zend\Authentication\Result Object ( [code:protected] => 1 [identity:protected] => solomon2773@yahoo.com [messages:protected] => Array ( [0] => Authenticated successfully. ) )
                // Get redirect URL.
                $this->userManager->updateUserGooglelogin($user_data);

            } else {

                $this->userManager->addUserGooglelogin($user_data);
                //Zend\Authentication\Result Object ( [code:protected] => -1 [identity:protected] => [messages:protected] => Array ( [0] => Invalid credentials. ) )

            }

            $google_login_result = $this->authManager->loginviagoogle($userInfo->email, $rememberMe);

            $redirect_uri = SITE_URL_SSL;
            header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
            echo '<script>window.location = "'.$redirect_uri.'";</script>';
        }
        die();


    }

    public function twitterloginCallbackAction(){


        $oauth_token_callback = $_GET['oauth_token'];
        $oauth_verifier = $_GET['oauth_verifier'];


        if (!empty($oauth_token_callback) && !empty($oauth_verifier) && ($oauth_token_callback == $_SESSION['oauth_token'])){
            $twitter = new TwitterOAuth(
                $this->twitter_CONSUMER_KEY,
                $this->twitter_CONSUMER_SECRET,
                $_SESSION['oauth_token'],
                $_SESSION['oauth_token_secret']
            );
            $result = $twitter->oauth("oauth/access_token", ["oauth_verifier" => $oauth_verifier]);
            //Array ( [oauth_token] => 884120165675388928-4LApO8q1QRahJUaxd9QyMfDkRzRVUnX [oauth_token_secret] => Fh5FIcDBeKG0EOd3iNS8zb1bm42T8KeJU4ztlnZEo4vJc [user_id] => 884120165675388928 [screen_name] => solomon2773 [x_auth_expires] => 0 )
           // print_r($result);
            $connection = new TwitterOAuth($this->twitter_CONSUMER_KEY, $this->twitter_CONSUMER_SECRET, $result['oauth_token'], $result['oauth_token_secret']);
            $params =array();
            $params['include_email']='true';
            $params['skip_status']='false';
            $content = $connection->get('account/verify_credentials',$params);
          //  echo '<pre>';
          //  print_r($content);
           // echo '</pre>';

            $twitter_email = $content->email;
            //// search for user email


          //  $updateUserFacebookpermission_result = $this->userManager->updateUserFacebookpermission($facebook_permission_get_response_getBody,$me_id);
            // Perform login attempt.
            $rememberMe = true;
            $login_result = $this->authManager->loginviatwitter($twitter_email, $rememberMe);
            $user_data['roles'] = array('2');
            $user_data['email']=$twitter_email;
            $user_data['oauth_token']=$oauth_token_callback;
            $user_data['oauth_token_secret']=$_SESSION['oauth_token_secret'];
            $user_data['t_id']=$content->id;
            $user_data['t_id_str']=$content->id_str;
            $user_data['password']=$this->randomPassword();
            $user_data['name'] = $content->name;
            $user_data['screen_name'] = $content->screen_name;
            $user_data['location'] = $content->location;
            $user_data['description'] = $content->description;
            $user_data['url'] = $content->url;
            $user_data['entities'] = json_encode($content->entities);
            $user_data['protected'] = $content->protected;
            $user_data['followers_count'] = $content->followers_count;
            $user_data['friends_count'] = $content->friends_count;
            $user_data['listed_count'] = $content->listed_count;
            $user_data['created_at'] = $content->created_at;
            $user_data['favourites_count'] = $content->favourites_count;
            $user_data['utc_offset'] = $content->utc_offset;
            $user_data['time_zone'] = $content->time_zone;
            $user_data['geo_enabled'] = $content->geo_enabled;
            $user_data['verified'] = $content->verified;
            $user_data['statuses_count'] = $content->statuses_count;
            $user_data['lang'] = $content->lang;
            $user_data['contributors_enabled'] = $content->contributors_enabled;
            $user_data['is_translator'] = $content->is_translator;
            $user_data['is_translation_enabled'] = $content->is_translation_enabled;
            $user_data['profile_background_color'] = $content->profile_background_color;
            $user_data['profile_background_image_url'] = $content->profile_background_image_url;
            $user_data['profile_background_image_url_https'] = $content->profile_background_image_url_https;
            $user_data['profile_background_tile'] = $content->profile_background_tile;
            $user_data['profile_image_url'] = $content->profile_image_url;
            $user_data['profile_image_url_https'] = $content->profile_image_url_https;
            $user_data['profile_link_color'] = $content->profile_link_color;
            $user_data['profile_sidebar_border_color'] = $content->profile_sidebar_border_color;
            $user_data['profile_sidebar_fill_color'] = $content->profile_sidebar_fill_color;
            $user_data['profile_text_color'] = $content->profile_text_color;
            $user_data['profile_use_background_image'] = $content->profile_use_background_image;
            $user_data['has_extended_profile'] = $content->has_extended_profile;
            $user_data['default_profile'] = $content->default_profile;
            $user_data['default_profile_image'] = $content->default_profile_image;
            $user_data['following'] = $content->following;
            $user_data['follow_request_sent'] = $content->follow_request_sent;
            $user_data['notifications'] = $content->notifications;
            $user_data['translator_type'] = $content->translator_type;

            if ($login_result->getCode() == Result::SUCCESS) {
                //Zend\Authentication\Result Object ( [code:protected] => 1 [identity:protected] => solomon2773@yahoo.com [messages:protected] => Array ( [0] => Authenticated successfully. ) )
                // Get redirect URL.
                $this->userManager->updateUserTwitterlogin($user_data);
            } else {
                $this->userManager->addUserTwitterlogin($user_data);
                //Zend\Authentication\Result Object ( [code:protected] => -1 [identity:protected] => [messages:protected] => Array ( [0] => Invalid credentials. ) )
            }

            // Perform login attempt.
            $rememberMe = true;
            $result = $this->authManager->loginviatwitter($twitter_email, $rememberMe);
            $redirectUrl = $this->params()->fromPost('redirect_url', '');

            if (!empty($redirectUrl)) {
                // The below check is to prevent possible redirect attack
                // (if someone tries to redirect user to another domain).
                $uri = new Uri($redirectUrl);
                if (!$uri->isValid() || $uri->getHost()!=null)
                    throw new \Exception('Incorrect redirect URL: ' . $redirectUrl);
            }

            // If redirect URL is provided, redirect the user to that URL;
            // otherwise redirect to Home page.
            if(empty($redirectUrl)) {
                return $this->redirect()->toRoute('home');
            } else {
                $this->redirect()->toUrl($redirectUrl);
            }

        } else {
            echo '<div style="color: red;">Twitter Login Error!!</div>';
           // return $this->redirect()->toRoute('home');
        }
        die();
    }

    public function linkedinloginCallbackAction(){
        ///?error=access_denied&error_code=200&error_description=Permissions+error&error_reason=user_denied
        //$callback_error_code = $_GET['error'];
        if (!empty($_GET['error'])){
            return $this->redirect()->toRoute('home');
        }
        $callback_code = $_GET['code'];
        $callback_state = $_GET['state'];
        $linkedin_app_client_id = '86eu0frlfc402v';
        $linkedin_app_secret = 'gjkiHruw93O4hHMj';
        $linkedin_app_redirect_uri = 'https://www.yottatrend.com/login/linkedinloginCallback';


        //  echo $callback_code;
        if (!empty($callback_code)){
            $linkedin_get_response = file_get_contents("https://www.linkedin.com/oauth/v2/accessToken?grant_type=authorization_code&client_id=$linkedin_app_client_id&redirect_uri=$linkedin_app_redirect_uri&client_secret=$linkedin_app_secret&code=$callback_code");
            //print_r($linkedin_get_response);
            //{"access_token":"EAABuRwEzSw8B....x5e6kXZCIr22yvd6","token_type":"bearer","expires_in":5176238}
            $linkedin_get_response_decode = json_decode($linkedin_get_response);
            $linkedin_get_response_decode_access_token = $linkedin_get_response_decode->access_token;
            $linkedin_get_response_decode_expires_in = $linkedin_get_response_decode->expires_in;
            //////after get access token from linkedin
            $linkedin_get_people_response = file_get_contents("https://api.linkedin.com/v1/people/~:(id,first-name,last-name,maiden-name,formatted-name,headline,location,industry,current-share,num-connections,num-connections-capped,summary,specialties,positions,picture-url,picture-urls::(original),site-standard-profile-request,public-profile-url,email-address)?format=json&oauth2_access_token=".$linkedin_get_response_decode_access_token);
            $linkedin_get_people_response_decode = json_decode($linkedin_get_people_response);
           // echo '<pre>';
           // print_r($linkedin_get_people_response_decode);
           // echo '</pre>';

            $me_emailAddress = $linkedin_get_people_response_decode->emailAddress;
            $me_firstName =  $linkedin_get_people_response_decode->firstName;
            $me_formattedName =  $linkedin_get_people_response_decode->formattedName;
            $me_headline =  $linkedin_get_people_response_decode->headline;
            $me_id =  $linkedin_get_people_response_decode->id;
            $me_industry =  $linkedin_get_people_response_decode->industry;
            $me_lastName =  $linkedin_get_people_response_decode->lastName;
            $me_location =  $linkedin_get_people_response_decode->location;
            $me_numConnections =  $linkedin_get_people_response_decode->numConnections;
            $me_numConnectionsCapped =  $linkedin_get_people_response_decode->numConnectionsCapped;
            $me_pictureUrl =  $linkedin_get_people_response_decode->pictureUrl;
            $me_pictureUrls =  $linkedin_get_people_response_decode->pictureUrls;
            $me_positions =  $linkedin_get_people_response_decode->positions;
            $me_publicProfileUrl =  $linkedin_get_people_response_decode->publicProfileUrl;
            $me_siteStandardProfileRequest =  $linkedin_get_people_response_decode->siteStandardProfileRequest;
            $me_summary =  $linkedin_get_people_response_decode->summary;


            //$updateUserFacebookpermission_result = $this->userManager->updateUserFacebookpermission($facebook_permission_get_response_getBody,$me_id);
            // Perform login attempt.
            $rememberMe = true;
            $result = $this->authManager->loginvialinkedin($me_emailAddress, $rememberMe);


            // echo 'Logged in as ' . $me->getName();
            $user_data['access_token']=$linkedin_get_response_decode_access_token;
            $user_data['expires_in']=$linkedin_get_response_decode_expires_in;
            $user_data['email']=$me_emailAddress;
            $user_data['full_name']=$me_formattedName;
            $user_data['status']='1';
            $user_data['password']=$this->randomPassword();
            $user_data['roles'] = array('2');
            $user_data['first_name'] = $me_firstName;
            $user_data['last_name'] = $me_lastName;
            $user_data['linkedin_userID'] = $me_id;
            $user_data['linkedin_headline'] = $me_headline;
            $user_data['linkedin_industry'] = $me_industry;
            $user_data['linkedin_location'] = json_encode($me_location);
            $user_data['linkedin_numConnections'] = $me_numConnections;
            $user_data['linkedin_numConnectionsCapped'] = $me_numConnectionsCapped;
            $user_data['linkedin_pictureUrl'] = $me_pictureUrl;
            $user_data['linkedin_pictureUrls'] = json_encode($me_pictureUrls);
            $user_data['linkedin_positions'] = json_encode($me_positions);
            $user_data['linkedin_publicProfileUrl'] = $me_publicProfileUrl;
            $user_data['linkedin_siteStandardProfileRequest'] = json_encode($me_siteStandardProfileRequest);
            $user_data['linkedin_summary'] = $me_summary;


            if ($result->getCode() == Result::SUCCESS) {

                //Zend\Authentication\Result Object ( [code:protected] => 1 [identity:protected] => solomon2773@yahoo.com [messages:protected] => Array ( [0] => Authenticated successfully. ) )
                // Get redirect URL.
                $this->userManager->updateUserLinkedinlogin($user_data);


            } else {

                $this->userManager->addUserLinkedinlogin($user_data);
                //Zend\Authentication\Result Object ( [code:protected] => -1 [identity:protected] => [messages:protected] => Array ( [0] => Invalid credentials. ) )


            }
            // Perform login attempt.
            $rememberMe = true;
            $result = $this->authManager->loginvialinkedin($me_emailAddress, $rememberMe);
            $redirectUrl = $this->params()->fromPost('redirect_url', '');

            if (!empty($redirectUrl)) {
                // The below check is to prevent possible redirect attack
                // (if someone tries to redirect user to another domain).
                $uri = new Uri($redirectUrl);
                if (!$uri->isValid() || $uri->getHost()!=null)
                    throw new \Exception('Incorrect redirect URL: ' . $redirectUrl);
            }

            // If redirect URL is provided, redirect the user to that URL;
            // otherwise redirect to Home page.
            if(empty($redirectUrl)) {
                return $this->redirect()->toRoute('home');
            } else {
                $this->redirect()->toUrl($redirectUrl);
            }

        } else {
            return $this->redirect()->toRoute('home');
        }
        die();
    }

    public function socialloginAction()
    {

      //  exit;
        // Retrieve the redirect URL (if passed). We will redirect the user to this
        // URL after successfull login.
        $redirectUrl = (string)$this->params()->fromQuery('redirectUrl', '');
        if (strlen($redirectUrl)>2048) {
            throw new \Exception("Too long redirectUrl argument passed");
        }

        // Check if we do not have users in database at all. If so, create
        // the 'Admin' user.
      //  $this->userManager->createAdminUserIfNotExists();

        // Create login form
        $form = new LoginForm();
        $form->get('redirect_url')->setValue($redirectUrl);

        // Store login status.
        $isLoginError = false;

        // Check if user has submitted the form
        if ($this->getRequest()->isPost()) {

            // Fill in the form with POST data
            $data = $this->params()->fromPost();

            $form->setData($data);

            // Validate form
            if($form->isValid()) {

                // Get filtered and validated data
                $data = $form->getData();

                // Perform login attempt.
                $result = $this->authManager->login($data['email'],
                    $data['password'], $data['remember_me']);

                // Check result.
                if ($result->getCode() == Result::SUCCESS) {

                    // Get redirect URL.
                    $redirectUrl = $this->params()->fromPost('redirect_url', '');

                    if (!empty($redirectUrl)) {
                        // The below check is to prevent possible redirect attack
                        // (if someone tries to redirect user to another domain).
                        $uri = new Uri($redirectUrl);
                        if (!$uri->isValid() || $uri->getHost()!=null)
                            throw new \Exception('Incorrect redirect URL: ' . $redirectUrl);
                    }

                    // If redirect URL is provided, redirect the user to that URL;
                    // otherwise redirect to Home page.
                    if(empty($redirectUrl)) {
                        return $this->redirect()->toRoute('home');
                    } else {
                        $this->redirect()->toUrl($redirectUrl);
                    }
                } else {
                    $isLoginError = true;
                }
            } else {
                $isLoginError = true;
            }
        }

        return new ViewModel([
            'form' => $form,
            'isLoginError' => $isLoginError,
            'redirectUrl' => $redirectUrl
        ]);
    }
    /**
     * The "logout" action performs logout operation.
     */
    public function logoutAction() 
    {        
        $this->authManager->logout();
        
        return $this->redirect()->toRoute('login', ['action'=>'sociallogin']);
    }
    
    /**
     * Displays the "Not Authorized" page.
     */
    public function notAuthorizedAction()
    {
        $this->getResponse()->setStatusCode(403);
        
        return new ViewModel();
    }
}
