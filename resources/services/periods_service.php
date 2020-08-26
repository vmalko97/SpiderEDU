<?php
function getPeriodTimeRange($period)
{
    global $connection;
    $response = mysqli_fetch_array(mysqli_query($connection, "SELECT time_range FROM periods WHERE period_number =" . $period, MYSQLI_ASSOC));
    return $response["time_range"];
}
function getPeriodsCount()
{
    global $connection;
    $response = mysqli_fetch_array(mysqli_query($connection, "SELECT COUNT(*) AS count FROM periods", MYSQLI_ASSOC));
    return $response["count"];
}