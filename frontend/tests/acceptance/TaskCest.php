<?php
/**
 * Created by PhpStorm.
 * User: Ilmir
 * Date: 09.02.2019
 * Time: 21:13
 */

namespace frontend\tests\acceptance;

use frontend\tests\AcceptanceTester;
use yii\helpers\Url;

class TaskCest
{

    public function checkTask(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/task/one/'));
        $I->see('My Application');

        $I->seeLink('About');
        $I->click('About');
        //$I->wait(2); // wait for page to be opened

        $I->see('This is the About page.');
    }

}