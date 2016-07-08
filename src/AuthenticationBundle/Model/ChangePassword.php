<?php

namespace AuthenticationBundle\Model;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\SerializedName;

class ChangePassword {

    public static $__CLASS__ = __CLASS__;

    /**
     *
     * @var string
     * @Type("string")
     * @SerializedName("currentPassword")
     */
    private $currentPassword;

    /**
     *
     * @var string
     * @Type("string")
     * @SerializedName("newPassword")
     */
    private $newPassword;

    /**
     *
     * @var string
     * @Type("string")
     * @SerializedName("newPasswordConfirm")
     */
    private $newPasswordConfirm;

    public function getCurrentPassword() {
        return $this->currentPassword;
    }

    public function getNewPassword() {
        return $this->newPassword;
    }

    public function getNewPasswordConfirm() {
        return $this->newPasswordConfirm;
    }

    public function setCurrentPassword($currentPassword) {
        $this->currentPassword = $currentPassword;
    }

    public function setNewPassword($newPassword) {
        $this->newPassword = $newPassword;
    }

    public function setNewPasswordConfirm($newPasswordConfirm) {
        $this->newPasswordConfirm = $newPasswordConfirm;
    }

    public static function createFromParams($params) {
        $changePassword = new ChangePassword();
        if (!isset($params['currentPassword'])) {
            throw new \Exception('Current password field is empty');
        }
        if (!isset($params['password']['first'])) {
            throw new \Exception('New password field is empty');
        }
        if (!isset($params['password']['second'])) {
            throw new \Exception('New password confirm field is empty');
        }
        $changePassword->setCurrentPassword($params['currentPassword']);
        $changePassword->setNewPassword($params['password']['first']);
        $changePassword->setNewPasswordConfirm($params['password']['second']);
        return $changePassword;
    }

}
