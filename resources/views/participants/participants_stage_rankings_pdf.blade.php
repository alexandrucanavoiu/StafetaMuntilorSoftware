<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Stafeta Muntilor - Clasament Individual</title>

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
            <h1>Stafeta Muntilor - Clasament Individual</h1>
        </td>
        <td valign="right" class="text-center"><img src="logo2.png" alt="" width="150"/></td>
    </tr>

  </table>

  <br/>

  <table width="100%">
    <thead style="background-color: lightgray;">
      <tr>
        <th width="5%" class="text-center">Loc</th>
        <th width="30%">Nume</th>
        <th width="30%">Club</th>
        @foreach ($stages as $stage)
        <th width="10%" class="text-center">Categ. Et. {{ $stage->id }}</th>
        <th width="10%" class="text-center">Etapa {{ $stage->id }}</th>
        @endforeach
        <th width="5%" class="text-center">Total</th>
    </tr>
    </thead>
    <tbody>
      @foreach($rankingsparticipantsStats as $key => $rank)
      <tr>
          <td class="text-center">{{ $rank['rank'] }}</td>
          <td>{{ $rank['name'] }}</td>
          <td>
              @foreach ($rank['club'] as $club)
                  <div>{{ $club }}</div>
              @endforeach
          </td>
          @foreach ($stages as $key => $stage)
                  @if(!empty($rank['stages'][$stage->id]))
                  <td class="text-center">{{ $rank['stages'][$stage->id]->category_name }}</td>
                  <td class="text-center">{{ $rank['stages'][$stage->id]->scor }}</td>
                  @else
                  <td class="text-center">X</td>
                  <td class="text-center">0</td>
                  @endif
          @endforeach
          <td class="text-center">{{ $rank['total_score'] }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <br/>
  <br/>
  <footer>{{ \App\Helpers\Navigation::trophy_details()->software }}</footer>
</body>
</html>