<?php
namespace User\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * This class represents a registered user.
 * @ORM\Entity()
 * @ORM\Table(name="core_user_google")
 */
class UserGoogle
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
     * @ORM\Column(name="google_id")
     */
    protected $google_id;


    /**
     * @ORM\Column(name="scope")
     */
    protected $scope;


    /** 
     * @ORM\Column(name="access_token")
     */

    protected $access_token;

    /**
     * @ORM\Column(name="token_type")
     */
    protected $token_type;
    /**
     * @ORM\Column(name="expires_in")
     */
    protected $expires_in;

    /**
     * @ORM\Column(name="id_token")
     */
    protected $id_token;

    /**
     * @ORM\Column(name="created")
     */
    protected $created;

    /** 
     * @ORM\Column(name="familyName")
     */
    protected $familyName;
    
    /**
     * @ORM\Column(name="gender")
     */
    protected $gender;
        
    /**
     * @ORM\Column(name="givenName")
     */
    protected $givenName;
    
    /**
     * @ORM\Column(name="hd")
     */
    protected $hd;

    /**
     * @ORM\Column(name="link")
     */
    protected $link;

    /**
     * @ORM\Column(name="locale")
     */
    protected $locale;

    /**
     * @ORM\Column(name="name")
     */
    protected $name;

    /**
     * @ORM\Column(name="picture")
     */
    protected $picture;

    /**
     * @ORM\Column(name="verifiedEmail")
     */
    protected $verifiedEmail;



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
     * Returns google_id.
     * @return string
     */
    public function getgoogle_id()
    {
        return $this->google_id;
    }
    /**
     * Sets google_id.
     * @param string $google_id
     */
    public function setgoogle_id($google_id)
    {
        $this->google_id = $google_id;
    }

    /**
     * Returns scope.
     * @return string
     */
    public function getscope()
    {
        return $this->scope;
    }
    /**
     * Sets scope.
     * @param string $scope
     */
    public function setscope($scope)
    {
        $this->scope = $scope;
    }


    /**
     * Returns access_token.
     * @return string
     */
    public function getaccess_token()
    {
        return $this->access_token;
    }

    /**
     * Sets access_token.
     * @param string $access_token
     */
    public function setaccess_token($access_token)
    {
        $this->access_token = $access_token;
    }

    /**
     * Returns token_type.
     * @return string
     */
    public function gettoken_type()
    {
        return $this->token_type;
    }

    /**
     * Sets token_type.
     * @param string $token_type
     */
    public function settoken_type($token_type)
    {
        $this->token_type = $token_type;
    }

    /**
     * Returns expires_in.
     * @return string
     */
    public function getexpires_in()
    {
        return $this->expires_in;
    }

    /**
     * Sets expires_in.
     * @param string $expires_in
     */
    public function setexpires_in($expires_in)
    {
        $this->expires_in = $expires_in;
    }

    /**
     * Returns id_token.
     * @return string
     */
    public function getid_token()
    {
        return $this->id_token;
    }

    /**
     * Sets id_token.
     * @param string $id_token
     */
    public function setid_token($id_token)
    {
        $this->id_token = $id_token;
    }

    /**
     * Returns created.
     * @return string     
     */
    public function getcreated()
    {
        return $this->created;
    }       

    /**
     * Sets created.
     * @param string $created
     */
    public function setcreated($created)
    {
        $this->created = $created;
    }

    /**
     * Returns familyName.
     * @return string
     */
    public function getfamilyName()
    {
        return $this->familyName;
    }

    /**
     * Sets familyName.
     * @param string $familyName
     */
    public function setfamilyName($familyName)
    {
        $this->familyName = $familyName;
    }

    /**
     * Returns gender.
     * @return string
     */
    public function getgender()
    {
        return $this->gender;
    }

    /**
     * Sets gender.
     * @param string $gender
     */
    public function setgender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * Returns givenName.
     * @return string
     */
    public function getgivenName()
    {
        return $this->givenName;
    }

    /**
     * Sets givenName.
     * @param string $givenName
     */
    public function setgivenName($givenName)
    {
        $this->givenName = $givenName;
    }

    /**
     * Returns hd.
     * @return string
     */
    public function gethd()
    {
        return $this->hd;
    }

    /**
     * Sets hd.
     * @param string $hd
     */
    public function sethd($hd)
    {
        $this->hd = $hd;
    }

    /**
     * Returns link.
     * @return string
     */
    public function getlink()
    {
        return $this->link;
    }

    /**
     * Sets link.
     * @param string $link
     */
    public function setlink($link)
    {
        $this->link = $link;
    }

    /**
     * Returns locale.
     * @return string
     */
    public function getlocale()
    {
        return $this->locale;
    }

    /**
     * Sets locale.
     * @param string $locale
     */
    public function setlocale($locale)
    {
        $this->locale = $locale;
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
     * Returns picture.
     * @return string
     */
    public function getpicture()
    {
        return $this->picture;
    }

    /**
     * Sets picture.
     * @param string $picture
     */
    public function setpicture($picture)
    {
        $this->picture = $picture;
    }


    /**
     * Returns verifiedEmail.
     * @return string
     */
    public function getverifiedEmail()
    {
        return $this->verifiedEmail;
    }

    /**
     * Sets verifiedEmail.
     * @param string $verifiedEmail
     */
    public function setverifiedEmail($verifiedEmail)
    {
        $this->verifiedEmail = $verifiedEmail;
    }





    

}



