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
            <h1>Lista Cluburi in functie de echipe</h1>
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
        <th width="10%" class="text-center">Nr. Curent</th>
        <th width="40%">Nume Club</th>
        <th width="10%" class="text-center">Echipe Inscrise</th>
        <th width="10%" class="text-center">Echipe Family</th>
        <th width="10%" class="text-center">Echipe Juniori</th>
        <th width="10%" class="text-center">Echipe Elite</th>
        <th width="10%" class="text-center">Echipe Open</th>
        <th width="10%" class="text-center">Echipe Veterani</th>
        <th width="10%" class="text-center">Echipe Feminin</th>
      </tr>
    </thead>
    <tbody>

        @foreach($club_list as $club)
        <tr>
            <td class="text-center">{{ $number++ }}</td>
            <td>{{ $club['club_name'] }}</td>
            <td class="text-center">{{ $club['total'] }}</td>
            <td class="text-center">{{ $club['Family'] }}</td>
            <td class="text-center">{{ $club['Juniori'] }}</td>
            <td class="text-center">{{ $club['Elite'] }}</td>
            <td class="text-center">{{ $club['Open'] }}</td>
            <td class="text-center">{{ $club['Veterani'] }}</td>
            <td class="text-center">{{ $club['Feminin'] }}</td>
        </tr>
        @endforeach

    </tbody>
  </table>
  <footer>{{ \App\Helpers\Navigation::trophy_details()->software }}</footer>
</body>
</html>