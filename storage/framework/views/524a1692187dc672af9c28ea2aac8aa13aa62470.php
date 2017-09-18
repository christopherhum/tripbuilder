<!doctype html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tripbuilder - Search Page</title>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>


<h1 style="text-align: center;"><strong>Chris TripBuilder</strong></h1>
<h2 style="text-align: center;"><strong>List of Trips for Current Trip</strong></h2>


<table id="airportRowData" style="width: 504px; height: 209px; margin-left: auto; margin-right: auto;" border="3" cellspacing="5" cellpadding="1">
    <tbody>
    <tr>
        <td style="width: 150.633px; text-align: center;"><strong>Airport Name</strong></td>
        <td style="width: 166.733px; text-align: center;"><strong>Airport Code</strong></td>
        <td style="width: 148.633px; text-align: center;"><strong>Airport Country</strong></td>
    </tr>

    <!-- TODO CREATE A TRIPCONTROLLER CLASS AND GRAB THE TRIP ID
    TODO REMOVE the flight_id from trips table (possibly not needed)  -->

    <?php foreach ($searches as $search) : ?>
            <tr>
                <td style="width: 166.733px;"><?php echo e($search->name); ?></td>
                <td style="width: 148.633px;"><?php echo e($search->code); ?></td>
                <td style="width: 148.633px;"><?php echo e($search->country); ?></td>
                <td style="width: 148.633px;">
                    <form action="<?php echo e(url('add')); ?>" method="GET" class="form-horizontal">
                        <button type="submit" class="addButton">
                            <i class="fa fa-search">Add Airport</i>
                        </button>
                    </form>
                </td>
            </tr>
    <?php endforeach; ?>

    </tbody>
</table>

<script type="text/javascript">
    $("#airportRowData tr").click(function(){
        $(this).addClass('selected').siblings().removeClass('selected');
        var value=$(this).find('td:first').html();
        alert(value);
    });
</script>
<style>
.selected{
    background-color:lightblue;
    color: #ffffff;
}


</style>
<br><br>
<!-- Search for Airport area -->

<form action="<?php echo e(url('search')); ?>" method="POST" class="form-horizontal">
    <div class="wrap" style="text-align:center;">
        <div class="search">
            <input type="text" class="searchTerm" placeholder="Type in airport name here">
            <button type="submit" class="searchButton">
                <i class="fa fa-search">Search</i>
            </button>
        </div>
    </div>
</form>


</body>
</html>
