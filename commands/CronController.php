<?php
/**
 * Created by PhpStorm.
 * User: konstantin
 * Date: 22.2.16
 * Time: 21.48
 */

namespace app\commands;

use app\models\LoginHistory;
use yii\console\Controller;

/**
 * Class CronController
 * @package app\commands
 */
class CronController extends Controller
{
    public function actionClearlogins()
    {
        $deleted = LoginHistory::deleteAll();
        if($deleted)
        {
            echo "Deleted {$deleted} row(s)\n";
            return true;
        }
        else echo "nothing to delete\n";
    }
    public function actionIndex()
    {
        echo "It's cron controller\n";
    }

}