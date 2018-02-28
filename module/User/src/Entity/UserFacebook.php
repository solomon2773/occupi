<?php
namespace User\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * This class represents a registered user.
 * @ORM\Entity()
 * @ORM\Table(name="core_user_facebook")
 */
class UserFacebook
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
     * @ORM\Column(name="fb_userID")
     */
    protected $fb_userID;

    /** 
     * @ORM\Column(name="fb_name")
     */
    protected $fb_name;

    /**
     * @ORM\Column(name="fb_email")
     */
    protected $fb_email;
    /**
     * @ORM\Column(name="fb_user_token")
     */
    protected $fb_user_token;

    /**
     * @ORM\Column(name="fb_user_token_type")
     */
    protected $fb_user_token_type;

    /**
     * @ORM\Column(name="fb_user_token_expiresin")
     */
    protected $fb_user_token_expiresin;

    /** 
     * @ORM\Column(name="fb_first_name")
     */
    protected $fb_first_name;
    
    /**
     * @ORM\Column(name="fb_middle_name")
     */
    protected $fb_middle_name;
        
    /**
     * @ORM\Column(name="fb_last_name")
     */
    protected $fb_last_name;
    
    /**
     * @ORM\Column(name="fb_gender")
     */
    protected $fb_gender;

    /**
     * @ORM\Column(name="fb_locale")
     */
    protected $fb_locale;

    /**
     * @ORM\Column(name="fb_languages")
     */
    protected $fb_languages;

    /**
     * @ORM\Column(name="fb_link")
     */
    protected $fb_link;

    /**
     * @ORM\Column(name="fb_third_party_id")
     */
    protected $fb_third_party_id;

    /**
     * @ORM\Column(name="fb_timezone")
     */
    protected $fb_timezone;

    /**
     * @ORM\Column(name="fb_updated_time")
     */
    protected $fb_updated_time;

    /**
     * @ORM\Column(name="fb_verified")
     */
    protected $fb_verified;

    /**
     * @ORM\Column(name="fb_age_range")
     */
    protected $fb_age_range;

    /**
     * @ORM\Column(name="fb_bio")
     */
    protected $fb_bio;

    /**
     * @ORM\Column(name="ft_birthday")
     */
    protected $ft_birthday;

    /**
     * @ORM\Column(name="fb_cover")
     */
    protected $fb_cover;

    /**
     * @ORM\Column(name="fb_currency")
     */
    protected $fb_currency;

    /**
     * @ORM\Column(name="fb_devices")
     */
    protected $fb_devices;

    /**
     * @ORM\Column(name="fb_education")
     */
    protected $fb_education;



    /**
     * @ORM\Column(name="fb_hometown")
     */
    protected $fb_hometown;

    /**
     * @ORM\Column(name="fb_interested_in")
     */
    protected $fb_interested_in;

    /**
     * @ORM\Column(name="fb_location")
     */
    protected $fb_location;

    /**
     * @ORM\Column(name="fb_political")
     */
    protected $fb_political;

    /**
     * @ORM\Column(name="fb_payment_pricepoints")
     */
    protected $fb_payment_pricepoints;

    /**
     * @ORM\Column(name="fb_favorite_athletes")
     */
    protected $fb_favorite_athletes;

    /**
     * @ORM\Column(name="fb_favorite_teams")
     */
    protected $fb_favorite_teams;

    /**
     * @ORM\Column(name="fb_picture")
     */
    protected $fb_picture;

    /**
     * @ORM\Column(name="fb_quotes")
     */
    protected $fb_quotes;

    /**
     * @ORM\Column(name="fb_relationship_status")
     */
    protected $fb_relationship_status;

    /**
     * @ORM\Column(name="fb_religion")
     */
    protected $fb_religion;

    /**
     * @ORM\Column(name="fb_significant_other")
     */
    protected $fb_significant_other;

    /**
     * @ORM\Column(name="fb_video_upload_limits")
     */
    protected $fb_video_upload_limits;

    /**
     * @ORM\Column(name="fb_website")
     */
    protected $fb_website;

    /**
     * @ORM\Column(name="fb_work")
     */
    protected $fb_work;

    /**
     * @ORM\Column(name="fb_all_data")
     */
    protected $fb_all_data;

    /**
     * @ORM\Column(name="fb_all_data_updated")
     */
    protected $fb_all_data_updated;

    /**
     * @ORM\Column(name="create_date")
     */
    protected $create_date;

    /**
     * @ORM\Column(name="last_update")
     */
    protected $last_update;

    /**
     * @ORM\Column(name="itm_del")
     */
    protected $itm_del;




    /**
     * Constructor.
     */
    public function __construct() 
    {
        $this->userfacebook = new ArrayCollection();
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
     * Returns fb_userID.
     * @return string
     */
    public function getfb_userID()
    {
        return $this->fb_userID;
    }
    /**
     * Sets fb_userID.
     * @param string $id
     */
    public function setfb_userID($id)
    {
        $this->fb_userID = $id;
    }


    /**
     * Returns fb_email.
     * @return string
     */
    public function getEmail() 
    {
        return $this->fb_email;
    }

    /**
     * Sets fb_email.
     * @param string $email
     */
    public function setEmail($email) 
    {
        $this->fb_email = $email;
    }

    /**
     * Returns fb_user_token.
     * @return text
     */
    public function getfb_user_token()
    {
        return $this->fb_user_token;
    }

    /**
     * Sets fb_user_token.
     * @param text $fb_user_token
     */
    public function setfb_user_token($fb_user_token)
    {
        $this->fb_user_token = $fb_user_token;
    }

    /**
     * Returns fb_user_token_type.
     * @return string
     */
    public function getfb_user_token_type()
    {
        return $this->fb_user_token_type;
    }

    /**
     * Sets fb_user_token_type.
     * @param string $fb_user_token_type
     */
    public function setfb_user_token_type($fb_user_token_type)
    {
        $this->fb_user_token_type = $fb_user_token_type;
    }

    /**
     * Returns fb_user_token_expiresin.
     * @return string
     */
    public function getfb_user_token_expiresin()
    {
        return $this->fb_user_token_expiresin;
    }

    /**
     * Sets fb_user_token_expiresin.
     * @param string $fb_user_token_expiresin
     */
    public function setfb_user_token_expiresin($fb_user_token_expiresin)
    {
        $this->fb_user_token_expiresin = $fb_user_token_expiresin;
    }

    /**
     * Returns full name.
     * @return string     
     */
    public function getfb_name()
    {
        return $this->fb_name;
    }       

    /**
     * Sets full name.
     * @param string $fullName
     */
    public function setfb_name($fullName)
    {
        $this->fb_name = $fullName;
    }

    /**
     * Returns fb_first_name.
     * @return string
     */
    public function getfb_first_name()
    {
        return $this->fb_first_name;
    }

    /**
     * Sets fb_first_name.
     * @param string $fb_first_name
     */
    public function setfb_first_name($fb_first_name)
    {
        $this->fb_first_name = $fb_first_name;
    }

    /**
     * Returns fb_middle_name.
     * @return string
     */
    public function getfb_middle_name()
    {
        return $this->fb_middle_name;
    }

    /**
     * Sets fb_middle_name.
     * @param string $fb_middle_name
     */
    public function setfb_middle_name($fb_middle_name)
    {
        $this->fb_middle_name = $fb_middle_name;
    }

    /**
     * Returns fb_last_name.
     * @return string
     */
    public function getfb_last_name()
    {
        return $this->fb_last_name;
    }

    /**
     * Sets fb_last_name.
     * @param string $fb_last_name
     */
    public function setfb_last_name($fb_last_name)
    {
        $this->fb_last_name = $fb_last_name;
    }

    /**
     * Returns fb_gender.
     * @return string
     */
    public function getfb_gender()
    {
        return $this->fb_gender;
    }

    /**
     * Sets fb_gender.
     * @param string $fb_gender
     */
    public function setfb_gender($fb_gender)
    {
        $this->fb_gender = $fb_gender;
    }

    /**
     * Returns fb_locale.
     * @return string
     */
    public function getfb_locale()
    {
        return $this->fb_locale;
    }

    /**
     * Sets fb_locale.
     * @param string $fb_locale
     */
    public function setfb_locale($fb_locale)
    {
        $this->fb_locale = $fb_locale;
    }

    /**
     * Returns fb_languages.
     * @return string
     */
    public function getfb_languages()
    {
        return $this->fb_languages;
    }

    /**
     * Sets fb_languages.
     * @param string $fb_languages
     */
    public function setfb_languages($fb_languages)
    {
        $this->fb_languages = $fb_languages;
    }

    /**
     * Returns fb_link.
     * @return string
     */
    public function getfb_link()
    {
        return $this->fb_link;
    }

    /**
     * Sets fb_link.
     * @param string $fb_link
     */
    public function setfb_link($fb_link)
    {
        $this->fb_link = $fb_link;
    }

    /**
     * Returns fb_third_party_id.
     * @return string
     */
    public function getfb_third_party_id()
    {
        return $this->fb_third_party_id;
    }

    /**
     * Sets fb_third_party_id.
     * @param string $fb_third_party_id
     */
    public function setfb_third_party_id($fb_third_party_id)
    {
        $this->fb_third_party_id = $fb_third_party_id;
    }


    /**
     * Returns fb_timezone.
     * @return string
     */
    public function getfb_timezone()
    {
        return $this->fb_timezone;
    }

    /**
     * Sets fb_timezone.
     * @param string $fb_timezone
     */
    public function setfb_timezone($fb_timezone)
    {
        $this->fb_timezone = $fb_timezone;
    }


    /**
     * Returns fb_updated_time.
     * @return string
     */
    public function getfb_updated_time()
    {
        return $this->fb_updated_time;
    }

    /**
     * Sets fb_updated_time.
     * @param string $fb_updated_time
     */
    public function setfb_updated_time($fb_updated_time)
    {
        $this->fb_updated_time = $fb_updated_time;
    }


    /**
     * Returns fb_verified.
     * @return string
     */
    public function getfb_verified()
    {
        return $this->fb_verified;
    }

    /**
     * Sets fb_verified.
     * @param string $fb_verified
     */
    public function setfb_verified($fb_verified)
    {
        $this->fb_verified = $fb_verified;
    }


    /**
     * Returns fb_age_range.
     * @return string
     */
    public function getfb_age_range()
    {
        return $this->fb_age_range;
    }

    /**
     * Sets fb_age_range.
     * @param string $fb_age_range
     */
    public function setfb_age_range($fb_age_range)
    {
        $this->fb_age_range = $fb_age_range;
    }


    /**
     * Returns fb_bio.
     * @return string
     */
    public function getfb_bio()
    {
        return $this->fb_bio;
    }

    /**
     * Sets fb_bio.
     * @param string $fb_bio
     */
    public function setfb_bio($fb_bio)
    {
        $this->fb_bio = $fb_bio;
    }

    /**
     * Returns ft_birthday.
     * @return string
     */
    public function getft_birthday()
    {
        return $this->ft_birthday;
    }

    /**
     * Sets ft_birthday.
     * @param string $ft_birthday
     */
    public function setft_birthday($ft_birthday)
    {
        $this->ft_birthday = $ft_birthday;
    }

    /**
     * Returns fb_cover.
     * @return text
     */
    public function getfb_cover()
    {
        return $this->fb_cover;
    }

    /**
     * Sets fb_cover.
     * @param text $fb_cover
     */
    public function setfb_cover($fb_cover)
    {
        $this->fb_cover = $fb_cover;
    }

    /**
     * Returns fb_picture.
     * @return text
     */
    public function getfb_picture()
    {
        return $this->fb_picture;
    }

    /**
     * Sets fb_picture.
     * @param text $fb_picture
     */
    public function setfb_picture($fb_picture)
    {
        $this->fb_picture = $fb_picture;
    }

    /**
     * Returns possible statuses as array.
     * @return array
     */
    public static function getStatusList() 
    {
        return [
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_RETIRED => 'Retired'
        ];
    }    
    
    /**
     * Returns user status as string.
     * @return string
     */
    public function getStatusAsString()
    {
        $list = self::getStatusList();
        if (isset($list[$this->status]))
            return $list[$this->status];
        
        return 'Unknown';
    }    
    
    /**
     * Sets status.
     * @param int $status     
     */
    public function setStatus($status) 
    {
        $this->status = $status;
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



