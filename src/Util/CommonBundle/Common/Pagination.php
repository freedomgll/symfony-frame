<?php
/**
 * Created by PhpStorm.
 * User: lgu
 * Date: 14-7-3
 * Time: 上午11:18
 */

namespace Util\CommonBundle\Common;


class Pagination {

    public  function generatePages($totals, $cp, $step, $wd) {
        $pages = array();
        if ($cp > 0) {
            $pages[] = new PageDomain($wd,0,'First');
            $pages[] = new PageDomain($wd,$cp - $step,'Prev');
        }

        for($i = 0, $j = 1; $i< $totals; $i=$i+$step,$j++) {
            $page = new PageDomain($wd,$i,$j);
            if($cp == $i) {
                $page->setIsCurrent(true);
            }
            $pages[] = $page;
        }

        if ($cp + $step < $totals) {
            $pages[] = new PageDomain($wd,$cp + $step,'Next');
            $tmp = $totals % $step == 0 ? $step : $totals % $step ;
            $pages[] = new PageDomain($wd,$totals - $tmp,'Last');
        }

        return $pages;
    }

} 