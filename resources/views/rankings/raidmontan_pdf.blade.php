  <!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Clasament Raid Montan - {{ $category->name }}</title>

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

    .text-stations{
        font-size: x-small;
    }

    footer { position: fixed; bottom: -60px; left: 0px; right: 0px; height: 50px; font-size: x-small;}

</style>

</head>
<body>

  <table width="100%">
    <tr>
        <td valign="right" class="text-center"><img src="logo.png" alt="" width="150"/></td>
        <td class="text-center">
            <h1>Clasament Raid Montan - Categoria {{ $category->name }}</h1>
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
        <th width="20%">Nume Echipa</th>
        <th width="5%" class="text-center">Scor</th>
        <th width="5%" class="text-center">Timp Total</th>
        <th width="30%" class="text-center">Depunctarea</th>
      </tr>
    </thead>
    <tbody>
        @foreach($rankings as $rank)
        <tr>
            <td class="text-center">{{ $rank['rank'] }}</td>
            <td>{{ $rank['name'] }}</td>
            <td class="text-center">{{ $rank['total_score'] }}</td>
            <td class="text-center">{{ $rank['total_time'] }}</td>
            <td>
                @isset($rank['depunctation_status'])
                    @foreach ($rank['depunctation_status'] as $depunctation_status)
                        <div>{{ $depunctation_status }}</div>
                    @endforeach
                @else
                Fara penalizare
                @endif
            </td>
        </tr>
        @endforeach
        @foreach($teams_list_disqualified as $rank)
        <tr>
            <td class="text-center">-</td>
            <td>{{ $rank['name'] }}</td>
            <td class="text-center">-</td>
            <td class="text-center">Descalificata</td>
            <td>-</td>
        </tr>
        @endforeach
        @foreach($teams_list_abandon as $rank)
        <tr>
            <td class="text-center">-</td>
            <td>{{ $rank['name'] }}</td>
            <td class="text-center">-</td>
            <td class="text-center">Abandon</td>
            <td>-</td>
        </tr>
        @endforeach
    </tbody>
  </table>
  <br/>
  <br/>
  <footer>{{ \App\Helpers\Navigation::trophy_details()->software }}</footer>
</body>
</html>