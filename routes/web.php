<?php
/**
 * start route
 */
Route::match(['get','post'],'/',"UsernameController@search");
