<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace UserBundle\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

use FOS\UserBundle\Controller\SecurityController as BaseController;

class SecurityController extends BaseController
{

    /**
     * Renders the login template with the given parameters. Overwrite this function in
     * an extended controller to provide additional data for the login template.
     *
     * @param array $data
     *
     * @return Response
     */
    protected function renderLogin(array $data)
    {
        if ($this->isGranted('ROLE_USER')) {
            return new RedirectResponse('dashboard');
        }
        return $this->render('FOSUserBundle:Security:login.html.twig', $data);
    }

}
