<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CV</title>
    <style>
        table, th, td {
            border: 1px solid black;
        }
    </style>
</head>
<body>
<form action="05-CV-Generator.php" method="post">
    <fieldset>
        <legend>Personal Info</legend>
        <div><input type="text" name="fName" placeholder="First Name" required="required"/></div>
        <div><input type="text" name="lName" placeholder="Last Name" required="required"/></div>
        <div><input type="email" name="email" placeholder="Email" required="required"></div>
        <div><input type="tel" name="phone" placeholder="Phone Number" required="required"></div>
        <div>
            <label for="female">Female</label>
            <input type="radio" name="gender" id="female" value="female"/>
            <label for="male">Male</label>
            <input type="radio" name="gender" id="male" value="male"/>
        </div>
        Bitrh date
        <div><input type="date" name="birthdate" id="birthdate" required="required"/></div>
        Nationality
        <div><select name="nationality" required="required">
                <option value="bulgarian">Bulgarian</option>
                <option value="english">Еnglish</option>
                <option value="serbian">Serbian</option>
            </select>
        </div>
    </fieldset>
    <fieldset>
        <legend>Last Work Position</legend>
        <div>Company Name <input type="text" name="company" required="required"></div>
        <div>From <input type="date" name="fromDate" required="required"/></div>
        <div>To <input type="date" name="toDate" required="required"/></div>
    </fieldset>
    <fieldset>
        <legend>Computer Skills</legend>
        Programing Languages
        <div>
            <input type="text" name="progLangs[]" id="progLangs" required="required"/>
            <select name="progLevel[]">
                <option value="begginer">Begginer</option>
                <option value="intermediate">Intermediate</option>
                <option value="advanced">Advanced</option>
            </select>
        </div>
        <div id="progLangsPlace">
            <!--            place for the added programming languages-->
        </div>
        <div>
            <input type="button" value="Remove-Prog-Language" id="remove-Prog-Lang" onclick="removeProgLanguage()"/>
            <input type="button" value="Add-Prog-Language" id="add-Prog-Lang" onclick="addProgLanguage()"/>
        </div>
    </fieldset>
    <fieldset>
        <legend>Other Skills</legend>
        Languages
        <div>
            <input type="text" name="langs[]" required="required"/>
            <select name="comprehension[]">
                <option selected="selected" disabled="disabled">-Comprehension-</option>
                <option value="beginner">Beginner</option>
                <option value="intermediate">Intermediate</option>
                <option value="advanced">Advanced</option>
            </select>
            <select name="reading[]">
                <option selected="selected" disabled="disabled">-Reading-</option>
                <option value="beginner">Beginner</option>
                <option value="intermediate">Intermediate</option>
                <option value="advanced">Advanced</option>
            </select>
            <select name="writing[]">
                <option selected="selected" disabled="disabled">-Writing-</option>
                <option value="beginner">Beginner</option>
                <option value="intermediate">Intermediate</option>
                <option value="advanced">Advanced</option>
            </select>

            <div id="langsPlace">
                <!--            place for the added languages-->
            </div>

            <div>
                <input type="button" value="Remove-Language" id="removeLang" onclick="removeLanguage()"/>
                <input type="button" value="Add-Language" id="addLang" onclick="addLanguage()"/>
            </div>
            Driver's License
            <div>
                <label for="b">B</label>
                <input type="checkbox" name="drLicense[]" id="b" value="B"/>
                <label for="a">A</label>
                <input type="checkbox" name="drLicense[]" id="a" value="A"/>
                <label for="c">C</label>
                <input type="checkbox" name="drLicense[]" id="c" value="C"/>
            </div>
    </fieldset>
    <input type="submit" name="submit" value="Generate CV"/>
</form>


<script>
    var nextIdProgLanguage = 0;
    var nextIdLanguage = 0;

    function addProgLanguage() {
        nextIdProgLanguage++;
        var inputDiv = document.createElement("div");
        inputDiv.setAttribute("id", "progLangs" + nextIdProgLanguage);
        inputDiv.innerHTML =
            '<input type="text" name="progLangs[]"/>' +
            '<select name="progLevel[]">' +
            '<option value="begginer">Begginer</option>' +
            '<option value="intermediate">Intermediate</option>' +
            '<option value="advanced">Advanced</option>' +
            '</select>';
        document.getElementById("progLangsPlace").appendChild(inputDiv);
    }

    function removeProgLanguage() {
        if (nextIdProgLanguage > 0) {
            var divToRemove = document.getElementById("progLangs" + nextIdProgLanguage);
            document.getElementById("progLangsPlace").removeChild(divToRemove);
            nextIdProgLanguage--;
        }
    }

    function addLanguage() {
        nextIdLanguage++;
        var inputDiv = document.createElement("div");
        inputDiv.setAttribute("id", "langs" + nextIdLanguage);
        inputDiv.innerHTML =
            '<input type="text" name="langs[]"/>' +
            '<select name="comprehension[]">' +
            '<option selected="selected" disabled="disabled">-Comprehension-</option>' +
            '<option value="beginner">Beginner</option>' +
            '<option value="intermediate">Intermediate</option>' +
            '<option value="advanced">Advanced</option>' +
            '</select>' +
            '<select name="reading[]">' +
            '<option selected="selected" disabled="disabled">-Reading-</option>' +
            '<option value="beginner">Beginner</option>' +
            '<option value="intermediate">Intermediate</option>' +
            '<option value="advanced">Advanced</option>' +
            '</select>' +
            '<select name="writing[]">' +
            '<option selected="selected" disabled="disabled">-Writing-</option>' +
            '<option value="beginner">Beginner</option>' +
            '<option value="intermediate">Intermediate</option>' +
            '<option value="advanced">Advanced</option>' +
            '</select>';
        document.getElementById("langsPlace").appendChild(inputDiv);
    }

    function removeLanguage() {
        if (nextIdLanguage > 0) {
            var divToRemove = document.getElementById("langs" + nextIdLanguage);
            document.getElementById("langsPlace").removeChild(divToRemove);
            nextIdLanguage--;
        }
    }

</script>
<?php

if (isset($_POST['submit'])) {
    $errorFound = false;

    $namesRegex = '/^[A-Za-z]{2,20}$/';
    $emailRegex = '/^[A-Za-z0-9]+@[A-Za-z0-9]+\.[A-Za-z0-9]+$/';
    $phoneRegex = '/[\d+ \-\+]+/';
    $companyRegex = '/^[A-Za-z0-9]{2,20}$/';

    $fName = $_POST['fName'];
    $lName = $_POST['lName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $birthdate = $_POST['birthdate'];
    $nationality = $_POST['nationality'];
    $company = $_POST['company'];
    $fromDate = $_POST['fromDate'];
    $toDate = $_POST['toDate'];
    $progLangs = $_POST['progLangs'];
    $progLevel = $_POST['progLevel'];
    $langs = $_POST['langs'];
    $comprehension = $_POST['comprehension'];
    $reading = $_POST['reading'];
    $writing = $_POST['writing'];
    $drLicense = $_POST['drLicense'];


    if (!preg_match($namesRegex, $fName)) {
        echo "Invalid first name!";
        $errorFound = true;
    }
    if (!preg_match($namesRegex, $lName)) {
        echo "Invalid last name!";
        $errorFound = true;
    }
    if (!preg_match($emailRegex, $email)) {
        echo "Invalid e-mail!";
        $errorFound = true;
    }

    if (!preg_match($phoneRegex, $phone)) {
        echo "Invalid phone number!";
        $errorFound = true;
    }

    if (!preg_match($companyRegex, $company)) {
        echo "Invalid Company Name!";
        $errorFound = true;
    }

    foreach ($langs as $lang) {
        if (!preg_match($namesRegex, $lang)) {
            echo "Invalid language!";
            $errorFound = true;
            break;
        }
    }

    if ($errorFound) {
        die();
    }
}
?>

<h2>CV</h2>
<table>
    <thead>
    <tr>
        <th colspan="2">Personal Information</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>First Name</td>
        <td><?= $fName ?></td>
    </tr>
    <tr>
        <td>Last Name</td>
        <td><?= $lName ?></td>
    </tr>
    <tr>
        <td>Email</td>
        <td><?= $email ?></td>
    </tr>
    <tr>
        <td>Phone Number</td>
        <td><?= $phone ?></td>
    </tr>
    <tr>
        <td>Gender</td>
        <td><?= $gender ?></td>
    </tr>
    <tr>
        <td>Birth Date</td>
        <td><?= $birthdate ?></td>
    </tr>
    <tr>
        <td>Nationality</td>
        <td><?= $nationality ?></td>
    </tr>
    </tbody>
</table>

<table>
    <thead>
    <tr>
        <th colspan="2">Last Work Position</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>Company Name</td>
        <td><?= $company ?></td>
    </tr>
    <tr>
        <td>From</td>
        <td><?= $fromDate ?></td>
    </tr>
    <tr>
        <td>To</td>
        <td><?= $toDate ?></td>
    </tr>
    </tbody>
</table>

<table>
    <thead>
    <tr>
        <th colspan="2">Computer Skills</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>Programming Languages</td>
        <td>
            <table>
                <thead>
                <tr>
                    <th>Language</th>
                    <th>Skill Level</th>
                </tr>
                </thead>
                <tbody>
                <?php for ($i = 0; $i < count($progLangs); $i++): ?>
                    <tr>
                        <td><?= htmlspecialchars($progLangs[$i]) ?></td>
                        <td><?= htmlspecialchars($progLevel[$i]) ?></td>
                    </tr>
                <?php endfor; ?>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>

<table>
    <thead>
    <tr>
        <th colspan="2">Other Skills</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>Languages</td>
        <td>
            <table>
                <thead>
                <tr>
                    <th>Language</th>
                    <th>Comprehension</th>
                    <th>Reading</th>
                    <th>Writing</th>
                </tr>
                </thead>
                <tbody>
                <?php for ($i=0; $i < count($langs); $i++): ?>
                    <tr>
                        <td><?= $langs[$i] ?></td>
                        <td><?= $comprehension[$i] ?></td>
                        <td><?= $reading[$i] ?></td>
                        <td><?= $writing[$i] ?></td>
                    </tr>
                <?php endfor; ?>
                </tbody>
            </table>
        </td>
    <tr>
        <td>Driver`s License</td>
        <td><?= implode(', ', $drLicense) ?></td>
    </tr>
    </tr>
    </tbody>
</table>
</body>
</html>