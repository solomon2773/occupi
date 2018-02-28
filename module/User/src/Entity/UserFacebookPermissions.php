<?php
namespace User\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * This class represents a registered user.
 * @ORM\Entity()
 * @ORM\Table(name="core_user_facebook_permissions")
 */
class UserFacebookPermissions
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
     * @ORM\Column(name="fb_userID")
     */
    protected $fb_userID;
    
    /** 
     * @ORM\Column(name="permission")
     */
    protected $permission;

    /** 
     * @ORM\Column(name="status")
     */
    protected $status;

    protected $UserFacebookPermissions;
    /**
     * Constructor.
     */
    public function __construct() 
    {
        $this->UserFacebookPermissions = new ArrayCollection();
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
     * Returns fb_userID.
     * @return string
     */
    public function getfb_userID()
    {
        return $this->fb_userID;
    }
    /**
     * Sets fb_userID.
     * @param string $fb_userID
     */
    public function setfb_userID($fb_userID)
    {
        $this->fb_userID = $fb_userID;
    }

    /**
     * Returns permission.
     * @return string
     */
    public function getpermission()
    {
        return $this->permission;
    }
    /**
     * Sets permission.
     * @param string $permission
     */
    public function setpermission($permission)
    {
        $this->permission = $permission;
    }


    /**
     * Returns status.
     * @return string
     */
    public function getstatus()
    {
        return $this->status;
    }

    /**
     * Sets status.
     * @param string $status
     */
    public function setstatus($status)
    {
        $this->status = $status;
    }



    

}



