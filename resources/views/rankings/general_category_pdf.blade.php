  <!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Clasament General - {{ $category->name }}</title>

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
            <h1>Clasament General Categoria {{ $category->name }}</h1>
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
        <td width="5%" class="text-center">Loc</td>
        <td width="30%">Nume Echipa</th>
        <td width="10%" class="text-center">Raid Montan</td>
        <td width="10%" class="text-center">Orientare</td>
        <td width="10%" class="text-center">Cunostinte Turistice</td>
        <td width="10%" class="text-center">Total</td>
        <td width="10%" class="text-center">Punctaj Stafeta Muntilor</td>
      </tr>
    </thead>
    <tbody>
        @foreach($ranking_general as $rank)
        <tr>
            <td class="text-center">{{ $rank['rank'] }}</td>
            <td>{{ $rank['name'] }}</td>
            <td class="text-center">{{ $rank['scor_raidmontan'] }}</td>
            <td class="text-center">{{ $rank['scor_orienteering'] }}</td>
            <td class="text-center">{{ $rank['scor_knowledge'] }}</td>
            <td class="text-center">{{ $rank['scor_total'] }}</td>
            <td class="text-center">{{ $rank['scor_stafeta'] }}</td>
        </tr>
        @endforeach
    </tbody>
  </table>
  <footer>{{ \App\Helpers\Navigation::trophy_details()->software }}</footer>
</body>
</html>