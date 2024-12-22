<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class SecurityController extends AbstractController
{
    use TargetPathTrait; // To redirect users to their intended destination

    #[Route('/login', name: 'app_login')]
    public function login(
        AuthenticationUtils $authenticationUtils,
        AuthorizationCheckerInterface $authorizationChecker,
        RequestStack $requestStack
    ): Response {
        // If the user is already logged in, redirect based on role
        if ($this->getUser()) {
            if ($authorizationChecker->isGranted('ROLE_ADMIN')) {
                return $this->redirectToRoute('admin_dashboard');
            } elseif ($authorizationChecker->isGranted('ROLE_USER')) {
                return $this->redirectToRoute('user_dashboard'); // Adjust to your routes
            }
        }

        // Get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // Last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        // Save intended destination (optional, useful for redirection post-login)
        $request = $requestStack->getCurrentRequest();
        if ($request && $request->query->get('redirect')) {
            $this->saveTargetPath($requestStack->getSession(), 'main', $request->query->get('redirect'));
        }

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    #[Route('/logout', name: 'app_logout', methods: ['GET'])]
    public function logout(): void
    {
        // Symfony will handle this route automatically
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
