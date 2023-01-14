  <!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Clasament Orientare - {{ $category->name }}</title>

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
            <h1>Clasament Orientare - Categoria {{ $category->name }}</h1>
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
        <th width="5%" class="text-center">Loc</th>
        <th width="20%">Nume Echipa</th>
        <th width="5%" class="text-center">Timp</th>
        <th width="5%" class="text-center">Punctaj</th>
        <th width="5%" class="text-center">Post Lipsa</th>
         @if($ultra_orienteering == "1")<th width="30%" class="text-center">Ordine Posturi</th>@endif
      </tr>
    </thead>
    <tbody>
        @foreach($rankings as $rank)
        <tr>
            <td class="text-center">{{ $rank['rank'] }}</td>
            <td>{{ $rank['name'] }}</td>
            <td class="text-center">{{ $rank['total_time'] }}</td>
            <td class="text-center">{{ $rank['scor'] }}</td>
            <td class="text-center">@if(!empty($rank['missing'])) DA @else Nu @endif</td>
             @if($ultra_orienteering == "1")<td class="text-center">{{ $rank['order_posts'] }}</td>@endif
        </tr>
        @endforeach
        @foreach($teams_list_disqualified as $rank)
        <tr>
            <td class="text-center">-</td>
            <td>{{ $rank['name'] }}</td>
            <td class="text-center">{{ $rank['total_time'] }}</td>
            <td class="text-center">Descalificata</td>
            <td class="text-center">@if(!empty($rank['missing'])) DA @else Nu @endif</td>
             @if($ultra_orienteering == "1")<td class="text-center">{{ $rank['order_posts'] }}</td>@endif
        </tr>
        @endforeach
        @foreach($teams_list_abandon as $rank)
        <tr>
            <td class="text-center">-</td>
            <td>{{ $rank['name'] }}</td>
            <td>-</td>
            <td class="text-center">Abandon</td>
            <td class="text-center">-</td>
             @if($ultra_orienteering == "1")<td class="text-center">-</td>@endif
        </tr>
        @endforeach
    </tbody>
  </table>
  <br/>
  <br/>
  @if($ultra_orienteering == "1")<div class="text-center text-stations">Validarea corecta a punctelor de control: {{ $orienteering_stations_stage_result }}</div>@endif
  <footer>{{ \App\Helpers\Navigation::trophy_details()->software }}</footer>
</body>
</html>