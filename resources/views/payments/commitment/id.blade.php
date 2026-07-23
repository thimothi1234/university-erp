<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>President Visit ID Cards</title>
    
    <style>
        body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            
        }

        table {
    width: 100%;
    border-spacing: 10px; /* Adjust spacing as needed */
    table-layout: fixed;
    
}

td {
    border: 2px solid black;
    text-align: center;
    font-size: 20px;
    width: 25%; /* 4 equal columns */
    height: 485px; /* Adjust height as needed */
    vertical-align: top;
    padding: 10px;
    background-color: lightblue;
}


        .id-card {
            padding: 15px;
            text-align: center;
            font-family: Arial, sans-serif;
            width: 90%;
            height: 90%;
            margin: auto;
            background-color: lightblue;
        }

        .id-card img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        .id-card h3 {
            margin: 5px 0;
            font-size: 22px;
        }
        h4 {
            background-color:rgb(8, 105, 116);
            color: white;
            width: 100%;
            padding: 20px;
            text-align: center;
            display: block; 
            
        }
        h1{
            border-radius: 25px;
  background:rgb(255, 255, 255);
  padding: 20px; 
  width: 200px;
  height: 150px; 
        }
        hr { background-color: red; height: 5px; border: 0; }
    </style>
</head>
<body>
    <table>
        <tbody>
            @php 
                $totalEmployees = count($employees);
                $rows = ceil($totalEmployees / 4); // Calculate required rows
                $index = 0;
            @endphp
            @for($i = 0; $i < $rows; $i++)
                <tr>
                    @for($j = 0; $j < 4; $j++)
                        <td>
                            @if($index < $totalEmployees)
                                <div class="id-card">
                                    <img src="logo.PNG" alt="IITH" width="310" height="70">
                                    <hr>
                                    
                                  
                                    <h4 class="">Vice President's Visit to <br> IIT Hyderabad</h4>
                                    <br>
                                    <h3>{{ $employees[$index]->type }}</h3>
                                    <br> <h2>{{ $employees[$index]->id }}</h2><br>
                                    <h3>{{ $employees[$index]->name }}</h3>
                                    <p>{{ $employees[$index]->eid }}</p>
                                   
                                    <br>
                                    <h1>PASS</h1>
                                    <h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Valid on 02-03-2025&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h4>
                                </div>
                                @php $index++; @endphp
                            @endif
                        </td>
                    @endfor
                </tr>
            @endfor
        </tbody>
    </table>
</body>
</html>
