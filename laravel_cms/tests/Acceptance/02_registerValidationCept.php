<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('validate data entered during registration');

$I->amOnPage('/register');

$I->seeCurrentUrlEquals('/register');

$I->amGoingTo('check if any field can be left blank');

$I->click('#register');
$I->dontSee('You are logged in!');

$I->fillField('first_name', 'john');
$I->click('#register');
$I->dontSee('You are logged in!');

$I->fillField('last_name', 'doe');
$I->click('#register');
$I->dontSee('You are logged in!');

$I->fillField('nick', 'johny');
$I->click('#register');
$I->dontSee('You are logged in!');

$I->fillField('page_name', 'john_doe');
$I->click('#register');
$I->dontSee('You are logged in!');

$I->fillField('email', 'john.doe@gmail.com');
$I->click('#register');
$I->dontSee('You are logged in!');

$I->fillField('password', '1234');
$I->click('#register');
$I->dontSee('You are logged in!');

$I->amGoingTo("check validation error about email and password");

$I->fillField('password_confirmation', '12345678');
$I->click('#register');
$I->dontSee('You are logged in!');
$I->see('The email has already been taken.');
$I->see('The password must be at least 8 characters.');

$I->fillField('email', 'john.doe2@gmail.com');
$I->fillField('password', '123456789');
$I->fillField('password_confirmation', '12345678');
$I->click('#register');
$I->dontSee('You are logged in!');
$I->see('The password confirmation does not match.');

$I->fillField('email', 'john.doe2.com');
$I->fillField('password', '12345678');
$I->fillField('password_confirmation', '12345678');
$I->click('#register');
$I->dontSee('You are logged in!');
