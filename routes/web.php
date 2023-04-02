<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClubsController;
use App\Http\Controllers\TeamsController;
use App\Http\Controllers\CulturalController;
use App\Http\Controllers\KnowledgeController;
use App\Http\Controllers\OrienteeringController;
use App\Http\Controllers\SetupController;
use App\Http\Controllers\RankingsController;
use App\Http\Controllers\RaidMontanController;
use App\Http\Controllers\ImportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/changelog', [DashboardController::class, 'changelog'])->name('changelog');
Route::get('/terms', [DashboardController::class, 'terms'])->name('terms');
Route::get('/setup', [SetupController::class, 'index'])->name('setup.index');
Route::get('/setup/trophy', [SetupController::class, 'trophy_setup'])->name('setup.trophy');
Route::post('/setup/trophy', [SetupController::class, 'trophy_setup_update'])->name('setup.trophy.update');
Route::get('/setup/order-start', [SetupController::class, 'team_order_start'])->name('setup.team.order.start');
Route::post('/setup/order-start', [SetupController::class, 'team_order_start_update'])->name('setup.team.order.start.update');
Route::get('/setup/raid-montan/{categoryid}/edit', [SetupController::class, 'raid_montan_setup'])->name('setup.raid.montan.setup');
Route::post('/setup/raid-montan/{categoryid}/edit', [SetupController::class, 'raid_montan_setup_update'])->name('setup.raid.montan.setup.update');
Route::get('/setup/raid-montan/stages/{categoryid}/edit', [SetupController::class, 'raid_montan_setup_stages'])->name('setup.raid.montan.setup.stages');
Route::post('/setup/raid-montan/stages/{categoryid}/edit', [SetupController::class, 'raid_montan_setup_stages_update'])->name('setup.raid.montan.setup.stages.update');
Route::get('/setup/orienteering/stages/{categoryid}/edit', [SetupController::class, 'orienteering_setup_stages'])->name('setup.orienteering.setup.stages');
Route::post('/setup/orienteering/stages/{categoryid}/edit', [SetupController::class, 'orienteering_setup_stages_update'])->name('setup.orienteering.setup.stages.update');
Route::post('/setup/destroy', [SetupController::class, 'destroy'])->name('setup.destroy');
Route::get('/setup/export-raid', [SetupController::class, 'convert_raid_to_ultra'])->name('setup.raidmontan.export');
Route::get('/setup/export-orienteering', [SetupController::class, 'convert_orienteering_to_ultra'])->name('setup.orienteering.export');
Route::get('/setup/convert-timestamp-datetime', [SetupController::class, 'convert_timestamp_datetime'])->name('setup.convert.timestamp-datetime');
Route::post('/setup/convert-timestamp-datetime', [SetupController::class, 'convert_timestamp_datetime_confirm'])->name('setup.convert.timestamp-datetime.confirm');
Route::get('/setup/convert-datetime-timestamp', [SetupController::class, 'convert_datetime_timestamp'])->name('setup.convert.datetime-timestamp');
Route::post('/setup/convert-datetime-timestamp', [SetupController::class, 'convert_datetime_timestamp_confirm'])->name('setup.convert.datetime-timestamp.confirm');

Route::get('/import-demo-data-1', [SetupController::class, 'demo_data_1'])->name('demo_data_1');
Route::get('/import-demo-data-2', [SetupController::class, 'demo_data_2'])->name('demo_data_2');


Route::get('/import', [ImportController::class, 'index'])->name('import.index');
Route::post('/import/raidmontan-seed', [ImportController::class, 'raidmontan_seed'])->name('import.raidmontan_seed');
Route::post('/import/orienteering-seed', [ImportController::class, 'orienteering_seed'])->name('import.orienteering_seed');
Route::post('/import/raidmontan', [ImportController::class, 'raidmontan_import_uuids'])->name('import.raidmontan_import_uuids');
Route::post('/import/orienteering', [ImportController::class, 'orienteering_import_uuids'])->name('import.orienteering_import_uuids');


Route::get('/clubs', [ClubsController::class, 'index'])->name('clubs.index');
Route::get('/clubs/create', [ClubsController::class, 'create'])->name('clubs.create');
Route::post('/clubs/create', [ClubsController::class, 'store'])->name('clubs.store');
Route::get('/clubs/{id}/edit', [ClubsController::class, 'edit'])->name('clubs.edit');
Route::post('/clubs/{id}/edit', [ClubsController::class, 'update'])->name('clubs.update');
Route::get('/clubs/{id}/destroy', [ClubsController::class, 'destroy'])->name('clubs.destroy');
Route::post('/clubs/{id}/destroy', [ClubsController::class, 'destroy_confirm'])->name('clubs.destroy.confirm');
Route::get('/clubs/listbyteams', [ClubsController::class, 'clubs_listbyteams'])->name('clubs.clubs.listbyteams');
Route::get('/clubs/listbyteams/pdf', [ClubsController::class, 'clubs_listbyteams_pdf'])->name('clubs.clubs.listbyteams_pdf');

Route::get('/teams', [TeamsController::class, 'index'])->name('teams.index');
Route::get('/teams/create', [TeamsController::class, 'create'])->name('teams.create');
Route::post('/teams/create', [TeamsController::class, 'store'])->name('teams.store');
Route::get('/teams/{id}/edit', [TeamsController::class, 'edit'])->name('teams.edit');
Route::post('/teams/{id}/edit', [TeamsController::class, 'update'])->name('teams.update');
Route::get('/teams/{id}/destroy', [TeamsController::class, 'destroy'])->name('teams.destroy');
Route::post('/teams/{id}/destroy', [TeamsController::class, 'destroy_confirm'])->name('teams.destroy.confirm');
Route::get('/teams/pdf', [TeamsController::class, 'teams_listbyteams_pdf'])->name('teams.listbyteams_pdf');
Route::get('/teams/order-start', [TeamsController::class, 'index_team_order_start'])->name('teams.order.start');
Route::get('/teams/order-start/pdf', [TeamsController::class, 'index_team_order_start_pdf'])->name('teams.order.start.pdf');

Route::get('/cultural', [CulturalController::class, 'index'])->name('cultural.index');
Route::get('/cultural/rank-pdf', [CulturalController::class, 'cultural_rank_pdf'])->name('cultural.rank.pdf');
Route::get('/cultural/{id}/edit', [CulturalController::class, 'edit'])->name('cultural.edit');
Route::post('/cultural/{id}/edit', [CulturalController::class, 'update'])->name('cultural.update');


Route::get('/knowledge/{id}', [KnowledgeController::class, 'index'])->name('knowledge.index');
Route::get('/knowledge/{categoryid}/{teamid}/edit', [KnowledgeController::class, 'edit'])->name('knowledge.edit');
Route::post('/knowledge/{categoryid}/{teamid}/edit', [KnowledgeController::class, 'update'])->name('knowledge.update');

Route::get('/orienteering/{id}', [OrienteeringController::class, 'index'])->name('orienteering.index');
Route::get('/orienteering/{categoryid}/{teamid}/edit', [OrienteeringController::class, 'edit'])->name('orienteering.edit');
Route::post('/orienteering/{categoryid}/{teamid}/edit', [OrienteeringController::class, 'update'])->name('orienteering.update');

Route::get('/raidmontan/{id}', [RaidMontanController::class, 'index'])->name('raidmontan.index');
Route::get('/raidmontan/{categoryid}/{teamid}/edit', [RaidMontanController::class, 'edit'])->name('raidmontan.edit');
Route::post('/raidmontan/{categoryid}/{teamid}/edit', [RaidMontanController::class, 'update'])->name('raidmontan.update');

Route::get('/rankings', [RankingsController::class, 'index'])->name('rankings.index');
Route::get('/rankings/general', [RankingsController::class, 'ranking_cumulat'])->name('rankings.general');
Route::get('/rankings/general/pdf', [RankingsController::class, 'ranking_cumulat_pdf'])->name('rankings.general_pdf');

Route::get('/rankings/{category_id}', [RankingsController::class, 'index_category'])->name('rankings.index_category');

Route::get('/rankings/{category_id}/knowledge', [RankingsController::class, 'ranking_knowledge'])->name('rankings.category.knowledge');
Route::get('/rankings/{category_id}/knowledge/pdf', [RankingsController::class, 'ranking_knowledge_pdf'])->name('rankings.category.knowledge.pdf');
Route::get('/rankings/{category_id}/orienteering', [RankingsController::class, 'ranking_orienteering'])->name('rankings.category.orienteering');
Route::get('/rankings/{category_id}/orienteering/pdf', [RankingsController::class, 'ranking_orienteering_pdf'])->name('rankings.category.orienteering.pdf');
Route::get('/rankings/{category_id}/raidmontan', [RankingsController::class, 'ranking_raidmontan'])->name('rankings.category.raidmontan');
Route::get('/rankings/{category_id}/raidmontan/pdf', [RankingsController::class, 'ranking_raidmontan_pdf'])->name('rankings.category.raidmontan.pdf');

Route::get('/rankings/{category_id}/generalcategory', [RankingsController::class, 'ranking_category'])->name('rankings.category.general');
Route::get('/rankings/{category_id}/generalcategory/pdf', [RankingsController::class, 'ranking_category_pdf'])->name('rankings.category.general_pdf');