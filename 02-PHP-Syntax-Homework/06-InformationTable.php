<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Table</title>
    <style>
        table {
            border-collapse: collapse;
        }

        table td {
            border: solid 1px #000;
            padding: 5px 10px;
        }

        table td:first-child {
            font-weight: bold;
            background: orange;
        }

        table td:last-child {
            text-align: right;
        }
    </style>
</head>
<body>

<?php
$name = "Gosh";
$phoneNumber = "0888-888-888";
$age = 99;
$address = "Liulin24";
?>

<table>
    <tr>
        <td>Name</td>
        <td>
            <?php echo $name;?>
        </td>
    </tr>
    <tr>
        <td>Phone number</td>
        <td>
            <?php echo $phoneNumber;?>
        </td>
    </tr>
    <tr>
        <td>Age</td>
        <td>
            <?php echo $age;?>
        </td>
    </tr>
    <tr>
        <td>Address</td>
        <td>
            <?php echo $address;?>
        </td>
    </tr>
</table>

</body>
</html>

