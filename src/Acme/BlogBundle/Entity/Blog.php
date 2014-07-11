<?php
namespace Acme\BlogBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

use Acme\SecurityBundle\Entity\User;

/**
 * @ORM\Entity
 * @ORM\Table(name="blog_posts")
 */
class Blog
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $postTitle;

    /**
     * @ORM\Column(type="text")
     */
    private $postDesc;

    /**
     * @ORM\Column(type="text")
     */
    private $postCont;

    /**
     * @ORM\Column(type="datetime")
     */
    private $postDate;

    /**
     * @ORM\ManyToOne(targetEntity="BUser", inversedBy="blogs")
     * @ORM\JoinColumn(name="buser_id", referencedColumnName="id")
     **/
    private $buser;

    /**
     * @ORM\OneToMany(targetEntity="BlogComment", mappedBy="blog")
     **/
    private $comments;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set postTitle
     *
     * @param string $postTitle
     * @return BLOG_POSTS
     */
    public function setPostTitle($postTitle)
    {
        $this->postTitle = $postTitle;

        return $this;
    }

    /**
     * Get postTitle
     *
     * @return string 
     */
    public function getPostTitle()
    {
        return $this->postTitle;
    }

    /**
     * Set postDesc
     *
     * @param string $postDesc
     * @return BLOG_POSTS
     */
    public function setPostDesc($postDesc)
    {
        $this->postDesc = $postDesc;

        return $this;
    }

    /**
     * Get postDesc
     *
     * @return string 
     */
    public function getPostDesc()
    {
        return $this->postDesc;
    }

    /**
     * Set postCont
     *
     * @param string $postCont
     * @return BLOG_POSTS
     */
    public function setPostCont($postCont)
    {
        $this->postCont = $postCont;

        return $this;
    }

    /**
     * Get postCont
     *
     * @return string 
     */
    public function getPostCont()
    {
        return $this->postCont;
    }

    /**
     * Set postDate
     *
     * @param \DateTime $postDate
     * @return BLOG_POSTS
     */
    public function setPostDate($postDate)
    {
        $this->postDate = $postDate;

        return $this;
    }

    /**
     * Get postDate
     *
     * @return \DateTime 
     */
    public function getPostDate()
    {
        return $this->postDate;
    }


    /**
     * Set buser
     *
     * @param \Acme\BlogBundle\Entity\BUser $buser
     * @return Blog
     */
    public function setBuser(\Acme\BlogBundle\Entity\BUser $buser = null)
    {
        $this->buser = $buser;

        return $this;
    }

    /**
     * Get buser
     *
     * @return \Acme\BlogBundle\Entity\BUser 
     */
    public function getBuser()
    {
        return $this->buser;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add comments
     *
     * @param \Acme\BlogBundle\Entity\BlogComment $comments
     * @return Blog
     */
    public function addComment(\Acme\BlogBundle\Entity\BlogComment $comments)
    {
        $this->comments[] = $comments;

        return $this;
    }

    /**
     * Remove comments
     *
     * @param \Acme\BlogBundle\Entity\BlogComment $comments
     */
    public function removeComment(\Acme\BlogBundle\Entity\BlogComment $comments)
    {
        $this->comments->removeElement($comments);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComments()
    {
        return $this->comments;
    }
}
