<?php
namespace User\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * This class represents a registered user.
 * @ORM\Entity()
 * @ORM\Table(name="core_user_twitter")
 */
class UserTwitter
{
    // User status constants.
    const STATUS_ACTIVE       = 1; // Active user.
    const STATUS_RETIRED      = 2; // Retired user.
    
    /**
     * @ORM\Id
     * @ORM\Column(name="id")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\Column(name="core_user_id")
     */
    protected $core_user_id;
    
    /** 
     * @ORM\Column(name="email")
     */
    protected $email;


    /**
     * @ORM\Column(name="oauth_token")
     */
    protected $oauth_token;


    /**
     * @ORM\Column(name="oauth_token_secret")
     */
    protected $oauth_token_secret;


    /** 
     * @ORM\Column(name="t_id")
     */

    protected $t_id;

    /**
     * @ORM\Column(name="t_id_str")
     */
    protected $t_id_str;
    /**
     * @ORM\Column(name="name")
     */
    protected $name;

    /**
     * @ORM\Column(name="screen_name")
     */
    protected $screen_name;

    /**
     * @ORM\Column(name="location")
     */
    protected $location;

    /** 
     * @ORM\Column(name="description")
     */
    protected $description;
    
    /**
     * @ORM\Column(name="url")
     */
    protected $url;
        
    /**
     * @ORM\Column(name="entities")
     */
    protected $entities;
    
    /**
     * @ORM\Column(name="protected")
     */
    protected $protected;

    /**
     * @ORM\Column(name="followers_count")
     */
    protected $followers_count;

    /**
     * @ORM\Column(name="friends_count")
     */
    protected $friends_count;

    /**
     * @ORM\Column(name="listed_count")
     */
    protected $listed_count;

    /**
     * @ORM\Column(name="created_at")
     */
    protected $created_at;

    /**
     * @ORM\Column(name="favourites_count")
     */
    protected $favourites_count;

    /**
     * @ORM\Column(name="utc_offset")
     */
    protected $utc_offset;

    /**
     * @ORM\Column(name="time_zone")
     */
    protected $time_zone;

    /**
     * @ORM\Column(name="geo_enabled")
     */
    protected $geo_enabled;

    /**
     * @ORM\Column(name="verified")
     */
    protected $verified;

    /**
     * @ORM\Column(name="statuses_count")
     */
    protected $statuses_count;

    /**
     * @ORM\Column(name="lang")
     */
    protected $lang;

    /**
     * @ORM\Column(name="contributors_enabled")
     */
    protected $contributors_enabled;

    /**
     * @ORM\Column(name="is_translator")
     */
    protected $is_translator;

    /**
     * @ORM\Column(name="is_translation_enabled")
     */
    protected $is_translation_enabled;


    /**
     * @ORM\Column(name="profile_background_color")
     */
    protected $profile_background_color;

    /**
     * @ORM\Column(name="profile_background_image_url")
     */
    protected $profile_background_image_url;

    /**
     * @ORM\Column(name="profile_background_image_url_https")
     */
    protected $profile_background_image_url_https;

    /**
     * @ORM\Column(name="profile_background_tile")
     */
    protected $profile_background_tile;

    /**
     * @ORM\Column(name="profile_image_url")
     */
    protected $profile_image_url;

    /**
     * @ORM\Column(name="profile_image_url_https")
     */
    protected $profile_image_url_https;

    /**
     * @ORM\Column(name="profile_link_color")
     */
    protected $profile_link_color;

    /**
     * @ORM\Column(name="profile_sidebar_border_color")
     */
    protected $profile_sidebar_border_color;

    /**
     * @ORM\Column(name="profile_sidebar_fill_color")
     */
    protected $profile_sidebar_fill_color;

    /**
     * @ORM\Column(name="profile_text_color")
     */
    protected $profile_text_color;

    /**
     * @ORM\Column(name="profile_use_background_image")
     */
    protected $profile_use_background_image;

    /**
     * @ORM\Column(name="has_extended_profile")
     */
    protected $has_extended_profile;

    /**
     * @ORM\Column(name="default_profile")
     */
    protected $default_profile;

    /**
     * @ORM\Column(name="default_profile_image")
     */
    protected $default_profile_image;

    /**
     * @ORM\Column(name="following")
     */
    protected $following;

    /**
     * @ORM\Column(name="follow_request_sent")
     */
    protected $follow_request_sent;

    /**
     * @ORM\Column(name="notifications")
     */
    protected $notifications;

    /**
     * @ORM\Column(name="translator_type")
     */
    protected $translator_type;

    /**
     * @ORM\Column(name="dateCreated")
     */
    protected $dateCreated;


    /**
     * Constructor.
     */
    public function __construct() 
    {
        $this->usertwitter = new ArrayCollection();
    }
    
    /**
     * Returns ID.
     * @return integer
     */
    public function getId() 
    {
        return $this->id;
    }
    /**
     * Returns core_user_id.
     * @return integer
     */
    public function getcore_user_id()
    {
        return $this->core_user_id;
    }
    /**
     * Sets core_user_id.
     * @param int $id
     */
    public function setcore_user_id($id)
    {
        $this->core_user_id = $id;
    }

    /**
     * Returns email.
     * @return string
     */
    public function getemail()
    {
        return $this->email;
    }
    /**
     * Sets email.
     * @param string $email
     */
    public function setemail($email)
    {
        $this->email = $email;
    }


    /**
     * Returns oauth_token.
     * @return string
     */
    public function getoauth_token()
    {
        return $this->oauth_token;
    }
    /**
     * Sets oauth_token.
     * @param string $oauth_token
     */
    public function setoauth_token($oauth_token)
    {
        $this->oauth_token = $oauth_token;
    }

    /**
     * Returns oauth_token_secret.
     * @return string
     */
    public function getoauth_token_secret()
    {
        return $this->oauth_token_secret;
    }
    /**
     * Sets oauth_token_secret.
     * @param string $oauth_token_secret
     */
    public function setoauth_token_secret($oauth_token_secret)
    {
        $this->oauth_token_secret = $oauth_token_secret;
    }


    /**
     * Returns t_id.
     * @return string
     */
    public function gett_id()
    {
        return $this->t_id;
    }

    /**
     * Sets t_id.
     * @param string $t_id
     */
    public function sett_id($t_id)
    {
        $this->t_id = $t_id;
    }

    /**
     * Returns t_id_str.
     * @return string
     */
    public function gett_id_str()
    {
        return $this->t_id_str;
    }

    /**
     * Sets t_id_str.
     * @param string $t_id_str
     */
    public function sett_id_str($t_id_str)
    {
        $this->t_id_str = $t_id_str;
    }

    /**
     * Returns name.
     * @return string
     */
    public function getname()
    {
        return $this->name;
    }

    /**
     * Sets name.
     * @param string $name
     */
    public function setname($name)
    {
        $this->name = $name;
    }

    /**
     * Returns screen_name.
     * @return string
     */
    public function getscreen_name()
    {
        return $this->screen_name;
    }

    /**
     * Sets screen_name.
     * @param string $screen_name
     */
    public function setscreen_name($screen_name)
    {
        $this->screen_name = $screen_name;
    }

    /**
     * Returns full location.
     * @return string     
     */
    public function getlocation()
    {
        return $this->location;
    }       

    /**
     * Sets full location.
     * @param string $location
     */
    public function setlocation($location)
    {
        $this->location = $location;
    }

    /**
     * Returns description.
     * @return string
     */
    public function getdescription()
    {
        return $this->description;
    }

    /**
     * Sets description.
     * @param string $description
     */
    public function setdescription($description)
    {
        $this->description = $description;
    }

    /**
     * Returns url.
     * @return string
     */
    public function geturl()
    {
        return $this->url;
    }

    /**
     * Sets url.
     * @param string $url
     */
    public function seturl($url)
    {
        $this->url = $url;
    }

    /**
     * Returns entities.
     * @return string
     */
    public function getentities()
    {
        return $this->entities;
    }

    /**
     * Sets entities.
     * @param string $entities
     */
    public function setentities($entities)
    {
        $this->entities = $entities;
    }

    /**
     * Returns protected.
     * @return string
     */
    public function getprotected()
    {
        return $this->protected;
    }

    /**
     * Sets protected.
     * @param string $protected
     */
    public function setprotected($protected)
    {
        $this->protected = $protected;
    }

    /**
     * Returns followers_count.
     * @return string
     */
    public function getfollowers_count()
    {
        return $this->followers_count;
    }

    /**
     * Sets followers_count.
     * @param string $followers_count
     */
    public function setfollowers_count($followers_count)
    {
        $this->followers_count = $followers_count;
    }

    /**
     * Returns friends_count.
     * @return string
     */
    public function getfriends_count()
    {
        return $this->friends_count;
    }

    /**
     * Sets friends_count.
     * @param string $friends_count
     */
    public function setfriends_count($friends_count)
    {
        $this->friends_count = $friends_count;
    }

    /**
     * Returns listed_count.
     * @return string
     */
    public function getlisted_count()
    {
        return $this->listed_count;
    }

    /**
     * Sets listed_count.
     * @param string $listed_count
     */
    public function setlisted_count($listed_count)
    {
        $this->listed_count = $listed_count;
    }

    /**
     * Returns created_at.
     * @return string
     */
    public function getcreated_at()
    {
        return $this->created_at;
    }

    /**
     * Sets created_at.
     * @param string $created_at
     */
    public function setcreated_at($created_at)
    {
        $this->created_at = $created_at;
    }


    /**
     * Returns favourites_count.
     * @return string
     */
    public function getfavourites_count()
    {
        return $this->favourites_count;
    }

    /**
     * Sets favourites_count.
     * @param string $favourites_count
     */
    public function setfavourites_count($favourites_count)
    {
        $this->favourites_count = $favourites_count;
    }


    /**
     * Returns utc_offset.
     * @return string
     */
    public function getutc_offset()
    {
        return $this->utc_offset;
    }

    /**
     * Sets utc_offset.
     * @param string $utc_offset
     */
    public function setutc_offset($utc_offset)
    {
        $this->utc_offset = $utc_offset;
    }


    /**
     * Returns time_zone.
     * @return string
     */
    public function gettime_zone()
    {
        return $this->time_zone;
    }

    /**
     * Sets time_zone.
     * @param string $time_zone
     */
    public function settime_zone($time_zone)
    {
        $this->time_zone = $time_zone;
    }


    /**
     * Returns geo_enabled.
     * @return string
     */
    public function getgeo_enabled()
    {
        return $this->geo_enabled;
    }

    /**
     * Sets geo_enabled.
     * @param string $geo_enabled
     */
    public function setgeo_enabled($geo_enabled)
    {
        $this->geo_enabled = $geo_enabled;
    }


    /**
     * Returns verified.
     * @return string
     */
    public function getverified()
    {
        return $this->verified;
    }

    /**
     * Sets verified.
     * @param string $verified
     */
    public function setverified($verified)
    {
        $this->verified = $verified;
    }

    /**
     * Returns statuses_count.
     * @return integer
     */
    public function getstatuses_count()
    {
        return $this->statuses_count;
    }

    /**
     * Sets statuses_count.
     * @param int $statuses_count
     */
    public function setstatuses_count($statuses_count)
    {
        $this->statuses_count = $statuses_count;
    }

    /**
     * Returns lang.
     * @return string
     */
    public function getlang()
    {
        return $this->lang;
    }

    /**
     * Sets lang.
     * @param string $lang
     */
    public function setlang($lang)
    {
        $this->lang = $lang;
    }

    /**
     * Returns contributors_enabled.
     * @return string
     */
    public function getcontributors_enabled()
    {
        return $this->contributors_enabled;
    }

    /**
     * Sets contributors_enabled.
     * @param string $contributors_enabled
     */
    public function setcontributors_enabled($contributors_enabled)
    {
        $this->contributors_enabled = $contributors_enabled;
    }

    /**
     * Returns is_translator.
     * @return string
     */
    public function getis_translator()
    {
        return $this->is_translator;
    }

    /**
     * Sets is_translator.
     * @param string $is_translator
     */
    public function setis_translator($is_translator)
    {
        $this->is_translator = $is_translator;
    }

    /**
     * Returns is_translation_enabled.
     * @return string
     */
    public function getis_translation_enabled()
    {
        return $this->is_translation_enabled;
    }

    /**
     * Sets is_translation_enabled.
     * @param string $is_translation_enabled
     */
    public function setis_translation_enabled($is_translation_enabled)
    {
        $this->is_translation_enabled = $is_translation_enabled;
    }

    /**
     * Returns profile_background_color.
     * @return string
     */
    public function getprofile_background_color()
    {
        return $this->profile_background_color;
    }

    /**
     * Sets profile_background_color.
     * @param string $profile_background_color
     */
    public function setprofile_background_color($profile_background_color)
    {
        $this->profile_background_color = $profile_background_color;
    }


    /**
     * Returns profile_background_image_url.
     * @return string
     */
    public function getprofile_background_image_url()
    {
        return $this->profile_background_image_url;
    }

    /**
     * Sets profile_background_image_url.
     * @param string $profile_background_image_url
     */
    public function setprofile_background_image_url($profile_background_image_url)
    {
        $this->profile_background_image_url = $profile_background_image_url;
    }


    /**
     * Returns profile_background_image_url_https.
     * @return string
     */
    public function getprofile_background_image_url_https()
    {
        return $this->profile_background_image_url_https;
    }

    /**
     * Sets profile_background_image_url_https.
     * @param string $profile_background_image_url_https
     */
    public function setprofile_background_image_url_https($profile_background_image_url_https)
    {
        $this->profile_background_image_url_https = $profile_background_image_url_https;
    }


    /**
     * Returns profile_background_tile.
     * @return string
     */
    public function getprofile_background_tile()
    {
        return $this->profile_background_tile;
    }

    /**
     * Sets profile_background_tile.
     * @param string $profile_background_tile
     */
    public function setprofile_background_tile($profile_background_tile)
    {
        $this->profile_background_tile = $profile_background_tile;
    }



    /**
     * Returns profile_image_url.
     * @return string
     */
    public function getprofile_image_url()
    {
        return $this->profile_image_url;
    }

    /**
     * Sets profile_image_url.
     * @param string $profile_image_url
     */
    public function setprofile_image_url($profile_image_url)
    {
        $this->profile_image_url = $profile_image_url;
    }


    /**
     * Returns profile_image_url_https.
     * @return string
     */
    public function getprofile_image_url_https()
    {
        return $this->profile_image_url_https;
    }

    /**
     * Sets profile_image_url_https.
     * @param string $profile_image_url_https
     */
    public function setprofile_image_url_https($profile_image_url_https)
    {
        $this->profile_image_url_https = $profile_image_url_https;
    }


    /**
     * Returns profile_link_color.
     * @return string
     */
    public function getprofile_link_color()
    {
        return $this->profile_link_color;
    }

    /**
     * Sets profile_link_color.
     * @param string $profile_link_color
     */
    public function setprofile_link_color($profile_link_color)
    {
        $this->profile_link_color = $profile_link_color;
    }


    /**
     * Returns profile_sidebar_border_color.
     * @return string
     */
    public function getprofile_sidebar_border_color()
    {
        return $this->profile_sidebar_border_color;
    }

    /**
     * Sets profile_sidebar_border_color.
     * @param string $profile_sidebar_border_color
     */
    public function setprofile_sidebar_border_color($profile_sidebar_border_color)
    {
        $this->profile_sidebar_border_color = $profile_sidebar_border_color;
    }


    /**
     * Returns profile_sidebar_fill_color.
     * @return string
     */
    public function getprofile_sidebar_fill_color()
    {
        return $this->profile_sidebar_fill_color;
    }

    /**
     * Sets profile_sidebar_fill_color.
     * @param string $profile_sidebar_fill_color
     */
    public function setprofile_sidebar_fill_color($profile_sidebar_fill_color)
    {
        $this->profile_sidebar_fill_color = $profile_sidebar_fill_color;
    }


    /**
     * Returns profile_text_color.
     * @return string
     */
    public function getprofile_text_color()
    {
        return $this->profile_text_color;
    }

    /**
     * Sets profile_text_color.
     * @param string $profile_text_color
     */
    public function setprofile_text_color($profile_text_color)
    {
        $this->profile_text_color = $profile_text_color;
    }


    /**
     * Returns profile_use_background_image.
     * @return string
     */
    public function getprofile_use_background_image()
    {
        return $this->profile_use_background_image;
    }

    /**
     * Sets profile_use_background_image.
     * @param string $profile_use_background_image
     */
    public function setprofile_use_background_image($profile_use_background_image)
    {
        $this->profile_use_background_image = $profile_use_background_image;
    }


    /**
     * Returns has_extended_profile.
     * @return string
     */
    public function gethas_extended_profile()
    {
        return $this->has_extended_profile;
    }

    /**
     * Sets has_extended_profile.
     * @param string $has_extended_profile
     */
    public function sethas_extended_profile($has_extended_profile)
    {
        $this->has_extended_profile = $has_extended_profile;
    }

    /**
     * Returns default_profile.
     * @return string
     */
    public function getdefault_profile()
    {
        return $this->default_profile;
    }

    /**
     * Sets default_profile.
     * @param string $default_profile
     */
    public function setdefault_profile($default_profile)
    {
        $this->default_profile = $default_profile;
    }



    /**
     * Returns default_profile_image.
     * @return string
     */
    public function getdefault_profile_image()
    {
        return $this->default_profile_image;
    }

    /**
     * Sets default_profile_image.
     * @param string $default_profile_image
     */
    public function setdefault_profile_image($default_profile_image)
    {
        $this->default_profile_image = $default_profile_image;
    }


    /**
     * Returns following.
     * @return string
     */
    public function getfollowing()
    {
        return $this->following;
    }

    /**
     * Sets following.
     * @param string $following
     */
    public function setfollowing($following)
    {
        $this->following = $following;
    }

    /**
     * Returns follow_request_sent.
     * @return string
     */
    public function getfollow_request_sent()
    {
        return $this->follow_request_sent;
    }

    /**
     * Sets follow_request_sent.
     * @param string $follow_request_sent
     */
    public function setfollow_request_sent($follow_request_sent)
    {
        $this->follow_request_sent = $follow_request_sent;
    }


    /**
     * Returns notifications.
     * @return string
     */
    public function getnotifications()
    {
        return $this->notifications;
    }

    /**
     * Sets notifications.
     * @param string $notifications
     */
    public function setnotifications($notifications)
    {
        $this->notifications = $notifications;
    }


    /**
     * Returns translator_type.
     * @return string
     */
    public function gettranslator_type()
    {
        return $this->translator_type;
    }

    /**
     * Sets translator_type.
     * @param string $translator_type
     */
    public function settranslator_type($translator_type)
    {
        $this->translator_type = $translator_type;
    }


    /**
     * Returns the date of user creation.
     * @return string     
     */
    public function getDateCreated() 
    {
        return $this->dateCreated;
    }

    /**
     * Sets the date when this user was created.
     * @param string $dateCreated     
     */
    public function setDateCreated($dateCreated) 
    {
        $this->dateCreated = $dateCreated;
    }    
    



    

}



