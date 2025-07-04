  <!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Clasament Alpinism - {{ $category->name }}</title>

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
            <h1>Clasament Alpinism - Categoria {{ $category->name }}</h1>
            <h3>{{ \App\Helpers\Navigation::trophy($stageid)->name }}</h3>
            <h3>{{ \App\Helpers\Navigation::trophy($stageid)->ong }}</h3>
        </td>
        <td valign="right" class="text-center"><img src="logo2.png" alt="" width="150"/></td>
    </tr>

  </table>

  <br/>

  <table width="100%">
    <thead style="background-color: lightgray;">
      <tr>
        <th width="5%" class="text-center">Loc</th>
        <th width="30%">Nume Echipa</th>
        <th width="10%" class="text-center">Metri</th>
        <th width="15%" class="text-center">Scor</th>
        <th width="15%" class="text-center">Timp Realizat</th>
      </tr>
    </thead>
    <tbody>
        @foreach($rankings as $rank)
        <tr>
            <td class="text-center">{{ $rank['rank'] }}</td>
            <td>{{ $rank['name'] }}</td>
            <td class="text-center">{{ $rank['meters'] }}</td>
            <td class="text-center">{{ $rank['scor'] }}</td>
            <td class="text-center">{{ $rank['time'] }}</td>
        </tr>
        @endforeach
        @foreach($teams_list_abandon as $rank)
        <tr>
            <td class="text-center">-</td>
            <td>{{ $rank['name'] }}</td>
            <td class="text-center">-</td>
            <td class="text-center">@if($rank['abandon'] == 1) Abandon @else Descalificata @endif</td>
            <td class="text-center">-</td>
        </tr>
        @endforeach
    </tbody>
  </table>
  <footer>{{ \App\Helpers\Navigation::trophy_details()->software }}</footer>
</body>
</html>