<?php
Class CpanelDDNSTest extends PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        $this->cddns = new CpanelDDNS\CpanelDDNS();
    }
    
    /**
     * Check if can read config file
     **/
    public function testCanReadConfig()
    {
        // Act
        $config =  $cddns->fetchConfig();

        // Assert
        $this->assertEquals("moo", $config['domain']);
    }

    /**
     * Test ACL mode defaults to to single ip
     */
    public function testInACLEnabledSingle()
    {
        $cddns->defaultAclMode();

        $aclMode =  $cddns->getAclMode();

        $this->assertEquals('single', $aclMode);
    }

    /**
     * Test if able to set ACL mode to single ip
     */
    public function testInACLEnabledSingle()
    {
        $cddns->defaultAclMode();

        $cddns->setAclMode('single');

        $aclMode =  $cddns->getAclMode();

        $this->assertEquals('single', $aclMode);
    }

    /**
     * @depends testACLEnabledSingle
     */
    public function testInACLSingleIpValid()
    {
        // Act
        $config =  $cddns->checkIpAcl(192.168.5.1);

        // Assert
        $this->assertEquals("moo", $config['domain']);
    }

    
    /**
     * @depends testACLEnabledSingle
     */
    public function testInACLSingleIpInvalid()
    {
        // Act
        $config =  $cddns->checkIpAcl(192.168.5.0);

        // Assert
        $this->assertEquals("moo", $config['domain']);
    }

    /**
     * Check if can set ACL mode to multipule ips
     **/
    public function testInACLEnabledMulti()
    {
        $cddns->defaultAclMode();

        $cddns->setAclMode('multi');

        $aclMode =  $cddns->getAclMode();

        $this->assertEquals('multi', $aclMode);
    }

    /**
     * Check if can set ACL mode to range of ips
     **/
    public function testInACLEnabledRange()
    {
        $cddns->defaultAclMode();

        $cddns->setAclMode('range');

        $aclMode =  $cddns->getAclMode();

        $this->assertEquals('range', $aclMode);
    }

}
