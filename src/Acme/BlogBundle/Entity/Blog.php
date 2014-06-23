<?php
namespace Acme\BlogBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

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
}
