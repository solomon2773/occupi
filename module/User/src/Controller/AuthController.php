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
    public function iosappLoginAction()
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
            $userpost_email = $appLogin_post['email'];
            $user = $this->entityManager->getRepository(User::class)->findOneByEmail( ['email'=>$userpost_email]);
            $checkin_user = $user->getUserData();
            $appLogin_result['user'] = $checkin_user;
            $appLogin_result['login_result'] = 'LOGIN SUCCESS';
            $appLogin_result['error'] = '0';
            $appLogin_result['uid'] = $checkin_user['user_id'];
            $appLogin_result['name'] = $checkin_user['user_fullname'];
            $appLogin_result['email'] = $userpost_email;
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
