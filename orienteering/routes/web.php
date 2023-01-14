<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'OrienteeringController@index' );
Route::get('/configure', 'OrienteeringController@configure' );
Route::post('/configure', 'OrienteeringController@configure_store' );
//Route::get('/import-trail-cross', 'CrossTrailController@index' );
//Route::post('/import-trail-cross/xls', 'CrossTrailController@importuuidcardtrail');

Route::get('/order-start', 'TeamController@index' );
Route::get('/order-start/pdf', 'TeamController@pdf' );
Route::get('/order-start/edit', 'TeamController@order_start' );
Route::post('/order-start/edit', 'TeamController@order_start_post' );

Route::get('/import-orienteering', 'OrienteeringController@index' );
Route::post('/import-orienteering/xls', 'OrienteeringController@importuuidcardorienteering' );

Route::get('/import-orienteering/seed', 'OrienteeringController@seed' );
Route::post('/import-orienteering/seed/insert', 'OrienteeringController@seedorienteering' );


//Route::post('/import-orienteering/xls', 'OrienteeringController@importuuidcardorienteering');

//Route::get('/', 'dashboardController@dashboard' );

//Route::get('/uuid-cards', 'uuidcardsController@index' );
//Route::post('/uuid-cards/trucate', 'uuidcardsController@trucate' );
//Route::get('/uuid-cards/remove/{id}', 'uuidcardsController@remove');
//Route::get('/uuid-cards/importExport', 'uuidcardsController@importExport');
//Route::get('/uuid-cards/downloadExcel/{type}', 'uuidcardsController@downloadExcel');
//Route::post('/uuid-cards/importExcel', 'uuidcardsController@importExcel');
//Route::get('/uuid-cards/drop', 'uuidcardsController@drop');
////Route::post('/uuid-cards/importExcel', 'uuidcardsController@validateImportFile');
//
//Route::get('/stages', 'stagesController@index');
//Route::post('/stages/create', 'stagesController@create');
//Route::get('/stages/remove/{id}', 'stagesController@remove');
//Route::get('/stages/truncate', 'stagesController@truncate');
//Route::get('/stages/edit/{id}', 'stagesController@edit');
//Route::put('/stages/update/{id}', 'stagesController@update');
//
//Route::get('/categories', 'categoriesController@index');
//Route::post('/categories/create', 'categoriesController@create');
//Route::get('/categories/remove/{id}', 'categoriesController@remove');
//Route::post('/categories/truncate', 'categoriesController@truncate');
//Route::get('/categories/edit/{id}', 'categoriesController@edit');
//Route::put('/categories/update/{id}', 'categoriesController@update');
//
//
//Route::get('/routes', 'routesController@index');
//Route::get('/routes/add', 'routesController@viewcreate');
//Route::post('/routes/create', 'routesController@create');
//Route::get('/routes/remove/{id}', 'routesController@remove');
//Route::post('/routes/truncate', 'routesController@truncate');
//Route::get('/routes/edit/{id}', 'routesController@edit');
//Route::put('/routes/update/{id}', 'routesController@update');
//
//Route::get('/clubs', 'clubsController@index');
//Route::post('/clubs/create', 'clubsController@create');
//Route::get('/clubs/remove/{id}', 'clubsController@remove');
//Route::get('/clubs/truncate', 'clubsController@truncate');
//Route::get('/clubs/edit/{id}', 'clubsController@edit');
//Route::put('/clubs/update/{id}', 'clubsController@update');
//
//Route::resource('participants', 'ParticipantsController', ['except' => 'show']);
//Route::get('/participants/{id}/manage', 'ParticipantsController@manage')->name('participants.manage');
//Route::put('/participants/{id}/manage', 'ParticipantsController@updateManage');
//Route::get('/participants/import', 'ParticipantsController@importuuidcards');
//Route::post('/participants/import/xls', 'ParticipantsController@importuuidcardsxls');
//Route::post('/participants/filter', 'ParticipantsController@filter');
//Route::get('/participants/filter/{id_stage}/{id_category}/export/pdf', 'ParticipantsController@filterexportxls');
//
//Route::resource('participants.stages', 'ParticipantStagesController', ['only' => ['index', 'store', 'destroy']]);
//
//Route::resource('rankings', 'rankingsController', ['except' => 'show']);
//Route::get('/rankings/{id}', 'rankingsController@category');
//Route::get('/rankings/{id_stage}/{id_category}', 'rankingsController@rankinglist');
//Route::get('/rankings/{id_stage}/{id_category}/exportPDF', 'rankingsController@pdfgeneratecategory');
//Route::get('/total', 'rankingsController@totalranking');
//Route::get('/total/exportPDF', 'rankingsController@totalrankingexportpdf');