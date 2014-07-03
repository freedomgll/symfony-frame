<?php
/**
 * Created by PhpStorm.
 * User: lgu
 * Date: 14-7-2
 * Time: 上午10:44
 */

namespace Util\CommonBundle\Common;


class PageDomain {

    private $wd;

    private $pn;

    private $title;

    private $isCurrent;

    function __construct($wd, $pn, $title) {
        $this->wd = $wd;
        $this->pn = $pn;
        $this->title = $title;
        $this->isCurrent = false;
    }

    /**
     * @param mixed $isCurrent
     */
    public function setIsCurrent($isCurrent)
    {
        $this->isCurrent = $isCurrent;
    }

    /**
     * @return mixed
     */
    public function getIsCurrent()
    {
        return $this->isCurrent;
    }

    /**
     * @param mixed $pn
     */
    public function setPn($pn)
    {
        $this->pn = $pn;
    }

    /**
     * @return mixed
     */
    public function getPn()
    {
        return $this->pn;
    }

    /**
     * @param mixed $wd
     */
    public function setWd($wd)
    {
        $this->wd = $wd;
    }

    /**
     * @return mixed
     */
    public function getWd()
    {
        return $this->wd;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

} 