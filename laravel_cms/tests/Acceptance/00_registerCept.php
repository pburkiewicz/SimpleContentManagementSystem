<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('register new user');

$I->amOnPage('/register');

$I->seeCurrentUrlEquals('/register');

$I->fillField('first_name', 'john');
$I->fillField('last_name', 'doe');
$I->fillField('nick', 'johny');
$I->fillField('page_name', 'john_doe');
$I->fillField('email', 'john.doe@gmail.com');
$I->fillField('password', '12345678');
$I->fillField('password_confirmation', '12345678');

$I->click('#register');

$I->seeCurrentUrlEquals('/john_doe');

$I->see('You are logged in!', 'div.card-body');
$I->seeLink('Manage your website');
$I->seeLink('Create a page.');
