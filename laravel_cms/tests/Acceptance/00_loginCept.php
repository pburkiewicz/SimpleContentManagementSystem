<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('register and login');

$I->amOnPage('/register');

$I->seeCurrentUrlEquals('/register');

$I->fillField('first_name', 'john');
$I->fillField('last_name', 'doe');
$I->fillField('nick', 'johny');
$I->fillField('page_name', 'john.doe');
$I->fillField('email', 'john.doe@gmail.com');
$I->fillField('password', '12345678');
$I->fillField('password_confirmation', '12345678');

$I->click('#register');

$I->seeCurrentUrlEquals('/home');

$I->see('You are logged in!', 'div.card-body');
