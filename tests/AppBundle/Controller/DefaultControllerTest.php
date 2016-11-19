<?php

namespace Tests\AppBundle\Controller;

class DefaultControllerTest extends AbstractControllerTest
{
    protected $locale = 'en';

    /**
     * @dataProvider urlProvider
     */
    public function testPageIsSuccessful($url)
    {
        $this->client->followRedirects();
        $this->client->request('GET', $url);
        $this->assertTrue($this->client->getResponse()->isSuccessful(), $url);
    }

    public function urlProvider()
    {
        return array(
            array('/'),

            array('/'.$this->locale.'/dashboard'),
            array('/'.$this->locale.'/profile'),
            array('/'.$this->locale.'/profile/edit'),
            array('/'.$this->locale.'/user'),
            array('/'.$this->locale.'/logout'),
            array('/'.$this->locale.'/login'),
            array('/'.$this->locale.'/register'),
            // ...
        );

    }
}
