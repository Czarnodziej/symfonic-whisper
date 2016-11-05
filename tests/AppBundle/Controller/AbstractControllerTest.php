<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;

class AbstractControllerTest extends WebTestCase
{
    /**
     * @var \Symfony\Bundle\FrameworkBundle\Client
     */
    protected $client;

    //provided that fixtures were loaded
    protected $username = 'admin';

    public function setUp()
    {
        $this->client = $this->createAuthorizedClient();
    }

    /**
     * @return \Symfony\Bundle\FrameworkBundle\Client
     */
    protected function createAuthorizedClient()
    {
        $client = static::createClient();
        $container = $client->getContainer();

        $session = $container->get('session');
        /** @var $userManager \FOS\UserBundle\Doctrine\UserManager */
        $userManager = $container->get('fos_user.user_manager');
        /** @var $loginManager \FOS\UserBundle\Security\LoginManager */
        $loginManager = $container->get('fos_user.security.login_manager');
        $firewallName = $container->getParameter('fos_user.firewall_name');

        $user = $userManager->findUserBy(array('username' => $this->username));

        $this->assertNotNull($user, 'Fixtures are needed to be loaded');

        $loginManager->logInUser($firewallName, $user);

        // save the login token into the session and put it in a cookie
        $container->get('session')->set(
            '_security_'.$firewallName,
            serialize($container->get('security.token_storage')->getToken())
        );
        $container->get('session')->save();
        $client->getCookieJar()->set(
            new Cookie($session->getName(), $session->getId())
        );

        return $client;
    }

    public function testLoginAction()
    {
        $this->client->request('GET', '/');

        $this->assertEquals(
            200,
            $this->client->getResponse()->getStatusCode(),
            'Unexpected HTTP status code for GET /'
        );
    }

}
