<?php

namespace FastApi\Models;


class FastModel
{
    /**
     * check if the site name is correct
     *
     * @var $site string
     * @return boolean
     **/
    public function checkName($site)
    {
        //do db stuff and return proper results
        //for now is always true
        return sprintf('hello %s from my model', $site);
    }

}
