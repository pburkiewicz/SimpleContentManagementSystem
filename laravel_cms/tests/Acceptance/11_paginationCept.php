<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('check pagination of blog, comments and gallery');

$I->amOnPage('/login');
$I->fillField('email', 'john.doe@gmail.com');
$I->fillField('password', '12345678');
$I->click('#login');
$I->click('Create a page.');

$I->selectOption('page_type',"blog");
$I->fillField('page_name', 'tytul_bloga');
$I->click("Add page");

$I->click("Create new...");
$I->fillField('title', 'tytul a');
$I->fillField('contents', 'tresc');
$I->click("Publish");
$I->amOnPage("/john_doe/tytul_bloga/blog");

$I->click("Create new...");
$I->fillField('title', 'tytul b');
$I->fillField('contents', 'tresc');
$I->click("Publish");
$I->amOnPage("/john_doe/tytul_bloga/blog");

$I->click("Create new...");
$I->fillField('title', 'tytul c');
$I->fillField('contents', 'tresc');
$I->click("Publish");
$I->amOnPage("/john_doe/tytul_bloga/blog");

$I->click("Create new...");
$I->fillField('title', 'tytul d');
$I->fillField('contents', 'tresc');
$I->click("Publish");
$I->amOnPage("/john_doe/tytul_bloga/blog");

$I->click("Create new...");
$I->fillField('title', 'tytul e');
$I->fillField('contents', 'tresc');
$I->click("Publish");
$I->amOnPage("/john_doe/tytul_bloga/blog");

$I->click("Create new...");
$I->fillField('title', 'tytul f');
$I->fillField('contents', 'tresc');
$I->click("Publish");
$I->amOnPage("/john_doe/tytul_bloga/blog");

$I->click("Create new...");
$I->fillField('title', 'tytul g');
$I->fillField('contents', 'tresc');
$I->click("Publish");
$I->amOnPage("/john_doe/tytul_bloga/blog");

$I->click("Create new...");
$I->fillField('title', 'tytul h');
$I->fillField('contents', 'tresc');
$I->click("Publish");
$I->amOnPage("/john_doe/tytul_bloga/blog");

$I->click("Create new...");
$I->fillField('title', 'tytul i');
$I->fillField('contents', 'tresc');
$I->click("Publish");
$I->amOnPage("/john_doe/tytul_bloga/blog");

$I->click("Create new...");
$I->fillField('title', 'tytul j');
$I->fillField('contents', 'tresc');
$I->click("Publish");
$I->amOnPage("/john_doe/tytul_bloga/blog");

$I->click("Create new...");
$I->fillField('title', 'tytul k');
$I->fillField('contents', 'tresc');
$I->click("Publish");
$I->amOnPage("/john_doe/tytul_bloga/blog");

$I->see("tytul k");
$I->see("tytul b");
$I->dontSee("tytul a");
$I->click("2");
$I->dontSee("tytul k");
$I->dontSee("tytul b");
$I->see("tytul a");

$I->amOnPage("/john_doe/tytul_bloga/blog/3");

$I->click(" Add comment");
$I->fillField("#contents","komentarz a");
$I->wait(0.1);
$I->click("Add comment");

$I->click(" Add comment");
$I->fillField("#contents","komentarz b");
$I->wait(0.1);
$I->click("Add comment");

$I->click(" Add comment");
$I->fillField("#contents","komentarz c");
$I->wait(0.1);
$I->click("Add comment");

$I->click(" Add comment");
$I->fillField("#contents","komentarz d");
$I->wait(0.1);
$I->click("Add comment");

$I->click(" Add comment");
$I->fillField("#contents","komentarz e");
$I->click("Add comment");

$I->click(" Add comment");
$I->fillField("#contents","komentarz f");
$I->wait(0.1);
$I->click("Add comment");

$I->click(" Add comment");
$I->fillField("#contents","komentarz g");
$I->wait(0.1);
$I->click("Add comment");

$I->click(" Add comment");
$I->fillField("#contents","komentarz h");
$I->wait(0.1);
$I->click("Add comment");

$I->click(" Add comment");
$I->fillField("#contents","komentarz i");
$I->wait(0.1);
$I->click("Add comment");

$I->click(" Add comment");
$I->fillField("#contents","komentarz j");
$I->wait(0.1);
$I->click("Add comment");

$I->click(" Add comment");
$I->fillField("#contents","komentarz k");
$I->wait(0.1);
$I->click("Add comment");

$I->see("komentarz k");
$I->see("komentarz b");
$I->dontSee("komentarz a");
$I->click("2");
$I->dontSee("komentarz k");
$I->dontSee("komentarz b");
$I->see("komentarz a");

$I->amOnPage("/john_doe");
$I->click('Create a page.');

$I->selectOption('page_type',"gallery");
$I->fillField('page_name', 'tytul_galerii');
$I->click("Add page");

//change path to dzik.jpg 11 times

$I->click("Create new...");
$I->fillField('title', 'tytul a');
$I->fillField('image', '/home/student/php_2019_laravel_cms/laravel_cms/tests/Acceptance/dzik.jpg');
$I->click("Publish");
$I->amOnPage("/john_doe/tytul_galerii/gallery");

$I->click("Create new...");
$I->fillField('title', 'tytul b');
$I->fillField('image', '/home/student/php_2019_laravel_cms/laravel_cms/tests/Acceptance/dzik.jpg');
$I->click("Publish");
$I->amOnPage("/john_doe/tytul_galerii/gallery");

$I->click("Create new...");
$I->fillField('title', 'tytul c');
$I->fillField('image', '/home/student/php_2019_laravel_cms/laravel_cms/tests/Acceptance/dzik.jpg');
$I->click("Publish");
$I->amOnPage("/john_doe/tytul_galerii/gallery");

$I->click("Create new...");
$I->fillField('title', 'tytul d');
$I->fillField('image', '/home/student/php_2019_laravel_cms/laravel_cms/tests/Acceptance/dzik.jpg');
$I->click("Publish");
$I->amOnPage("/john_doe/tytul_galerii/gallery");

$I->click("Create new...");
$I->fillField('title', 'tytul e');
$I->fillField('image', '/home/student/php_2019_laravel_cms/laravel_cms/tests/Acceptance/dzik.jpg');
$I->click("Publish");
$I->amOnPage("/john_doe/tytul_galerii/gallery");

$I->click("Create new...");
$I->fillField('title', 'tytul f');
$I->fillField('image', '/home/student/php_2019_laravel_cms/laravel_cms/tests/Acceptance/dzik.jpg');
$I->click("Publish");
$I->amOnPage("/john_doe/tytul_galerii/gallery");

$I->click("Create new...");
$I->fillField('title', 'tytul g');
$I->fillField('image', '/home/student/php_2019_laravel_cms/laravel_cms/tests/Acceptance/dzik.jpg');
$I->click("Publish");
$I->amOnPage("/john_doe/tytul_galerii/gallery");

$I->click("Create new...");
$I->fillField('title', 'tytul h');
$I->fillField('image', '/home/student/php_2019_laravel_cms/laravel_cms/tests/Acceptance/dzik.jpg');
$I->click("Publish");
$I->amOnPage("/john_doe/tytul_galerii/gallery");

$I->click("Create new...");
$I->fillField('title', 'tytul i');
$I->fillField('image', '/home/student/php_2019_laravel_cms/laravel_cms/tests/Acceptance/dzik.jpg');
$I->click("Publish");
$I->amOnPage("/john_doe/tytul_galerii/gallery");

$I->click("Create new...");
$I->fillField('title', 'tytul j');
$I->fillField('image', '/home/student/php_2019_laravel_cms/laravel_cms/tests/Acceptance/dzik.jpg');
$I->click("Publish");
$I->amOnPage("/john_doe/tytul_galerii/gallery");

$I->click("Create new...");
$I->fillField('title', 'tytul k');
$I->fillField('image', '/home/student/php_2019_laravel_cms/laravel_cms/tests/Acceptance/dzik.jpg');
$I->click("Publish");
$I->amOnPage("/john_doe/tytul_galerii/gallery ");

$I->see("tytul k");
$I->see("tytul b");
$I->dontSee("tytul a");
$I->click("2");
$I->dontSee("tytul k");
$I->dontSee("tytul b");
$I->see("tytul a");
