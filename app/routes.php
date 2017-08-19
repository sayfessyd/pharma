<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'HomeController@showHome');
Route::get('medicaments', 'HomeController@showMedicaments');
Route::get('familles', 'HomeController@showFamilles');
Route::get('notes', 'HomeController@showNotes');
Route::get('commandes', 'HomeController@showCommandes');
Route::get('medicaments/famille/{id}', 'HomeController@showMedparfam');
Route::get('test', 'HomeController@test');
Route::get('stat/{year}', 'HomeController@stat');

Route::get('ajouter/famille', 'FamilleController@ajouter');
Route::get('modifier/famille/{id}', 'FamilleController@modifier');
Route::post('editer/famille', 'FamilleController@editer');
Route::get('supprimer/famille/{id}', 'FamilleController@supprimer');
Route::post('supprimer/famille', 'FamilleController@supprimer');

Route::get('ajouter/medicament', 'MedicamentController@ajouter');
Route::get('modifier/medicament/{id}', 'MedicamentController@modifier');
Route::post('editer/medicament', 'MedicamentController@editer');
Route::get('supprimer/medicament/{id}', 'MedicamentController@supprimer');
Route::post('supprimer/medicament', 'MedicamentController@supprimer');

Route::get('ajouter/note', 'NoteController@ajouter');
Route::get('modifier/note/{id}', 'NoteController@modifier');
Route::post('editer/note', 'NoteController@editer');
Route::get('supprimer/note/{id}', 'NoteController@supprimer');
Route::post('supprimer/note', 'NoteController@supprimer');

Route::get('ajouter/commande', 'CommandeController@ajouter');
Route::get('modifier/commande/{id}', 'CommandeController@modifier');
Route::post('editer/commande', 'CommandeController@editer');
Route::get('supprimer/commande/{id}', 'CommandeController@supprimer');
Route::post('supprimer/commande', 'CommandeController@supprimer');




