<?php

namespace AuthenticationBundle\Security;

use Symfony\Component\Security\Http\Logout\LogoutSuccessHandlerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class SuccessLogoutHandler implements LogoutSuccessHandlerInterface {
    
    public function onLogoutSuccess(Request $request) {
        return new JsonResponse(array(
            "success" => true,
        ));
    }
    
}