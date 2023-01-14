  <!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Clasament General</title>

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
            <h1>Lista Start Echipe</h1>
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
        <th>Nr</th>
        <th>Ora Start</th>
        <th>Categorie</th>
        <th>Club</th>
        <th>Echipa</th>
      </tr>
    </thead>
    <tbody>
      @foreach($results as $result)
      <tr>
          <td width="3%">{{ $number++ }}</td>
          <td width="10%">{{ $data_start->addMinutes($minute_start)->format('h:i:s') }}</td>
          <td>{{ $result['category'] }}</td>
          <td>{{ $result['club'] }}</td>
          <td>{{ $result['team'] }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <footer>{{ \App\Helpers\Navigation::trophy_details()->software }}</footer>
</body>
</html>