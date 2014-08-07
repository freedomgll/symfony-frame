<?php
namespace Acme\BlogBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="blog_comment")
 */
class BlogComment
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="BUser")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     **/
    private $buser;

    /**
     * @ORM\ManyToOne(targetEntity="Blog", inversedBy="comments")
     * @ORM\JoinColumn(name="blog_id", referencedColumnName="id")
     */
    private $blog;

    /**
     * @ORM\Column(type="text")
     */
    private $comment;

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
     * Set buser
     *
     * @param \Acme\BlogBundle\Entity\BUser $buser
     * @return BlogComment
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
     * Set blog
     *
     * @param \Acme\BlogBundle\Entity\Blog $blog
     * @return BlogComment
     */
    public function setBlog(\Acme\BlogBundle\Entity\Blog $blog = null)
    {
        $this->blog = $blog;

        return $this;
    }

    /**
     * Get blog
     *
     * @return \Acme\BlogBundle\Entity\Blog 
     */
    public function getBlog()
    {
        return $this->blog;
    }

    /**
     * Set comment
     *
     * @param string $comment
     * @return BlogComment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string 
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set postDate
     *
     * @param \DateTime $postDate
     * @return BlogComment
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
