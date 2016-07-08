<?php

namespace AuthenticationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations as REST;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Request\ParamFetcherInterface;
use AppBundle\Model\Response\ErrorResponse;
use AppBundle\Model\Response\SuccessResponse;
use AuthenticationBundle\Model\User as UserModel;
use AuthenticationBundle\Validators\Constraints as AuthenticationConstraints;

class ProfileController extends FOSRestController implements ClassResourceInterface
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('AuthenticationBundle:Default:index.html.twig');
    }
    
    /**
     * @ApiDoc(
     *      description="",
     *      section="DefaultController"
     * )
     * 
     * @Post("/register")
     * 
     * @REST\RequestParam(name="username", requirements=@AuthenticationConstraints\DuplicateUser, strict=true, nullable=false)
     * @REST\RequestParam(name="password", nullable=false)
     * @REST\RequestParam(name="email", requirements=@AuthenticationConstraints\DuplicateEmail, nullable=false)
     */
    public function registerAction(ParamFetcherInterface $paramFetcher)
    {
        $params = $paramFetcher->all();
        $userManager = $this->get('fos_user.user_manager');
        $username = $params['username'];
        /* @var $user \AuthenticationBundle\Entity\User */
        $user = $userManager->createUser();
        $user->setUsername($username);
        $user->setPlainPassword($params['password']);
        $user->setEmail($params['email']);
        $user->setEnabled(true);
        $creationDate = new \DateTime();
        $user->setCreationDate($creationDate);
        $userManager->updateUser($user);
        $userModel = UserModel::createFromEntity($user);
        return new SuccessResponse($userModel);
    }
    
    /**
     * @ApiDoc(
     *      description="List of torrents from one vendor",
     *      section="DefaultController"
     * )
     * 
     * @Get("/profile")
     * 
     * @Security(expression="has_role('ROLE_USER')")
     * 
     */
    public function profileAction(ParamFetcherInterface $paramFetcher)
    {
        $userEntity = $this->getUser();
        $user = UserModel::createFromEntity($userEntity);
        return new SuccessResponse(array('user' => $user));
    }
}
