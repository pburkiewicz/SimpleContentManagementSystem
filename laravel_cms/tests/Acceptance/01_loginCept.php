<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('login with existing user');

$I->amOnPage('/login');

$I->seeCurrentUrlEquals('/login');

$I->fillField('email', 'john.doe@gmail.com');
$I->fillField('password', '12345678');

$I->click('#login');

$I->seeCurrentUrlEquals('/home');

$I->see('You are logged in!', 'div.card-body');
