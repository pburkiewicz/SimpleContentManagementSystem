<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('login with existing user');

$I->amOnPage('/home');

$I->seeCurrentUrlEquals('/login');
