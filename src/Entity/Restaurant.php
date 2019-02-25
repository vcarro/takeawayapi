<?php
/**
 * Restaurant.php
 *
 * Restaurant Entity
 *
 * @category   Entity
 * @package    TakeawayAPI
 * @author     Vidal Carro
 * @copyright  2019 Vidal Carro
 * @license    http://www.php.net/license/3_0.txt  PHP License 3.0
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTime;
use JMS\Serializer\Annotation as Serializer;

/**
 * Restaurant
 * @ORM\Table(name="restaurant")
 * @ORM\Entity(repositoryClass="App\Repository\RestaurantRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Restaurant
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @Serializer\Until("5.12.299")
     * @Serializer\SerializedName("name")
     * @ORM\Column(name="name", type="string", length=250)
     */
    protected $name;

    /**
     * @ORM\Column(name="branch", type="string", length=100, nullable=true)
     */
    protected $branch;

    /**
     * @ORM\Column(name="phone", type="string", length=30, nullable=true)
     *
     */
    protected $phone;

    /**
     * @ORM\Column(name="email", type="string", length=100, nullable=true)
     */
    protected $email;

    /**
     * @ORM\Column(name="logo", type="string", length=250)
     */
    protected $logo;

    /**
     * @ORM\Column(name="address", type="string", length=250)
     *
     */
    protected $address;

    /**
     * @ORM\Column(name="housenumber", type="string", length=10, nullable=true)
     *
     */
    protected $housenumber;

    /**
     * @ORM\Column(name="postcode", type="string", length=10, nullable=true)
     *
     */
    protected $postcode;

    /**
     * @ORM\Column(name="city", type="string", length=100)
     *
     */
    protected $city;

    
    /**
     * @ORM\Column(name="latitude", type="decimal", precision=10, scale=8, nullable=true)
     *
     */
    protected $latitude;

    /**
     * @ORM\Column(name="longitude", type="decimal", precision=10, scale=8, nullable=true)
     *
     */
    protected $longitude;

    /**
     * @ORM\Column(name="url", type="string", length=250)
     *
     */
    protected $url;

    /**
     * @ORM\Column(name="open", type="integer")
     *
     */
    protected $open;

    /**
     * @ORM\Column(name="bestMatch", type="integer")
     *
     */
    protected $bestMatch;

    /**
     * @ORM\Column(name="newestScore", type="integer")
     *
     */
    protected $newestScore;

    /**
     * @ORM\Column(name="ratingAverage", type="integer")
     *
     */
    protected $ratingAverage;

    /**
     * @ORM\Column(name="popularity", type="integer")
     *
     */
    protected $popularity;

    /**
     * @ORM\Column(name="averageProductPrice", type="decimal", precision=4, scale=2, nullable=true)
     *
     */
    protected $averageProductPrice;

    /**
     * @ORM\Column(name="deliveryCosts", type="decimal", precision=4, scale=2)
     *
     */
    protected $deliveryCosts;
    
    /**
     * @ORM\Column(name="minimumOrderAmount", type="decimal", precision=4, scale=2)
     *
     */
    protected $minimumOrderAmount;


    /**
     * @ORM\Column(name="created_at", type="datetime")
     * 
     * @Serializer\Exclude()
     */
    protected $createdAt;

    /**
     * @ORM\Column(name="updated_at", type="datetime")
     * @Serializer\Exclude()
     */
    protected $updatedAt;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getname()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setname($name)
    {
        $this->name = $name;
    }

    /**
     * @Serializer\VirtualProperty()
     * @Serializer\Since("5.12.300")
     * @Serializer\SerializedName("RestaurantName")
     */
    public function getRestaurantName()
    {
        return $this->getname();
    }

    /**
     * @return mixed
     */
    public function getbranch()
    {
        return $this->branch;
    }

    /**
     * @param mixed $branch
     */
    public function setbranch($branch)
    {
        $this->branch = $branch;
    }

    /**
     * @return mixed
     */
    public function getphone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setphone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getemail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setemail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getlogo()
    {
        return $this->logo;
    }

    /**
     * @param mixed $logo
     */
    public function setlogo($logo)
    {
        $this->logo = $logo;
    }

    /**
     * @return mixed
     */
    public function getaddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setaddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function gethousenumber()
    {
        return $this->housenumber;
    }

    /**
     * @param mixed $housenumber
     */
    public function sethousenumber($housenumber)
    {
        $this->housenumber = $housenumber;
    }

    /**
     * @return mixed
     */
    public function getpostcode()
    {
        return $this->postcode;
    }

    /**
     * @param mixed $postcode
     */
    public function setpostcode($postcode)
    {
        $this->postcode = $postcode;
    }

    /**
     * @return mixed
     */
    public function getcity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setcity($city)
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getlatitude()
    {
        return $this->latitude;
    }

    /**
     * @param mixed $latitude
     */
    public function setlatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    /**
     * @return mixed
     */
    public function getlongitude()
    {
        return $this->longitude;
    }

    /**
     * @param mixed $longitude
     */
    public function setlongitude($longitude)
    {
        $this->longitude = $longitude;
    }

    /**
     * @return mixed
     */
    public function geturl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function seturl($url)
    {
        $this->url = $url;
    }

    /**
     * @return mixed
     */
    public function getopen()
    {
        return $this->open;
    }

    /**
     * @param mixed $open
     */
    public function setopen($open)
    {
        $this->open = $open;
    }

    /**
     * @return mixed
     */
    public function getbestMatch()
    {
        return $this->bestMatch;
    }

    /**
     * @param mixed $bestMatch
     */
    public function setbestMatch($bestMatch)
    {
        $this->bestMatch = $bestMatch;
    }

    /**
     * @return mixed
     */
    public function getnewestScore()
    {
        return $this->newestScore;
    }

    /**
     * @param mixed $newestScore
     */
    public function setnewestScore($newestScore)
    {
        $this->newestScore = $newestScore;
    }

    /**
     * @return mixed
     */
    public function getratingAverage()
    {
        return $this->ratingAverage;
    }

    /**
     * @param mixed $ratingAverage
     */
    public function setratingAverage($ratingAverage)
    {
        $this->ratingAverage = $ratingAverage;
    }

    /**
     * @return mixed
     */
    public function getpopularity()
    {
        return $this->popularity;
    }

    /**
     * @param mixed $popularity
     */
    public function setpopularity($popularity)
    {
        $this->popularity = $popularity;
    }

    /**
     * @return mixed
     */
    public function getaverageProductPrice()
    {
        return $this->averageProductPrice;
    }

    /**
     * @param mixed $averageProductPrice
     */
    public function setaverageProductPrice($averageProductPrice)
    {
        $this->averageProductPrice = $averageProductPrice;
    }

    /**
     * @return mixed
     */
    public function getdeliveryCosts()
    {
        return $this->deliveryCosts;
    }

    /**
     * @param mixed $deliveryCosts
     */
    public function setdeliveryCosts($deliveryCosts)
    {
        $this->deliveryCosts = $deliveryCosts;
    }

    /**
     * @return mixed
     */
    public function getminimumOrderAmount()
    {
        return $this->minimumOrderAmount;
    }

    /**
     * @param mixed $minimumOrderAmount
     */
    public function setminimumOrderAmount($minimumOrderAmount)
    {
        $this->minimumOrderAmount = $minimumOrderAmount;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param mixed $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updatedTimestamps()
    {
        $dateTimeNow = new DateTime('now');
        $this->setUpdatedAt($dateTimeNow);
        if ($this->getCreatedAt() === null) {
            $this->setCreatedAt($dateTimeNow);
        }
    }

}
