<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('create page and add post');

$I->amOnPage('/login');
$I->fillField('email', 'john.doe@gmail.com');
$I->fillField('password', '12345678');
$I->click('#login');

$I->click('Create a page.');
$I->seeCurrentUrlEquals("/john_doe/pages/create");
$I->selectOption('page_type',"gallery");

$I->click("Add page");
$I->seeCurrentUrlEquals("/john_doe/pages/create");

$I->fillField('page_name', 'spacja spacja');
$I->selectOption('page_type',"gallery");
$I->click("Add page");
$I->see("The page name may only contain letters, numbers, dashes and underscores.");
$I->seeCurrentUrlEquals("/john_doe/pages/create");

$I->fillField('page_name', '*+-%=:;');
$I->selectOption('page_type',"gallery");
$I->click("Add page");
$I->see("The page name may only contain letters, numbers, dashes and underscores.");
$I->seeCurrentUrlEquals("/john_doe/pages/create");

$I->fillField('page_name', '\\/');
$I->selectOption('page_type',"gallery");
$I->click("Add page");
$I->see("The page name may only contain letters, numbers, dashes and underscores.");
$I->seeCurrentUrlEquals("/john_doe/pages/create");

$I->fillField('page_name', "''\"\"");
$I->selectOption('page_type',"gallery");
$I->click("Add page");
$I->see("The page name may only contain letters, numbers, dashes and underscores.");
$I->seeCurrentUrlEquals("/john_doe/pages/create");

$I->fillField('page_name', '?!.,');
$I->selectOption('page_type',"gallery");
$I->click("Add page");
$I->see("The page name may only contain letters, numbers, dashes and underscores.");
$I->seeCurrentUrlEquals("/john_doe/pages/create");

$I->fillField('page_name', '$@');
$I->selectOption('page_type',"gallery");
$I->click("Add page");
$I->see("The page name may only contain letters, numbers, dashes and underscores.");
$I->seeCurrentUrlEquals("/john_doe/pages/create");

$I->fillField('page_name', '(){}[]');
$I->selectOption('page_type',"gallery");
$I->click("Add page");
$I->see("The page name may only contain letters, numbers, dashes and underscores.");
$I->seeCurrentUrlEquals("/john_doe/pages/create");

$I->fillField('page_name', 'tytul_strony');
$I->selectOption('page_type',"gallery");
$I->click("Add page");
$I->see("The page name has already been taken.");
$I->seeCurrentUrlEquals("/john_doe/pages/create");

$I->fillField('page_name', 'john_doe');
$I->selectOption('page_type',"gallery");
$I->click("Add page");
$I->see("The page name has already been taken.");
$I->seeCurrentUrlEquals("/john_doe/pages/create");

$I->fillField('page_name', 'tytul_galerii');
$I->selectOption('page_type',"gallery");
$I->click("Add page");

$I->seeCurrentUrlEquals("/john_doe/tytul_galerii/gallery");
$I->see("No posts.");
$I->click("Create new...");

$I->click("Publish");
$I->seeCurrentUrlEquals("/john_doe/tytul_galerii/gallery/create");

$I->fillField('title', 'tytul_zdj');
$I->click("Publish");
$I->seeCurrentUrlEquals("/john_doe/tytul_galerii/gallery/create");
$I->see("The image field is required.");

//change path to lwy.jpg

$I->fillField('image', '/home/student/php_2019_laravel_cms/laravel_cms/tests/Acceptance/lwy.jpg');
$I->fillField("description",'to jest obrazek przedstawiajacy lwy');
$I->click("Publish");

$I->seeCurrentUrlEquals("/john_doe/tytul_galerii/gallery/2");
$I->see("tytul_zdj");
$I->seeElement("img");
$I->seeInSource('alt="lwy.jpg"');
$I->see('to jest obrazek przedstawiajacy lwy');
$I->seeLink('edit');



