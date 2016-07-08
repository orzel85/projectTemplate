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
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use FOS\UserBundle\Model\UserInterface;
use AuthenticationBundle\Form\Type\ChangePasswordFormType;
use AuthenticationBundle\Model\ChangePassword as ChangePasswordModel;

class ChangePasswordController extends FOSRestController implements ClassResourceInterface
{
    /**
     * * @REST\RequestParam(name="currentPassword",  strict=true, nullable=false)
     * @REST\RequestParam(name="newPassword", nullable=false)
     * @REST\RequestParam(name="newPasswordConfirmation",  nullable=false)
     */
    
//    public function changePasswordAction(\Symfony\Component\HttpFoundation\Request $requestA)
    /**
     * @ApiDoc(
     *      description="",
     *      section="ChangePasswordController",
     *      input="AuthenticationBundle\Form\Type\ChangePasswordFormType"
     * )
     * 
     * @Post("/changePassword")
     * 
     * @REST\RequestParam(
     *      name="change_password",
     *      array=true,
     *      description="Change password model."
     * )
     * 
     * @Security(expression="has_role('ROLE_USER')")
     * 
     */
    public function changePasswordAction(ParamFetcherInterface $paramFetcher)
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        $params = $paramFetcher->get('change_password');
        try{
            $changePasswordModel = ChangePasswordModel::createFromParams($params);
        }catch(\Exception $e) {
            return new ErrorResponse(1,array($e->getMessage()));
        }
        $form = $this->createForm(new ChangePasswordFormType(), $changePasswordModel);
        $form->submit($params);
        if ($form->isValid()) {
            $user = $this->container->get('security.context')->getToken()->getUser();
            $userManager = $this->get('fos_user.user_manager');
            $user->setPlainPassword($params['password']['first']);
            $userManager->updateUser($user);
            return new SuccessResponse(array('ok'));
        }else{
            return new ErrorResponse(1,array($form->getErrors()));
        }

    }
}
