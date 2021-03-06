<?php

namespace OC\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * Advert
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="OC\PlatformBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @var int
     *
     * @ORM\Column(name="dailymotion_id", type="string", length=255, nullable=true)
     */
    protected $dailymotion_id;

    /**
     * @var string
     *
     * @ORM\Column(name="dailymotion_password", type="string", length=255, nullable=true)
     */
    protected $dailymotion_password;

	public function __construct()
	{
		parent:: __construct();
		
	}
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * Get Dailymotion Id
     *
     * @return string dailymotion_id
     */
     public function getDailymotionId()
    {
        return $this->dailymotion_id;
    }
    /**
     * Set Dailymotion Id
     *
     * @param string $dailymotion_id
     *
     * @return User
     */
    public function setDailymotionId($dailymotion_id)
    {
        $this->dailymotion_id = $dailymotion_id;

        return $this;
    }
    /**
     * Set Dailymotion Password
     *
     * @param string $dailymotion_password
     *
     * @return User
     */
    public function setDailymotionPassword($dailymotion_password)
    {
        $this->dailymotion_password = $dailymotion_password;

        return $this;
    }
    /**
     * Get Dailymotion Password
     *
     * @return string
     */
    public function getDailymotionPassword()
    {
        return $this->dailymotion_password;
    }
}

