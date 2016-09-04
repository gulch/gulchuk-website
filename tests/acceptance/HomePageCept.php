<?php

$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that homepage works');
$I->amOnPage('/');
$I->see('Volodymyr Gulchuk');
