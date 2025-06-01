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
use App\Http\Controllers\ParticipantsController;

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

Route::get('/participants', [ParticipantsController::class, 'dashboard'])->name('participants.dashboard');
Route::get('/participants/list', [ParticipantsController::class, 'participants_list'])->name('participants.list');
Route::get('/participants/list/datatables', [ParticipantsController::class, 'participants_list_datatables'])->name('participants.list.datatables');
Route::get('/participants/create', [ParticipantsController::class, 'create'])->name('participants.create');
Route::post('/participants/create', [ParticipantsController::class, 'store'])->name('participants.store');
Route::get('/participants/{id}/edit', [ParticipantsController::class, 'edit'])->name('participants.edit');
Route::post('/participants/{id}/edit', [ParticipantsController::class, 'update'])->name('participants.update');
Route::get('/participants/{id}/destroy', [ParticipantsController::class, 'destroy'])->name('participants.destroy');
Route::post('/participants/{id}/destroy', [ParticipantsController::class, 'destroy_confirm'])->name('participants.destroy_confirm');
Route::get('/participants/{stageid}/list', [ParticipantsController::class, 'participants_stages_list'])->name('participants.stages.list');
Route::get('/participants/{stageid}/list/datatables', [ParticipantsController::class, 'participants_stages_list_datatables'])->name('participants.stages.list.datatables');
Route::get('/participants/{stageid}/{id}/edit', [ParticipantsController::class, 'participants_stages_list_edit'])->name('participants.stages.edit');
Route::post('/participants/{stageid}/{id}/edit', [ParticipantsController::class, 'participants_stages_list_update'])->name('participants.stages.update');
Route::get('/participants/{stageid}/{id}/destroy', [ParticipantsController::class, 'participants_stages_list_destroy'])->name('participants.stages.destroy');
Route::post('/participants/{stageid}/{id}/destroy', [ParticipantsController::class, 'participants_stages_list_destroy_confirm'])->name('participants.stages.destroy.confirm');
Route::get('/participants/rankingcumulatclubs', [ParticipantsController::class, 'participants_rankingcumulatclubs'])->name('participants.rankingcumulatclubs');
Route::get('/participants/rankingcumulatclubs/pdf', [ParticipantsController::class, 'participants_rankingcumulatclubs_pdf'])->name('participants.rankingcumulatclubs.pdf');
Route::get('/participants/rankingcumulatparticipants', [ParticipantsController::class, 'participants_rankingcumulatparticipants'])->name('participants.rankingcumulatparticipants');
Route::get('/participants/rankingcumulatparticipants/pdf', [ParticipantsController::class, 'participants_rankingcumulatparticipants_pdf'])->name('participants.rankingcumulatparticipants.pdf');

Route::get('/', [DashboardController::class, 'stages'])->name('stages');
Route::get('/switch/{stageid}', [DashboardController::class, 'switch_change'])->name('switch_change');
Route::get('/{stageid}', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/{stageid}/changelog', [DashboardController::class, 'changelog'])->name('changelog');
Route::get('/errors', [DashboardController::class, 'index'])->name('error.alert');
Route::get('/{stageid}/terms', [DashboardController::class, 'terms'])->name('terms');
Route::get('/{stageid}/setup', [SetupController::class, 'index'])->name('setup.index');
Route::get('/{stageid}/setup/trophy', [SetupController::class, 'trophy_setup'])->name('setup.trophy');
Route::post('/{stageid}/setup/trophy', [SetupController::class, 'trophy_setup_update'])->name('setup.trophy.update');
Route::get('/{stageid}/setup/order-start', [SetupController::class, 'team_order_start'])->name('setup.team.order.start');
Route::post('/{stageid}/setup/order-start', [SetupController::class, 'team_order_start_update'])->name('setup.team.order.start.update');
Route::get('/{stageid}/setup/raid-montan/{categoryid}/edit', [SetupController::class, 'raid_montan_setup'])->name('setup.raid.montan.setup');
Route::post('/{stageid}/setup/raid-montan/{categoryid}/edit', [SetupController::class, 'raid_montan_setup_update'])->name('setup.raid.montan.setup.update');
Route::get('/{stageid}/setup/raid-montan/stages/{categoryid}/edit', [SetupController::class, 'raid_montan_setup_stages'])->name('setup.raid.montan.setup.stages');
Route::post('/{stageid}/setup/raid-montan/stages/{categoryid}/edit', [SetupController::class, 'raid_montan_setup_stages_update'])->name('setup.raid.montan.setup.stages.update');
Route::get('/{stageid}/setup/orienteering/stages/{categoryid}/edit', [SetupController::class, 'orienteering_setup_stages'])->name('setup.orienteering.setup.stages');
Route::post('/{stageid}/setup/orienteering/stages/{categoryid}/edit', [SetupController::class, 'orienteering_setup_stages_update'])->name('setup.orienteering.setup.stages.update');
Route::post('/{stageid}/setup/destroy', [SetupController::class, 'destroy'])->name('setup.destroy');
Route::get('/{stageid}/setup/export-raid', [SetupController::class, 'convert_raid_to_ultra'])->name('setup.raidmontan.export');
Route::get('/{stageid}/setup/export-orienteering', [SetupController::class, 'convert_orienteering_to_ultra'])->name('setup.orienteering.export');
Route::get('/{stageid}/setup/convert-timestamp-datetime', [SetupController::class, 'convert_timestamp_datetime'])->name('setup.convert.timestamp-datetime');
Route::post('/{stageid}/setup/convert-timestamp-datetime', [SetupController::class, 'convert_timestamp_datetime_confirm'])->name('setup.convert.timestamp-datetime.confirm');
Route::get('/{stageid}/setup/convert-datetime-timestamp', [SetupController::class, 'convert_datetime_timestamp'])->name('setup.convert.datetime-timestamp');
Route::post('/{stageid}/setup/convert-datetime-timestamp', [SetupController::class, 'convert_datetime_timestamp_confirm'])->name('setup.convert.datetime-timestamp.confirm');
Route::get('/{stageid}/export-db', [SetupController::class, 'export_db'])->name('setup.export.db');

Route::get('/{stageid}/import', [ImportController::class, 'index'])->name('import.index');
Route::post('/{stageid}/import/check_teams_chipno', [ImportController::class, 'teams_chipno_and_team_name_check'])->name('import.teams_chipno_and_team_name_check');
Route::post('/{stageid}/import/raidmontan-seed', [ImportController::class, 'raidmontan_seed'])->name('import.raidmontan_seed');
Route::post('/{stageid}/import/orienteering-seed', [ImportController::class, 'orienteering_seed'])->name('import.orienteering_seed');
Route::post('/{stageid}/import/raidmontan', [ImportController::class, 'raidmontan_import_sportident'])->name('import.raidmontan_import_uuids');
Route::post('/{stageid}/import/orienteering', [ImportController::class, 'orienteering_import_uuids'])->name('import.orienteering_import_uuids');


Route::get('/{stageid}/clubs', [ClubsController::class, 'index'])->name('clubs.index');
Route::get('/{stageid}/clubs/create', [ClubsController::class, 'create'])->name('clubs.create');
Route::post('/{stageid}/clubs/create', [ClubsController::class, 'store'])->name('clubs.store');
Route::get('/{stageid}/clubs/{id}/edit', [ClubsController::class, 'edit'])->name('clubs.edit');
Route::post('/{stageid}/clubs/{id}/edit', [ClubsController::class, 'update'])->name('clubs.update');
Route::get('/{stageid}/clubs/{id}/destroy', [ClubsController::class, 'destroy'])->name('clubs.destroy');
Route::post('/{stageid}/clubs/{id}/destroy', [ClubsController::class, 'destroy_confirm'])->name('clubs.destroy.confirm');
Route::get('/{stageid}/clubs/listbyteams', [ClubsController::class, 'clubs_listbyteams'])->name('clubs.clubs.listbyteams');
Route::get('/{stageid}/clubs/listbyteams/pdf', [ClubsController::class, 'clubs_listbyteams_pdf'])->name('clubs.clubs.listbyteams_pdf');

Route::get('/{stageid}/teams', [TeamsController::class, 'index'])->name('teams.index');
Route::get('/{stageid}/teams/create', [TeamsController::class, 'create'])->name('teams.create');
Route::post('/{stageid}/teams/create', [TeamsController::class, 'store'])->name('teams.store');
Route::get('/{stageid}/teams/{id}/edit', [TeamsController::class, 'edit'])->name('teams.edit');
Route::post('/{stageid}/teams/{id}/edit', [TeamsController::class, 'update'])->name('teams.update');
Route::get('/{stageid}/teams/{id}/destroy', [TeamsController::class, 'destroy'])->name('teams.destroy');
Route::post('/{stageid}/teams/{id}/destroy', [TeamsController::class, 'destroy_confirm'])->name('teams.destroy.confirm');
Route::get('/{stageid}/teams/pdf', [TeamsController::class, 'teams_listbyteams_pdf'])->name('teams.listbyteams_pdf');
Route::get('/{stageid}/teams/order-start', [TeamsController::class, 'index_team_order_start'])->name('teams.order.start');
Route::get('/{stageid}/teams/order-start/pdf', [TeamsController::class, 'index_team_order_start_pdf'])->name('teams.order.start.pdf');

Route::get('/{stageid}/cultural', [CulturalController::class, 'index'])->name('cultural.index');
Route::get('/{stageid}/cultural/rank-pdf', [CulturalController::class, 'cultural_rank_pdf'])->name('cultural.rank.pdf');
Route::get('/{stageid}/cultural/{id}/edit', [CulturalController::class, 'edit'])->name('cultural.edit');
Route::post('/{stageid}/cultural/{id}/edit', [CulturalController::class, 'update'])->name('cultural.update');


Route::get('/{stageid}/knowledge/{id}', [KnowledgeController::class, 'index'])->name('knowledge.index');
Route::get('/{stageid}/knowledge/{categoryid}/{teamid}/edit', [KnowledgeController::class, 'edit'])->name('knowledge.edit');
Route::post('/{stageid}/knowledge/{categoryid}/{teamid}/edit', [KnowledgeController::class, 'update'])->name('knowledge.update');

Route::get('/{stageid}/orienteering/{id}', [OrienteeringController::class, 'index'])->name('orienteering.index');
Route::get('/{stageid}/orienteering/{categoryid}/{teamid}/edit', [OrienteeringController::class, 'edit'])->name('orienteering.edit');
Route::post('/{stageid}/orienteering/{categoryid}/{teamid}/edit', [OrienteeringController::class, 'update'])->name('orienteering.update');

Route::get('/{stageid}/raidmontan/{id}', [RaidMontanController::class, 'index'])->name('raidmontan.index');
Route::get('/{stageid}/raidmontan/{categoryid}/{teamid}/edit', [RaidMontanController::class, 'edit'])->name('raidmontan.edit');
Route::post('/{stageid}/raidmontan/{categoryid}/{teamid}/edit', [RaidMontanController::class, 'update'])->name('raidmontan.update');

Route::get('/{stageid}/rankings', [RankingsController::class, 'index'])->name('rankings.index');
Route::get('/{stageid}/rankings/general', [RankingsController::class, 'ranking_cumulat'])->name('rankings.general');
Route::get('/{stageid}/rankings/general/pdf', [RankingsController::class, 'ranking_cumulat_pdf'])->name('rankings.general_pdf');

Route::get('/{stageid}/rankings/{category_id}', [RankingsController::class, 'index_category'])->name('rankings.index_category');

Route::get('/{stageid}/rankings/{category_id}/knowledge', [RankingsController::class, 'ranking_knowledge'])->name('rankings.category.knowledge');
Route::get('/{stageid}/rankings/{category_id}/knowledge/pdf', [RankingsController::class, 'ranking_knowledge_pdf'])->name('rankings.category.knowledge.pdf');
Route::get('/{stageid}/rankings/{category_id}/orienteering', [RankingsController::class, 'ranking_orienteering'])->name('rankings.category.orienteering');
Route::get('/{stageid}/rankings/{category_id}/orienteering/pdf', [RankingsController::class, 'ranking_orienteering_pdf'])->name('rankings.category.orienteering.pdf');
Route::get('/{stageid}/rankings/{category_id}/raidmontan', [RankingsController::class, 'ranking_raidmontan'])->name('rankings.category.raidmontan');
Route::get('/{stageid}/rankings/{category_id}/raidmontan/pdf', [RankingsController::class, 'ranking_raidmontan_pdf'])->name('rankings.category.raidmontan.pdf');

Route::get('/{stageid}/rankings/{category_id}/generalcategory', [RankingsController::class, 'ranking_category'])->name('rankings.category.general');
Route::get('/{stageid}/rankings/{category_id}/generalcategory/pdf', [RankingsController::class, 'ranking_category_pdf'])->name('rankings.category.general_pdf');


