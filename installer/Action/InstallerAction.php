<?php

namespace App\Action\Installer;

use App\Controller\Installer\InstallerController;
use Exception;
use TypeError;

include_once("../installer/Controller/InstallerController.php");

/**
 * Actions for handling the GUI based installation process
 * - not supporting ajax calls in this step, this is not needed,
 * - only production mode is supported in this case,
 *
 * Class InstallerAction
 */
class InstallerAction
{
    const KEY_SUCCESS           = "success";
    const KEY_RESULT_CHECK_DATA = "resultCheckData";

    /**
     * Will return requirements check result
     *
     * @return string
     */
    public static function getRequirementsCheckResult(): string
    {
        $isSuccess               = true;
        $requirementsCheckResult = [];

        try{
            $requirementsCheckResult = InstallerController::checkProductionBasedRequirements();
        }catch(Exception | TypeError $e){
            $isSuccess = false;
        }

        return json_encode([
            self::KEY_RESULT_CHECK_DATA => $requirementsCheckResult,
            self::KEY_SUCCESS           => $isSuccess,
        ]);
    }

}