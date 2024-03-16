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
            <h1>Clasament General</h1>
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
        <td width="5%" class="text-center">Loc</td>
        <td width="30%">Nume Club</td>
        <td width="5%" class="text-center">Family</td>
        <td width="5%" class="text-center">Junior</td>
        <td width="5%" class="text-center">Elite</td>
        <td width="5%" class="text-center">Open</td>
        <td width="5%" class="text-center">Veterani</td>
        <td width="5%" class="text-center">Feminin</td>
        <td width="5%" class="text-center">Seniori</td>
        <td width="5%" class="text-center">Bonus</td>
        <td width="5%" class="text-center">Total</td>
      </tr>
    </thead>
    <tbody>
      @foreach($rankings as $key => $rank)
      <tr>
          <td class="text-center">{{ $rank['rank'] }}</td>
          <td>{{ $rank['club_name'] }}</td>
          @php
              $array_categories = array_slice($rank['categories'], 0, 4);
          @endphp
          @foreach ($categories as $category)
                  @if (array_key_exists($category->name, $array_categories))
                      <td class="text-center">{{ $rank[$category->name] }}</td>
                  @else
                      <td class="text-center"><s>{{ $rank[$category->name] }}</s></td>
                  @endif
          
          @endforeach
          <td class="text-center">{{ $rank['bonus'] }}</td>
          <td class="text-center">{{ $rank['total_sm'] }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <footer>{{ \App\Helpers\Navigation::trophy_details()->software }}</footer>
</body>
</html>