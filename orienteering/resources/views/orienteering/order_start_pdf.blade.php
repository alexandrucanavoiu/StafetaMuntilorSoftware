<html>
<head>
    <title>Ordine Start</title>
    <style type="text/css">
        body {
            font-family: DejaVu Sans;
            font-size: 14px;
        }
        #page-wrap {
            width: 95%;
            margin: 0 auto;
        }
        .center-justified {
            text-align: justify;
            margin: 0 auto;
            width: 30em;
        }
        table.outline-table {
            border: 1px solid;
        }
        .right { float: right;  }
        .left {
            float: right;}
        .center { text-align: center;}

    </style>
</head>
<body>
<div id="page-wrap">
    <table width="100%">
        <tbody>
        <tr id="invoicetitle">
            <td></td>
            <td style="border-bottom: solid 1px #000;" colspan="2" width="40%" valign="middle" align="center">
                <em style="font-size: 18px; font-weight: bold;">
LISTĂ ȘTART {{ strtoupper($organizer->name_trophy) }}
                </em>
            </td>
            <td>
            </td>
        </tr>
        </tbody>
    </table>
    <p class="center">Organizator: {{ strtoupper($organizer->name_organizer) }}</p>

    <p>&nbsp;</p>
    <table width="100%" style="font-size: 12px;" class="outline-table">
        <tbody>
        <tr class="center">

            <th class="center" width="5%">Nr</th>
            <th class="center" width="10%">Ora Start</th>
            <th class="center" width="10%">Categorie</th>
            <th>Club</th>
            <th>Echipa</th>
        </tr>


        @foreach($results as $result)
            <tr>
                <td class="center" width="4%">{{ $number++ }}</td>
                <td class="center" width="10%">{{ $data_start->addMinutes($minute_start)->format('h:i:s') }}</td>
                <td class="center" width="10%">{{ $result['category'] }}</td>
                <td width="38%">{{ $result['club'] }}</td>
                <td width="38%">{{ $result['team'] }}</td>
            </tr>
        @endforeach

        </tbody>
    </table>
    <br /><br />
</div>
</body>
</html>
