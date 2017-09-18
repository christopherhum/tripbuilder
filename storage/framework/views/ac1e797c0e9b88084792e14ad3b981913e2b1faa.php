<!doctype html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Christopher Hum">

    <title>TripBuilder</title>
    <!-- This webpage is the landing page for the Tripbuilder application -->


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>



</head>
<body>


<h1 style="text-align: center;"><strong>Chris TripBuilder</strong></h1>
<h2 style="text-align: center;"><strong>All Available Trips</strong></h2>

<!-- Display all available trips -->
<table style="width: 200px; height: 209px; margin-left: auto; margin-right: auto;" border="3" cellspacing="5" cellpadding="5">
    <tbody>
    <tr>
        <td style="width: 100px; text-align: center;"><strong>Trip Number</strong></td>
    </tr>

    <?php foreach($trips as $trip): ?>
    <tr>
        <td style="width: 100px;text-align:center"><?php echo e($trip->id); ?></td>
    </tr>
    <?php endforeach; ?>


    </tbody>
</table>

<br><br>
<!-- Select a Trip via dynamically created Drop Down and then redirect to display corresponding Flights -->
<form action="/edittrip" style= "text-align: center;"method="GET" class="form-horizontal">
    <div class="wrap" style="text-align:center;">
        <div class="edittrip">
            Select a Trip Number to edit from the drop down:
            <select name="selectedTrip">
                <?php foreach($trips as $trip): ?>
                <option value="<?php echo e($trip->id); ?>"><?php echo e($trip->id); ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit" class="edittrip">
                <i class="fa fa-search">Edit Trip</i>
            </button>
        </div>
    </div>
</form>

</body>
</html>
