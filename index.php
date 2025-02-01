<?php
if (isset($_POST['amount']) && isset($_POST['currency'])) {
    $amount = $_POST['amount'];
    $currency = $_POST['currency'];
    
    $api_url = "https://api.exchangerate-api.com/v4/latest/USD";
    $response = file_get_contents($api_url);
    $data = json_decode($response, true);

    if (isset($data['rates'][$currency])) {
        $converted_amount = $amount * $data['rates'][$currency];
        echo "💰 {$amount} USD = " . number_format($converted_amount, 2) . " {$currency}";
    } else {
        echo "❌ Валюта не знайдена.";
    }
}
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Конвертер валют</title>
</head>
<body>
    <form method="post">
        <input type="number" name="amount" placeholder="Сума" required>
        <select name="currency">
            <option value="EUR">EUR</option>
            <option value="UAH">UAH</option>
        </select>
        <button type="submit">🔄 Конвертувати</button>
    </form>
</body>
</html>
