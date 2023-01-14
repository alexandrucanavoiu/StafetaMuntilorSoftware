  <!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Lista Cluburi in functie de echipe</title>

<style type="text/css">
    * {
        font-family: Verdana, Arial, sans-serif;
    }
    table{
        font-size: x-small;
    }
    tfoot tr td{
        font-weight: bold;
        font-size: x-small;
    }
    .gray {
        background-color: lightgray
    }
    .text-center { text-align: center; }

    footer { position: fixed; bottom: -60px; left: 0px; right: 0px; height: 50px; font-size: x-small;}

</style>

</head>
<body>

  <table width="100%">
    <tr>
        <td valign="right" class="text-center"><img src="logo.png" alt="" width="150"/></td>
        <td class="text-center">
            <h1>Lista Echipe</h1>
            <div>{{ \App\Helpers\Navigation::trophy_details()->name_stage }}</div>
            <div>Organizator {{ \App\Helpers\Navigation::trophy_details()->name_organizer }}</div>
        </td>
        <td valign="right" class="text-center"><img src="logo.png" alt="" width="150"/></td>
    </tr>

  </table>

  <br/>

  <table width="100%">
    <thead style="background-color: lightgray;">
      <tr>
        <th width="10%" class="text-center">Nr. P</th>
        <th width="10%" class="text-center">Nr. O</th>
        <th width="10%" class="text-center">Nr. R</th>
        <th width="30%">Nume Club</th>
        <th width="30%">Nume Echipa</th>
        <th width="10%">Categorie</th>
      </tr>
    </thead>
    <tbody>

        @foreach($teams_list as $team)
        <tr>
            <td class="text-center">{{ $team['number'] }}</td>
            <td>{{ $team['uuid_orienteering_id'] }} - {{ $team['uuid_orienteering_name'] }}</td>
            <td>{{ $team['uuid_raid_id'] }} - {{ $team['uuid_raid_name'] }}</td>
            <td>{{ $team['club'] }}</td>
            <td>{{ $team['name'] }}</td>
            <td class="text-center">{{ $team['category'] }}</td>
        </tr>
        @endforeach

    </tbody>
  </table>
  <footer>{{ \App\Helpers\Navigation::trophy_details()->software }}</footer>
</body>
</html>