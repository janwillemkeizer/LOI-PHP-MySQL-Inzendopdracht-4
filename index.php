<!DOCTYPE html>
<?php
include 'connection.php';

function display_db_query($query_string, $connection) {

// perform the database query
$result_id = mysqli_query($connection, $query_string) or die
("display_db_query:" . mysql_error());

// check whether results set is populated
if (mysqli_num_rows($result_id)) {

// find out the number of columns in result
$column_count = mysqli_num_fields($result_id) or die 
("display_db_query:" . mysql_error());

// create table to display results
print ("<table>\n");

// print table headers
print("<TR>");
for ($column_num = 0; $column_num < $column_count; $column_num++) {
    $field_name = mysqli_fetch_field($result_id);
    print ("<TH>$field_name->name</TH>");   
}
print("<TR>\n");

// print the body of the table
while ($row = mysqli_fetch_row($result_id)) {
    print("<TR>\n");
        for ($column_num = 0; $column_num < $column_count; $column_num++) {
            print ("<TD>$row[$column_num]</TD>\n");
        }
    print("</TR>\n");
    }
print ("</table>\n");
} 
// If Guestbook is empty display message:
    else {
        echo '<p>Er is nog geen bericht in het gastenboek geplaatst.</p>';
    }
}

function display_db_table($tablename, $connection) {
    $query_string = "SELECT Naam, Boodschap, Sport, Datum, Beoefenaar "
            . "FROM $tablename ORDER BY ID DESC";
    display_db_query($query_string, $connection);
    mysqli_close($connection);
}      
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Inzendopdracht 051R4</title>
            <style type='text/css'>
            table, td, th {
                border: 1px solid black;
                padding: 5px;
            }
            table {
                border-collapse: collapse;
            }
            </style>
    </head>
    <body>
        <H1>Inhoud Gastenboek</H1>
        <a href="process.php">Plaats nieuw bericht.</a> 
        <br>
        <br>
        <?php
        display_db_table("Guestbook", $connection);
        ?>
    </body>
</html>
