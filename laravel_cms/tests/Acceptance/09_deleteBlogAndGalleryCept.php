<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('delete blog and gallery');

$I->amOnPage('/login');
$I->fillField('email', 'john.doe@gmail.com');
$I->fillField('password', '12345678');
$I->click('#login');
$I->click('Manage your website');

$I->click('#delete_post');
$I->click('#delete_post');

$I->dontSee("tytul_galerii - gallery");
$I->dontSee("tytul_strony - blog");
