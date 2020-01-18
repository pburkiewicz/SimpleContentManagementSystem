<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('see error during invalid login');

$I->amOnPage("/login");

$I->seeCurrentUrlEquals('/login');

$I->fillField("email", "foo@bar.com");
$I->fillField("password", "12345678");

$I->click('#login');
$I->see('These credentials do not match our records.');
$I->dontSee('You are logged in!');

$I->fillField("email", 'john.doe@gmail.com');
$I->fillField("password", "foo");

$I->click('#login');
$I->see('These credentials do not match our records.');
$I->dontSee('You are logged in!');
