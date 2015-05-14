<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Calculate Interest</title>
</head>
<body>
<form action="03-Calculate-Interset.php" method="post">
    <div>
        Enter Amount
        <input type="text" name="amount"/>
    </div>
    <div>

        <input type="radio" value="usd" name="currency" id="usd"/>
        <label for="usd">USD</label>
        <input type="radio" value="euro" name="currency" id="euro"/>
        <label for="euro">EUR</label>
        <input type="radio" value="bgn" name="currency" id="bgn"/>
        <label for="bgn">BGN</label>
    </div>
    <div>
        Compound Interest Amount
        <input type="text" name="annualInterestAmount"/>
    </div>
    <div>
        <select name="period">
            <option value="sixMonths" selected="selected">6 Months</option>
            <option value="oneYear">1 Year</option>
            <option value="twoYears">2 Years</option>
            <option value="fiveYears">5 Years</option>
        </select>
        <input type="submit" value="Calculate"/>
    </div>
</form>

</body>
</html>

<?php
if (isset($_POST["amount"]) && isset($_POST["annualInterestAmount"]) &&
    isset($_POST["period"]) && isset($_POST["currency"])
) {
    if (filter_var($_POST["amount"], FILTER_VALIDATE_FLOAT) && filter_var($_POST["annualInterestAmount"], FILTER_VALIDATE_FLOAT)) {

        $amount = $_POST["amount"];
        $interestPerMonth = $_POST["annualInterestAmount"] / 12;
        $period = $_POST["period"];
        switch ($period) {
            case "sixMonths" :
                $months = 6;
                break;
            case "oneYear":
                $months = 12;
                break;
            case "twoYears":
                $months = 24;
                break;
            case "fiveYears":
                $months = 60;
                break;
        }

        $currency = $_POST["currency"];
        switch ($currency) {
            case "usd" :
                $currencySign = "$";
                break;
            case "euro":
                $currencySign = "&euro;";
                break;
            case "bgn":
                $currencySign = "лв";
                break;
        }

        $totalMoney = CalculateAmount($months, $amount, $interestPerMonth);
        echo $currencySign . " " . number_format($totalMoney, 2, ".", "");


    } else {
        echo "Incorrect input!";
    }
}

function CalculateAmount($time, $money, $interest)
{
    for ($i = 0; $i < $time; $i++) {
        $money += $interest * $money / 100;
    }
    return $money;
}
