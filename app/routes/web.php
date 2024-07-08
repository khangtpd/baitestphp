<?php
$router = $this->getRouter();

// List work
$router->get('work', 'WorkController@index', 'work.index');
// Add work
$router->get('work/create', 'WorkController@create', 'work.create');
$router->post('work/create', 'WorkController@store', 'work.store');
// Update work
$router->get('work/edit/{id}', 'WorkController@edit', 'work.edit');
$router->patch('work/edit/{id}', 'WorkController@update', 'work.update');
// Delete work
$router->delete('work/{id}', 'WorkController@destroy', 'work.destroy');

