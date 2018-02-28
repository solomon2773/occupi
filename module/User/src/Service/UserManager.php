<?php
namespace User\Service;

use User\Entity\User;
use User\Entity\UserFacebook;
use User\Entity\UserFacebookPermissions;
use User\Entity\UserTwitter;
use User\Entity\UserGoogle;
use User\Entity\UserLinkedin;
use User\Entity\Role;

use Zend\Crypt\Password\Bcrypt;
use Zend\Math\Rand;

/**
 * This service is responsible for adding/editing users
 * and changing user password.
 */
class UserManager
{
    /**
     * Doctrine entity manager.
     * @var Doctrine\ORM\EntityManager
     */
    private $entityManager;  
    
    /**
     * Role manager.
     * @var User\Service\RoleManager
     */
    private $roleManager;
    
    /**
     * Permission manager.
     * @var User\Service\PermissionManager
     */
    private $permissionManager;
    
    /**
     * Constructs the service.
     */
    public function __construct($entityManager, $roleManager, $permissionManager) 
    {
        $this->entityManager = $entityManager;
        $this->roleManager = $roleManager;
        $this->permissionManager = $permissionManager;
    }
    
    /**
     * This method adds a new user.
     */
    public function addUser($data) 
    {
        // Do not allow several users with the same email address.
        if($this->checkUserExists($data['email'])) {
            throw new \Exception("User with email address " . $data['$email'] . " already exists");
        }
        
        // Create new User entity.
        $user = new User();
        $user->setEmail($data['email']);
        $user->setFullName($data['full_name']);        

        // Encrypt password and store the password in encrypted state.
        $bcrypt = new Bcrypt();
        $passwordHash = $bcrypt->create($data['password']);        
        $user->setPassword($passwordHash);

        if (empty($data['status'])){
            $user->setStatus(1); /// default active
        } else {
            $user->setStatus($data['status']);
        }

        
        $currentDate = date('Y-m-d H:i:s');
        $user->setDateCreated($currentDate);        
        
        // Assign roles to user.
        if (empty($data['roles'])){
            $data['roles'] = array('2'); /// User
            $this->assignRoles($user, $data['roles']);
        } else {
            $this->assignRoles($user, $data['roles']);
        }

        
        // Add the entity to the entity manager.
        $this->entityManager->persist($user);
                       
        // Apply changes to database.
        $this->entityManager->flush();
        
        return $user;
    }
    /**
     * This method adds a new user and facebook information.
     */
    public function addUserFacebooklogin($data)
    {
        // Do not allow several users with the same email address.
        if($this->checkUserExists($data['email'])) {
            throw new \Exception("User with email address " . $data['$email'] . " already exists");
        }

        // Create new User entity.
        $user = new User();
        $user->setEmail($data['email']);
        $user->setFullName($data['full_name']);

        // Encrypt password and store the password in encrypted state.
        $bcrypt = new Bcrypt();
        $passwordHash = $bcrypt->create($data['password']);
        $user->setPassword($passwordHash);

        $user->setStatus($data['status']);

        $currentDate = date('Y-m-d H:i:s');
        $user->setDateCreated($currentDate);

        // Assign roles to user.
        $this->assignRoles($user, $data['roles']);

        // Add the entity to the entity manager.
        $this->entityManager->persist($user);

        // Apply changes to database.
        $this->entityManager->flush();

        $user = $this->entityManager->getRepository(User::class)
            ->findOneByEmail($data['email']);

        ////update UserFacebook Data
        $UserFacebook = new UserFacebook();

        $UserFacebook->setcore_user_id($user->getId());
        $UserFacebook->setfb_userID($data['fb_userID']);
        $UserFacebook->setfb_name($data['full_name']);
        $UserFacebook->setfb_first_name($data['first_name']);
        $UserFacebook->setfb_last_name($data['last_name']);
        $UserFacebook->setEmail($data['fb_email']);
        $UserFacebook->setfb_cover($data['fb_cover']);
        $UserFacebook->setfb_link($data['fb_link']);
        $UserFacebook->setfb_gender($data['fb_gender']);
        $UserFacebook->setfb_locale($data['fb_locale']);
        $UserFacebook->setfb_picture($data['fb_picture']);
        $UserFacebook->setfb_timezone($data['fb_timezone']);
        $UserFacebook->setfb_verified($data['fb_verified']);
        $UserFacebook->setfb_user_token($data['fb_user_token']);
        $UserFacebook->setfb_user_token_type($data['fb_user_token_type']);
        $UserFacebook->setfb_user_token_expiresin($data['fb_user_token_expiresin']);

        // Add the entity to the entity manager.
        $this->entityManager->persist($UserFacebook);

        // Apply changes to database.
        $this->entityManager->flush();

        return $user;
    }

    public function addUserTwitterlogin($data)
    {
        // Do not allow several users with the same email address.
        if($this->checkUserExists($data['email'])) {
            throw new \Exception("User with email address " . $data['$email'] . " already exists");
        }

        // Create new User entity.
        $user = new User();
        $user->setEmail($data['email']);
        $user->setFullName($data['name']);

        // Encrypt password and store the password in encrypted state.
        $bcrypt = new Bcrypt();
        $passwordHash = $bcrypt->create($data['password']);
        $user->setPassword($passwordHash);

        $user->setStatus(1);

        $currentDate = date('Y-m-d H:i:s');
        $user->setDateCreated($currentDate);

        // Assign roles to user.
        $this->assignRoles($user, $data['roles']);

        // Add the entity to the entity manager.
        $this->entityManager->persist($user);

        // Apply changes to database.
        $this->entityManager->flush();

        $user = $this->entityManager->getRepository(User::class)
            ->findOneByEmail($data['email']);

        ////update UserFacebook Data
        $UserTwitter = new UserTwitter();
//print_r($data);
        $UserTwitter->setcore_user_id($user->getId());
        $UserTwitter->setemail($data['email']);
        $UserTwitter->setoauth_token($data['oauth_token']);
        $UserTwitter->setoauth_token_secret($data['oauth_token_secret']);
        $UserTwitter->sett_id($data['t_id']);
        $UserTwitter->sett_id_str($data['t_id_str']);
        $UserTwitter->setname($data['name']);
        $UserTwitter->setscreen_name($data['screen_name']);
        $UserTwitter->setlocation($data['location']);
        $UserTwitter->setdescription($data['description']);
        $UserTwitter->seturl($data['url']);
        $UserTwitter->setentities($data['entities']);
        $UserTwitter->setprotected($data['protected']);
        $UserTwitter->setfollowers_count($data['followers_count']);
        $UserTwitter->setfriends_count($data['friends_count']);
        $UserTwitter->setlisted_count($data['listed_count']);
        $UserTwitter->setcreated_at($data['created_at']);
        $UserTwitter->setfavourites_count($data['favourites_count']);
        $UserTwitter->setutc_offset($data['utc_offset']);
        $UserTwitter->settime_zone($data['time_zone']);
        $UserTwitter->setgeo_enabled($data['geo_enabled']);
        $UserTwitter->setverified($data['verified']);
        $UserTwitter->setstatuses_count($data['statuses_count']);
        $UserTwitter->setlang($data['lang']);
        $UserTwitter->setcontributors_enabled($data['contributors_enabled']);
        $UserTwitter->setis_translator($data['is_translator']);
        $UserTwitter->setis_translation_enabled($data['is_translation_enabled']);
        $UserTwitter->setprofile_background_color($data['profile_background_color']);
        $UserTwitter->setprofile_background_image_url($data['profile_background_image_url']);
        $UserTwitter->setprofile_background_image_url_https($data['profile_background_image_url_https']);
        $UserTwitter->setprofile_background_tile($data['profile_background_tile']);
        $UserTwitter->setprofile_image_url($data['profile_image_url']);
        $UserTwitter->setprofile_image_url_https($data['profile_image_url_https']);
        $UserTwitter->setprofile_link_color($data['profile_link_color']);
        $UserTwitter->setprofile_sidebar_border_color($data['profile_sidebar_border_color']);
        $UserTwitter->setprofile_sidebar_fill_color($data['profile_sidebar_fill_color']);
        $UserTwitter->setprofile_text_color($data['profile_text_color']);
        $UserTwitter->setprofile_use_background_image($data['profile_use_background_image']);
        $UserTwitter->sethas_extended_profile($data['has_extended_profile']);
        $UserTwitter->setdefault_profile($data['default_profile']);
        $UserTwitter->setdefault_profile_image($data['default_profile_image']);
        $UserTwitter->setfollowing($data['following']);
        $UserTwitter->setfollow_request_sent($data['follow_request_sent']);
        $UserTwitter->setnotifications($data['notifications']);
        $UserTwitter->settranslator_type($data['translator_type']);

        // Add the entity to the entity manager.
        $this->entityManager->persist($UserTwitter);

        // Apply changes to database.
        $this->entityManager->flush();

        return $user;
    }

    public function addUserGooglelogin($data)
    {
        // Do not allow several users with the same email address.
        if($this->checkUserExists($data['email'])) {
            throw new \Exception("User with email address " . $data['$email'] . " already exists");
        }

        // Create new User entity.
        $user = new User();
        $user->setEmail($data['email']);
        $user->setFullName($data['name']);

        // Encrypt password and store the password in encrypted state.
        $bcrypt = new Bcrypt();
        $passwordHash = $bcrypt->create($data['password']);
        $user->setPassword($passwordHash);

        $user->setStatus(1);

        $currentDate = date('Y-m-d H:i:s');
        $user->setDateCreated($currentDate);

        // Assign roles to user.
        $this->assignRoles($user, $data['roles']);

        // Add the entity to the entity manager.
        $this->entityManager->persist($user);

        // Apply changes to database.
        $this->entityManager->flush();

        $user = $this->entityManager->getRepository(User::class)
            ->findOneByEmail($data['email']);

        ////update UserFacebook Data
        $UserGoogle= new UserGoogle();
//print_r($data);
        $UserGoogle->setcore_user_id($user->getId());
        $UserGoogle->setemail($data['email']);
        $UserGoogle->setscope($data['scope']);
        $UserGoogle->setaccess_token($data['access_token']);
        $UserGoogle->settoken_type($data['token_type']);
        $UserGoogle->setexpires_in($data['expires_in']);
        $UserGoogle->setid_token($data['id_token']);
        $UserGoogle->setcreated($data['created']);
        $UserGoogle->setfamilyName($data['familyName']);
        $UserGoogle->setgender($data['gender']);
        $UserGoogle->setgivenName($data['givenName']);
        $UserGoogle->sethd($data['hd']);
        $UserGoogle->setgoogle_id($data['google_id']);
        $UserGoogle->setlink($data['link']);
        $UserGoogle->setlocale($data['locale']);
        $UserGoogle->setname($data['name']);
        $UserGoogle->setpicture($data['picture']);
        $UserGoogle->setverifiedEmail($data['verifiedEmail']);


        // Add the entity to the entity manager.
        $this->entityManager->persist($UserGoogle);

        // Apply changes to database.
        $this->entityManager->flush();

        return $user;
    }
    public function addUserLinkedinlogin($data)
    {
        // Do not allow several users with the same email address.
        if($this->checkUserExists($data['email'])) {
            throw new \Exception("User with email address " . $data['$email'] . " already exists");
        }

        // Create new User entity.
        $user = new User();
        $user->setEmail($data['email']);
        $user->setFullName($data['full_name']);

        // Encrypt password and store the password in encrypted state.
        $bcrypt = new Bcrypt();
        $passwordHash = $bcrypt->create($data['password']);
        $user->setPassword($passwordHash);

        $user->setStatus(1);

        $currentDate = date('Y-m-d H:i:s');
        $user->setDateCreated($currentDate);

        // Assign roles to user.
        $this->assignRoles($user, $data['roles']);

        // Add the entity to the entity manager.
        $this->entityManager->persist($user);

        // Apply changes to database.
        $this->entityManager->flush();

        $user = $this->entityManager->getRepository(User::class)
            ->findOneByEmail($data['email']);

        ////update UserFacebook Data
        $UserLinkedin= new UserLinkedin();
//print_r($data);
        $UserLinkedin->setcore_user_id($user->getId());
        $UserLinkedin->setemail($data['email']);
        $UserLinkedin->setlinkedin_userID($data['linkedin_userID']);
        $UserLinkedin->setaccess_token($data['access_token']);
        $UserLinkedin->settoken_type($data['token_type']);
        $UserLinkedin->setexpires_in($data['expires_in']);
        $UserLinkedin->setformattedName($data['full_name']);
        $UserLinkedin->setfirstName($data['firstName']);
        $UserLinkedin->setlastName($data['lastName']);
        $UserLinkedin->setheadline($data['linkedin_headline']);
        $UserLinkedin->setindustry($data['linkedin_industry']);
        $UserLinkedin->setlocation($data['linkedin_location']);
        $UserLinkedin->setnumConnections($data['linkedin_numConnections']);
        $UserLinkedin->setpictureUrl($data['linkedin_pictureUrl']);
        $UserLinkedin->setpictureUrls($data['linkedin_pictureUrls']);
        $UserLinkedin->setpositions($data['linkedin_positions']);
        $UserLinkedin->setpublicProfileUrl($data['linkedin_publicProfileUrl']);
        $UserLinkedin->setsiteStandardProfileRequest($data['linkedin_siteStandardProfileRequest']);
        $UserLinkedin->setsummary($data['linkedin_summary']);



        // Add the entity to the entity manager.
        $this->entityManager->persist($UserLinkedin);

        // Apply changes to database.
        $this->entityManager->flush();

        return $user;
    }
    /**
     * This method adds a new user and facebook information.
     */
    public function updateUserFacebooklogin($data)
    {

        $user = $this->entityManager->getRepository(User::class)
            ->findOneByEmail($data['email']);

        ////update UserFacebook Data

        $UserFacebook = $this->entityManager->getRepository(UserFacebook::class)
            ->findOneBy(array('core_user_id' => $user->getId()));

      //  $UserFacebook->setcore_user_id($user->getId());
      //  $UserFacebook->setfb_userID($data['fb_userID']);
        $UserFacebook->setfb_name($data['full_name']);
        $UserFacebook->setfb_first_name($data['first_name']);
        $UserFacebook->setfb_last_name($data['last_name']);
       // $UserFacebook->setEmail($data['fb_email']);
        $UserFacebook->setfb_cover($data['fb_cover']);
        $UserFacebook->setfb_link($data['fb_link']);
        $UserFacebook->setfb_gender($data['fb_gender']);
        $UserFacebook->setfb_locale($data['fb_locale']);
        $UserFacebook->setfb_picture($data['fb_picture']);
        $UserFacebook->setfb_timezone($data['fb_timezone']);
        $UserFacebook->setfb_verified($data['fb_verified']);
        $UserFacebook->setfb_user_token($data['fb_user_token']);
        $UserFacebook->setfb_user_token_type($data['fb_user_token_type']);
        $UserFacebook->setfb_user_token_expiresin($data['fb_user_token_expiresin']);

        // update the entity to the entity manager.
     //   $this->entityManager->merge($UserFacebook);

        // Apply changes to database.
        $this->entityManager->flush();

        return $user;
    }

    public function updateUserTwitterlogin($data)
    {

        $user = $this->entityManager->getRepository(User::class)
            ->findOneByEmail($data['email']);

        ////update UserFacebook Data

        $UserTwitter = $this->entityManager->getRepository(UserTwitter::class)
            ->findOneBy(array('core_user_id' => $user->getId()));

        $UserTwitter->setoauth_token($data['oauth_token']);
        $UserTwitter->setoauth_token_secret($data['oauth_token_secret']);
        $UserTwitter->sett_id($data['t_id']);
        $UserTwitter->sett_id_str($data['t_id_str']);
        $UserTwitter->setname($data['name']);
        $UserTwitter->setscreen_name($data['screen_name']);
        $UserTwitter->setlocation($data['location']);
        $UserTwitter->setdescription($data['description']);
        $UserTwitter->seturl($data['url']);
        $UserTwitter->setentities($data['entities']);
        $UserTwitter->setprotected($data['protected']);
        $UserTwitter->setfollowers_count($data['followers_count']);
        $UserTwitter->setfriends_count($data['friends_count']);
        $UserTwitter->setlisted_count($data['listed_count']);
        $UserTwitter->setcreated_at($data['created_at']);
        $UserTwitter->setfavourites_count($data['favourites_count']);
        $UserTwitter->setutc_offset($data['utc_offset']);
        $UserTwitter->settime_zone($data['time_zone']);
        $UserTwitter->setgeo_enabled($data['geo_enabled']);
        $UserTwitter->setverified($data['verified']);
        $UserTwitter->setstatuses_count($data['statuses_count']);
        $UserTwitter->setlang($data['lang']);
        $UserTwitter->setcontributors_enabled($data['contributors_enabled']);
        $UserTwitter->setis_translator($data['is_translator']);
        $UserTwitter->setis_translation_enabled($data['is_translation_enabled']);
        $UserTwitter->setprofile_background_color($data['profile_background_color']);
        $UserTwitter->setprofile_background_image_url($data['profile_background_image_url']);
        $UserTwitter->setprofile_background_image_url_https($data['profile_background_image_url_https']);
        $UserTwitter->setprofile_background_tile($data['profile_background_tile']);
        $UserTwitter->setprofile_image_url($data['profile_image_url']);
        $UserTwitter->setprofile_image_url_https($data['profile_image_url_https']);
        $UserTwitter->setprofile_link_color($data['profile_link_color']);
        $UserTwitter->setprofile_sidebar_border_color($data['profile_sidebar_border_color']);
        $UserTwitter->setprofile_sidebar_fill_color($data['profile_sidebar_fill_color']);
        $UserTwitter->setprofile_text_color($data['profile_text_color']);
        $UserTwitter->setprofile_use_background_image($data['profile_use_background_image']);
        $UserTwitter->sethas_extended_profile($data['has_extended_profile']);
        $UserTwitter->setdefault_profile($data['default_profile']);
        $UserTwitter->setdefault_profile_image($data['default_profile_image']);
        $UserTwitter->setfollowing($data['following']);
        $UserTwitter->setfollow_request_sent($data['follow_request_sent']);
        $UserTwitter->setnotifications($data['notifications']);
        $UserTwitter->settranslator_type($data['translator_type']);

        // update the entity to the entity manager.
        //   $this->entityManager->merge($UserFacebook);

        // Apply changes to database.
        $this->entityManager->flush();

        return $user;
    }

    public function updateUserGooglelogin($data)
    {

        $user = $this->entityManager->getRepository(User::class)
            ->findOneByEmail($data['email']);

        ////update UserFacebook Data

        $UserGoogle = $this->entityManager->getRepository(UserGoogle::class)
            ->findOneBy(array('core_user_id' => $user->getId()));

        $UserGoogle->setscope($data['scope']);
        $UserGoogle->setaccess_token($data['access_token']);
        $UserGoogle->settoken_type($data['token_type']);
        $UserGoogle->setexpires_in($data['expires_in']);
        $UserGoogle->setid_token($data['id_token']);
        $UserGoogle->setcreated($data['created']);
        $UserGoogle->setfamilyName($data['familyName']);
        $UserGoogle->setgender($data['gender']);
        $UserGoogle->setgivenName($data['givenName']);
        $UserGoogle->sethd($data['hd']);
        $UserGoogle->setgoogle_id($data['google_id']);
        $UserGoogle->setlink($data['link']);
        $UserGoogle->setlocale($data['locale']);
        $UserGoogle->setname($data['name']);
        $UserGoogle->setpicture($data['picture']);
        $UserGoogle->setverifiedEmail($data['verifiedEmail']);

        // update the entity to the entity manager.
        //   $this->entityManager->merge($UserFacebook);

        // Apply changes to database.
        $this->entityManager->flush();

        return $user;
    }

    public function updateUserLinkedinlogin($data)
    {

        $user = $this->entityManager->getRepository(User::class)
            ->findOneByEmail($data['email']);

        ////update UserFacebook Data

        $UserLinkedin = $this->entityManager->getRepository(UserLinkedin::class)
            ->findOneBy(array('core_user_id' => $user->getId()));


        $UserLinkedin->setlinkedin_userID($data['linkedin_userID']);
        $UserLinkedin->setaccess_token($data['access_token']);
        $UserLinkedin->settoken_type($data['token_type']);
        $UserLinkedin->setexpires_in($data['expires_in']);
        $UserLinkedin->setformattedName($data['full_name']);
        $UserLinkedin->setfirstName($data['firstName']);
        $UserLinkedin->setlastName($data['lastName']);
        $UserLinkedin->setheadline($data['linkedin_headline']);
        $UserLinkedin->setindustry($data['linkedin_industry']);
        $UserLinkedin->setlocation($data['linkedin_location']);
        $UserLinkedin->setnumConnections($data['linkedin_numConnections']);
        $UserLinkedin->setpictureUrl($data['linkedin_pictureUrl']);
        $UserLinkedin->setpictureUrls($data['linkedin_pictureUrls']);
        $UserLinkedin->setpositions($data['linkedin_positions']);
        $UserLinkedin->setpublicProfileUrl($data['linkedin_publicProfileUrl']);
        $UserLinkedin->setsiteStandardProfileRequest($data['linkedin_siteStandardProfileRequest']);
        $UserLinkedin->setsummary($data['linkedin_summary']);


        // update the entity to the entity manager.
        //   $this->entityManager->merge($UserFacebook);

        // Apply changes to database.
        $this->entityManager->flush();

        return $user;
    }
    /**
     * This method adds a new user and facebook information.
     */
    public function updateUserFacebookpermission($data,$facebook_id)
    {

        $data_decode = json_decode($data);
        $user_facebook_permissions_result = $data_decode->data;

        foreach ($user_facebook_permissions_result as $user_facebook_permissions_result_each){
            $user_permission = $user_facebook_permissions_result_each->permission;
            $user_status = $user_facebook_permissions_result_each->status;
            $UserFacebookPermission = $this->entityManager->getRepository(UserFacebookPermissions::class)->findOneBy(array('fb_userID' => $facebook_id,'permission' => $user_permission));
            if ($UserFacebookPermission){ ///updated existing
                $UserFacebookPermission->setfb_userID($facebook_id);
                $UserFacebookPermission->setpermission($user_permission);
                $UserFacebookPermission->setstatus($user_status);
                // Apply changes to database.
                $this->entityManager->flush();
            } else {////create new permission
                $UserFacebookPermission_new = new UserFacebookPermissions();
                $UserFacebookPermission_new->setfb_userID($facebook_id);
                $UserFacebookPermission_new->setpermission($user_permission);
                $UserFacebookPermission_new->setstatus($user_status);
                $this->entityManager->persist($UserFacebookPermission_new);
                // Apply changes to database.
                $this->entityManager->flush();
            }

        }

        return;
        ////update UserFacebook Data

        $UserFacebook = $this->entityManager->getRepository(UserFacebook::class)
            ->findOneBy(array('core_user_id' => $user->getId()));

        //  $UserFacebook->setcore_user_id($user->getId());
        //  $UserFacebook->setfb_userID($data['fb_userID']);
        $UserFacebook->setfb_name($data['full_name']);
        $UserFacebook->setfb_first_name($data['first_name']);
        $UserFacebook->setfb_last_name($data['last_name']);
        // $UserFacebook->setEmail($data['fb_email']);
        $UserFacebook->setfb_cover($data['fb_cover']);
        $UserFacebook->setfb_link($data['fb_link']);
        $UserFacebook->setfb_gender($data['fb_gender']);
        $UserFacebook->setfb_locale($data['fb_locale']);
        $UserFacebook->setfb_picture($data['fb_picture']);
        $UserFacebook->setfb_timezone($data['fb_timezone']);
        $UserFacebook->setfb_verified($data['fb_verified']);
        $UserFacebook->setfb_user_token($data['fb_user_token']);
        $UserFacebook->setfb_user_token_type($data['fb_user_token_type']);
        $UserFacebook->setfb_user_token_expiresin($data['fb_user_token_expiresin']);

        // update the entity to the entity manager.
        //   $this->entityManager->merge($UserFacebook);

        // Apply changes to database.
        $this->entityManager->flush();

        return $user;
    }

    /**
     * This method updates data of an existing user.
     */
    public function updateUser($user, $data) 
    {
        // Do not allow to change user email if another user with such email already exits.
        if($user->getEmail()!=$data['email'] && $this->checkUserExists($data['email'])) {
            throw new \Exception("Another user with email address " . $data['email'] . " already exists");
        }
        
        $user->setEmail($data['email']);
        $user->setFullName($data['full_name']);        
        $user->setStatus($data['status']); 
        
        // Assign roles to user.
        $this->assignRoles($user, $data['roles']);
        
        // Apply changes to database.
        $this->entityManager->flush();

        return true;
    }
    
    /**
     * A helper method which assigns new roles to the user.
     */
    private function assignRoles($user, $roleIds)
    {
        // Remove old user role(s).
        $user->getRoles()->clear();
        
        // Assign new role(s).
        foreach ($roleIds as $roleId) {
            $role = $this->entityManager->getRepository(Role::class)
                    ->find($roleId);
            if ($role==null) {
                throw new \Exception('Not found role by ID');
            }
            
            $user->addRole($role);
        }
    }
    
    /**
     * This method checks if at least one user presents, and if not, creates 
     * 'Admin' user with email 'admin@example.com' and password 'Secur1ty'. 
     */
    public function createAdminUserIfNotExists()
    {
        return;
        $user = $this->entityManager->getRepository(User::class)->findOneBy([]);
        if ($user==null) {
            
            $this->permissionManager->createDefaultPermissionsIfNotExist();
            $this->roleManager->createDefaultRolesIfNotExist();
            
            $user = new User();
            $user->setEmail('admin@example.com');
            $user->setFullName('Admin');
            $bcrypt = new Bcrypt();
            $passwordHash = $bcrypt->create('Secur1ty');        
            $user->setPassword($passwordHash);
            $user->setStatus(User::STATUS_ACTIVE);
            $user->setDateCreated(date('Y-m-d H:i:s'));
            
            // Assign user Administrator role
            $adminRole = $this->entityManager->getRepository(Role::class)
                    ->findOneByName('Administrator');
            if ($adminRole==null) {
                throw new \Exception('Administrator role doesn\'t exist');
            }

            $user->getRoles()->add($adminRole);
            
            $this->entityManager->persist($user);
            $this->entityManager->flush();
        }

    }
    
    /**
     * Checks whether an active user with given email address already exists in the database.     
     */
    public function checkUserExists($email) {
        
        $user = $this->entityManager->getRepository(User::class)
                ->findOneByEmail($email);
        
        return $user !== null;
    }
    
    /**
     * Checks that the given password is correct.
     */
    public function validatePassword($user, $password) 
    {
        $bcrypt = new Bcrypt();
        $passwordHash = $user->getPassword();
        
        if ($bcrypt->verify($password, $passwordHash)) {
            return true;
        }
        
        return false;
    }
    
    /**
     * Generates a password reset token for the user. This token is then stored in database and 
     * sent to the user's E-mail address. When the user clicks the link in E-mail message, he is 
     * directed to the Set Password page.
     */
    public function generatePasswordResetToken($user)
    {
        // Generate a token.
        $token = Rand::getString(32, '0123456789abcdefghijklmnopqrstuvwxyz', true);
        $user->setPasswordResetToken($token);
        
        $currentDate = date('Y-m-d H:i:s');
        $user->setPasswordResetTokenCreationDate($currentDate);  
        
        $this->entityManager->flush();
        
        $subject = 'Password Reset';
            
        $httpHost = isset($_SERVER['HTTP_HOST'])?$_SERVER['HTTP_HOST']:'localhost';
        $passwordResetUrl = 'http://' . $httpHost . '/set-password?token=' . $token;
        
        $body = 'Please follow the link below to reset your password:\n';
        $body .= "$passwordResetUrl\n";
        $body .= "If you haven't asked to reset your password, please ignore this message.\n";
        
        // Send email to user.
        mail($user->getEmail(), $subject, $body);
    }
    
    /**
     * Checks whether the given password reset token is a valid one.
     */
    public function validatePasswordResetToken($passwordResetToken)
    {
        $user = $this->entityManager->getRepository(User::class)
                ->findOneByPasswordResetToken($passwordResetToken);
        
        if($user==null) {
            return false;
        }
        
        $tokenCreationDate = $user->getPasswordResetTokenCreationDate();
        $tokenCreationDate = strtotime($tokenCreationDate);
        
        $currentDate = strtotime('now');
        
        if ($currentDate - $tokenCreationDate > 24*60*60) {
            return false; // expired
        }
        
        return true;
    }
    
    /**
     * This method sets new password by password reset token.
     */
    public function setNewPasswordByToken($passwordResetToken, $newPassword)
    {
        if (!$this->validatePasswordResetToken($passwordResetToken)) {
           return false; 
        }
        
        $user = $this->entityManager->getRepository(User::class)
                ->findOneByPasswordResetToken($passwordResetToken);
        
        if ($user===null) {
            return false;
        }
                
        // Set new password for user        
        $bcrypt = new Bcrypt();
        $passwordHash = $bcrypt->create($newPassword);        
        $user->setPassword($passwordHash);
                
        // Remove password reset token
        $user->setPasswordResetToken(null);
        $user->setPasswordResetTokenCreationDate(null);
        
        $this->entityManager->flush();
        
        return true;
    }
    
    /**
     * This method is used to change the password for the given user. To change the password,
     * one must know the old password.
     */
    public function changePassword($user, $data)
    {
        $oldPassword = $data['old_password'];
        
        // Check that old password is correct
        if (!$this->validatePassword($user, $oldPassword)) {
            return false;
        }                
        
        $newPassword = $data['new_password'];
        
        // Check password length
        if (strlen($newPassword)<6 || strlen($newPassword)>64) {
            return false;
        }
        
        // Set new password for user        
        $bcrypt = new Bcrypt();
        $passwordHash = $bcrypt->create($newPassword);
        $user->setPassword($passwordHash);
        
        // Apply changes
        $this->entityManager->flush();

        return true;
    }
}

