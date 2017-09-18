<!doctype html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Christopher Hum">

    <title>Tripbuilder - Add Flights to current Trip </title>
    <!-- This webpage is the main page for adding Flights to a trip -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- Create Javascript for Events to click on rows and submit data to controllers -->
    <script>

        //Set Listener for From table
        $(document).on('click', '.clickRowFrom', function()
        {
            //Add a 'selected' class to currently clicked class
            $(this).addClass('selected').siblings().removeClass('selected');
            var value=$(this).find('td:first').html();
            document.getElementById('currentFrom').value = value;
        });

        //Set Listener for To table
        $(document).on('click', '.clickRowTo', function()
        {
            $(this).addClass('selected').siblings().removeClass('selected');
            value=$(this).find('td:first').html();
            //alert(value);

            document.getElementById('currentTo').value = value;
        });

        //Generate FROM table after user types in Airport Name and clicks 'Search FROM'.
        // Calls the /search/ route in Ajax (so user stays on same page)
        $(document).ready(function(){
            $('#searchButton').click(function(){
                var searchText = $('#searchBar').val();
                $.get('/search/'+searchText, function(data, status){
                    var table_content = '';
                    for(var i=0; i < data.length;i++)
                    {
                        table_content += '<tr class=\'clickRowFrom\'>';
                        table_content += '<td>' + data[i].name + '</td>';
                        table_content += '<td>' + data[i].code + '</td>';
                        table_content += '<td>' + data[i].country + '</td></tr>';
                    }
                    $('#airportData tbody').html(table_content);
                });
            });
        });

        //Generate TO table after user types in Airport Name and clicks 'Search TO'.
        // Calls the /search/ route in Ajax (so user stays on same page)
        $(document).ready(function(){
            $('#searchButtonTo').click(function(){
                var searchText = $('#searchBarTo').val();
                $.get('/search/'+searchText, function(data, status){
                    var table_content = '';
                    for(var i=0; i < data.length;i++)
                    {
                        table_content += '<tr class=\'clickRowTo\'>';
                        table_content += '<td>' + data[i].name + '</td>';
                        table_content += '<td>' + data[i].code + '</td>';
                        table_content += '<td>' + data[i].country + '</td></tr>';
                    }
                    $('#airportDataTo tbody').html(table_content);
                });
            });
        });

        //TODO Make the previous table generation operations into functions where parameters are passed
    </script>

    <!-- CSS styling for highlighted row -->
    <style>
        .selected{
            background-color:lightblue;
            color: #090909;
        }
    </style>
</head>
<body>

<h1 style="text-align: center;"><strong>Chris TripBuilder</strong></h1>
<h3 style="text-align:center"><a href="/tripbuilder">Click Here to Return to Trip Selection</a></h3>
<h2 style="text-align: center;"><strong>List of all Flights for Trip Number: <?php echo e(Session::get('current_trip')); ?></strong></h2>

<!-- Table creation of all Flights for Current Trip -->
<table style="width: auto; margin-left: auto; margin-right: auto;" border="3" cellspacing="3" cellpadding="1">
    <tbody>
    <tr>
        <td style="width: auto; text-align: center;"><strong>Flight Number</strong></td>
        <td style="width: auto; text-align: center;"><strong>Airport From</strong></td>
        <td style="width: auto; text-align: center;"><strong>Airport Destination</strong></td>
    </tr>

    <!-- Note: Using standard php tags instead of double curly braces in laravel -->
    <?php foreach ($flights as $flight) : ?>
    <tr>

        <td style="width: auto;text-align:center"><?php echo $flight->id; ?></td>
        <td style="width: auto;"><?php echo $flight->airport_from; ?></td>
        <td style="width: auto;"><?php echo $flight->airport_to; ?></td>
        <td style="width: 150px;">

            <form action="<?php echo e(url('removeFlight/' . $flight->id)); ?>" method="POST">
            <!-- Generate csrf input field token using blade method -->
                <?php echo e(csrf_field()); ?>


                <!-- This blade method spoofs a request so DELETE can be picked up by Route -->
                <?php echo e(method_field('DELETE')); ?>

                <button type="submit" id="delete-trip-<?php echo e($flight->id); ?>" style="width:auto;text-align:center;">
                    <i class="fa fa-btn fa-trash"></i>Delete Flight
                </button>
            </form>
        </td>
    </tr>
    <?php endforeach; ?>

    </tbody>
</table>
<br><br>

<!-- BEGIN Table for typing in searches for FROM Airport Name and TO Airport Name-->
<table border="1" style="width:auto; margin-left:auto;margin-right:auto">
    <tr>
        <td>
            <div class="wrap" style="text-align:center;">
                <div class="search">
                    <div class="title-color" style="text-align:center;">
                        <br><b>Search FROM by Airport Name</b><br><br>
                    </div>
                    <div class = "searchControls" style="text-align:center";>
                        <input type="text" name="searchBar" id="searchBar" placeholder="search from airport..." style="text-align:center;">
                        <button type="submit" id = "searchButton" class="searchButton">
                            <i class="fa fa-search">Search FROM</i>
                        </button>
                        <br>
                    </div>
                </div>
            </div>
        </td>
        <td>
            <div class="wrap" style="text-align:center;">
                <div class="search">
                    <div class="title-color" style="text-align:center;">
                        <br><b>Search a TO by Airport Name</b><br><br>
                    </div>
                    <div class = "searchControlsTo" style="text-align:center";>
                        <input type="text" name="searchBarTo" id="searchBarTo" placeholder="search to airport..." style="text-align:center;">
                        <button type="submit" id = "searchButtonTo" class="searchButtonTo">
                            <i class="fa fa-search">Search TO</i>
                        </button>
                        <br>
                    </div>
                </div>
            </div>
        </td>
    </tr>
</table>
<!-- END Table for typing in searches for FROM Airport Name and TO Airport Name-->

<br><br>

<!-- BEGIN Table that holds both generated Airport Name tables and Submit Choices in between -->
<table style="width:auto; margin-left:auto;margin-right:auto" border="1">
    <!-- FROM Airport Table START -->

    <td style ="vertical-align: top">
        <br><div style = "text-align:center";><b>Click on FROM Airport location</b></div><br>

        <table id="airportData" style="width: 504px; height: 100px; margin-left: auto; margin-right: auto;" border="3" cellspacing="1" cellpadding="1">
            <thead>
            <tr>
                <td style="text-align: center;"><strong>Airport Name</strong></td>
                <td style="text-align: center;"><strong>Airport City</strong></td>
                <td style="text-align: center;"><strong>Country-Area</strong></td>
            </tr>
            </thead>
            <tbody id="fromAirport">
            </tbody>
        </table>
    </td>
    <!-- FROM Airport Table END -->

    <!-- Submit Button Area START -->
    <td style="width:400px;vertical-align: top;text-align:center;">
        <form action="/addflight" method = "POST">
            <?php echo e(csrf_field()); ?>

            <br>
            To use this page - Type an airport name (or partial name) in the above fields "Search FROM and a Search TO"
            <br><br>
            <b>Click respective Search FROM / Search TO buttons</b>
            and results will populate in the tables (this request is done with ajax so you can search multiple times on the same page).
            <br><br>
            Click <b>BOTH</b> a FROM Airport and a TO Airport row, then click the <b>Submit Choices</b> button below:
            <br><br>

            FROM Airport:
            <input type ="text" id="currentFrom" name="currentFrom" value="none selected" style="font-weight:bold;text-align:center;width:300px;height: 40px;" readonly><br><br><br>
            TO Airport:<br>
            <input type ="text" id="currentTo" name="currentTo" value="none selected" style="font-weight:bold;text-align:center;width:300px;height: 40px;" readonly><br><br><br>
            <button type="submit" id = "submitAirports" class="submitAirports" style="width:100px;height:50px;">
                Submit Choices
            </button><br><br>
        </form>
        <br>
    </td>
    <!-- Submit Button Area END -->

    <!-- TO Airport Table Start -->
    <td style ="vertical-align: top">
        <br><div style = "text-align:center";><b>Click on TO Airport location</b></div><br>
        <table id="airportDataTo" style="width: 504px; height: 100px; margin-left: auto; margin-right: auto;" border="3" cellspacing="1" cellpadding="1">
            <thead>
            <tr>
                <td style="text-align: center;"><strong>Airport Name</strong></td>
                <td style="text-align: center;"><strong>Airport City</strong></td>
                <td style="text-align: center;"><strong>Country-Area</strong></td>
            </tr>
            </thead>
            <tbody id="toAirport">
            </tbody>
        </table>
    </td>
    <!-- TO Airport Table END -->
</table>
<!-- END Table that holds both generated Airport Name tables and Submit Choices in between -->
</body>
</html>
