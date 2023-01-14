  <!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Clasament Cultural</title>

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
            <h1>Clasament Cultural</h1>
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
        <th width="10%" class="text-center">Nr.</th>
        <th width="40%">Nume Club</th>
        <th width="10%">Puncte</th>
      </tr>
    </thead>
    <tbody>

      @foreach($rankings as $rank)
      <tr>
          <td class="text-center">@if($rank['scor'] == 0) - @else {{ $rank['rank'] }} @endif</td>
          <td>{{ $rank['name'] }}</td>
          <td class="text-center">@if(isset($rank['scor'])) {{ $rank['scor'] }} @else N/A @endif</td>
      </tr>
      @endforeach

    </tbody>
  </table>
  <footer>{{ \App\Helpers\Navigation::trophy_details()->software }}</footer>
</body>
</html>