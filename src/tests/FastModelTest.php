<?php
namespace FastApi\tests;
require_once 'bootstrap.php';


/**
 * @backupGlobals disabled
 */
class FastModelTest extends \LocalWebTestCase
{
    protected $_site;



    public function setUp()
    {
        $this->app  = $this->getSlimInstance();
        $this->_site = 'ivan';
    }


    public function testCheckName()
    {
        $expectedResult = sprintf('hello %s from my model', $this->_site);
        $response = $this->get('/check_name.json', array('QUERY_STRING' => 'site=ivan'));
        $json = json_decode($response);
        $this->assertFalse($json->error);
        $this->assertSame(
            $expectedResult, 
            $json->result);
    }
}
 
