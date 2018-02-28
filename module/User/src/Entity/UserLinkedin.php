<?php
namespace User\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * This class represents a registered user.
 * @ORM\Entity()
 * @ORM\Table(name="core_user_linkedin")
 */
class UserLinkedin
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
     * @ORM\Column(name="linkedin_userID")
     */
    protected $linkedin_userID;



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
     * @ORM\Column(name="formattedName")
     */
    protected $formattedName;

    /**
     * @ORM\Column(name="firstName")
     */
    protected $firstName;

    /** 
     * @ORM\Column(name="lastName")
     */
    protected $lastName;
    
    /**
     * @ORM\Column(name="headline")
     */
    protected $headline;
        
    /**
     * @ORM\Column(name="industry")
     */
    protected $industry;
    
    /**
     * @ORM\Column(name="location")
     */
    protected $location;

    /**
     * @ORM\Column(name="numConnections")
     */
    protected $numConnections;

    /**
     * @ORM\Column(name="pictureUrl")
     */
    protected $pictureUrl;

    /**
     * @ORM\Column(name="pictureUrls")
     */
    protected $pictureUrls;

    /**
     * @ORM\Column(name="positions")
     */
    protected $positions;

    /**
     * @ORM\Column(name="publicProfileUrl")
     */
    protected $publicProfileUrl;

    /**
     * @ORM\Column(name="siteStandardProfileRequest")
     */
    protected $siteStandardProfileRequest;

    /**
     * @ORM\Column(name="summary")
     */
    protected $summary;

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
     * Returns linkedin_userID.
     * @return string
     */
    public function getlinkedin_userID()
    {
        return $this->linkedin_userID;
    }
    /**
     * Sets linkedin_userID.
     * @param string $linkedin_userID
     */
    public function setlinkedin_userID($linkedin_userID)
    {
        $this->linkedin_userID = $linkedin_userID;
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
     * Returns formattedName.
     * @return string
     */
    public function getformattedName()
    {
        return $this->formattedName;
    }

    /**
     * Sets formattedName.
     * @param string $formattedName
     */
    public function setformattedName($formattedName)
    {
        $this->formattedName = $formattedName;
    }


    /**
     * Returns firstName.
     * @return string     
     */
    public function getfirstName()
    {
        return $this->firstName;
    }       

    /**
     * Sets firstName.
     * @param string $firstName
     */
    public function setfirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * Returns lastName.
     * @return string
     */
    public function getlastName()
    {
        return $this->lastName;
    }

    /**
     * Sets lastName.
     * @param string $lastName
     */
    public function setlastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * Returns headline.
     * @return string
     */
    public function getheadline()
    {
        return $this->headline;
    }

    /**
     * Sets headline.
     * @param string $headline
     */
    public function setheadline($headline)
    {
        $this->headline = $headline;
    }

    /**
     * Returns industry.
     * @return string
     */
    public function getindustry()
    {
        return $this->industry;
    }

    /**
     * Sets industry.
     * @param string $industry
     */
    public function setindustry($industry)
    {
        $this->industry = $industry;
    }

    /**
     * Returns location.
     * @return string
     */
    public function getlocation()
    {
        return $this->location;
    }

    /**
     * Sets location.
     * @param string $location
     */
    public function setlocation($location)
    {
        $this->location = $location;
    }

    /**
     * Returns numConnections.
     * @return string
     */
    public function getnumConnections()
    {
        return $this->numConnections;
    }

    /**
     * Sets numConnections.
     * @param string $numConnections
     */
    public function setnumConnections($numConnections)
    {
        $this->numConnections = $numConnections;
    }

    /**
     * Returns pictureUrl.
     * @return string
     */
    public function getpictureUrl()
    {
        return $this->pictureUrl;
    }

    /**
     * Sets pictureUrl.
     * @param string $pictureUrl
     */
    public function setpictureUrl($pictureUrl)
    {
        $this->pictureUrl = $pictureUrl;
    }

    /**
     * Returns pictureUrls.
     * @return string
     */
    public function getpictureUrls()
    {
        return $this->pictureUrls;
    }

    /**
     * Sets pictureUrls.
     * @param string $pictureUrls
     */
    public function setpictureUrls($pictureUrls)
    {
        $this->pictureUrls = $pictureUrls;
    }

    /**
     * Returns positions.
     * @return string
     */
    public function getpositions()
    {
        return $this->positions;
    }

    /**
     * Sets positions.
     * @param string $positions
     */
    public function setpositions($positions)
    {
        $this->positions = $positions;
    }


    /**
     * Returns publicProfileUrl.
     * @return string
     */
    public function getpublicProfileUrl()
    {
        return $this->publicProfileUrl;
    }

    /**
     * Sets publicProfileUrl.
     * @param string $publicProfileUrl
     */
    public function setpublicProfileUrl($publicProfileUrl)
    {
        $this->publicProfileUrl = $publicProfileUrl;
    }


    /**
     * Returns siteStandardProfileRequest.
     * @return string
     */
    public function getsiteStandardProfileRequest()
    {
        return $this->siteStandardProfileRequest;
    }

    /**
     * Sets siteStandardProfileRequest.
     * @param string $siteStandardProfileRequest
     */
    public function setsiteStandardProfileRequest($siteStandardProfileRequest)
    {
        $this->siteStandardProfileRequest = $siteStandardProfileRequest;
    }

    /**
     * Returns summary.
     * @return string
     */
    public function getsummary()
    {
        return $this->summary;
    }

    /**
     * Sets summary.
     * @param string $summary
     */
    public function setsummary($summary)
    {
        $this->summary = $summary;
    }


    /**
     * Returns dateCreated.
     * @return string
     */
    public function getdateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * Sets dateCreated.
     * @param string $dateCreated
     */
    public function setdateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;
    }

}



