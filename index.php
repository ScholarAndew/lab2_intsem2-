<?php
require_once __DIR__ . "/vendor/autoload.php";

$client = new MongoDB\Client;
$collection = $client->dbforlab->literature;

$wasSubmitted = !empty($_GET); 

$publisher = $_GET['publisher'] ?? '';
$yearFrom = $_GET['yearFrom'] ?? '';
$yearTo = $_GET['yearTo'] ?? '';
$author = $_GET['author'] ?? '';

function displayResults($cursor) {
    $fieldNames = [
        'type' => 'Тип',
        'title' => 'Назва',
        'isbn' => 'ISBN',
        'publisher' => 'Видавництво',
        'year' => 'Рік видання',
        'pages' => 'Кількість сторінок',
        'authors' => 'Автор(и)',
        'hasCD' => 'CD-диск',
        'issueNumber' => 'Номер випуску'
    ];

    echo "<div class='results'>";
    foreach ($cursor as $doc) {
        $doc = json_decode(json_encode($doc), true);
        echo "<div class='card'>";
        foreach ($doc as $key => $value) {
            if ($key === '_id') continue;

            $label = $fieldNames[$key] ?? $key;

            echo "<div class='field'><strong>$label:</strong> ";
            if ($key === 'hasCD') {
                echo $value ? "Присутній CD-диск" : "CD-диск відсутній";
            } elseif (is_array($value)) {
                echo implode(", ", $value);
            } else {
                echo htmlspecialchars((string)$value);
            }
            echo "</div>";
        }
        echo "</div>";
    }
    echo "</div>";
}
?>


<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Бібліотека</title>
    <style>
        body {
            font-family: sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        form {
            padding: 20px;
            border: 2px solid #ccc;
            border-radius: 8px;
            margin-bottom: 30px;
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input {
            padding: 5px;
            width: 100%;
            margin-top: 5px;
        }
        .results {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        .card {
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 8px;
            background: #f9f9f9;
        }
        .field {
            margin-bottom: 5px;
        }
    </style>
</head>
<body>

<h2>Пошук літератури</h2>
<form method="get">
    <label>Видавництво:
        <input type="text" name="publisher" value="<?= htmlspecialchars($publisher) ?>">
    </label>
    <label>Рік з:
        <input type="number" name="yearFrom" value="<?= htmlspecialchars($yearFrom) ?>">
    </label>
    <label>Автор:
        <input type="text" name="author" value="<?= htmlspecialchars($author) ?>">
    </label>
    <button type="submit">Шукати</button>
</form>

<?php
if ($wasSubmitted) {
    $filter = [];

    if (!empty($publisher)) {
        $filter['publisher'] = $publisher;
    }

    if (!empty($yearFrom)) {
        $filter['year'] = ['$gte' => (int)$yearFrom];
    }

    if (!empty($author)) {
        if (!empty($author)) {
            $author = trim($author); 
            $filter['authors'] = [
                '$elemMatch' => [
                    '$regex' => $author,
                    '$options' => 'i' 
                ]
            ];
        }
        
    }

    $cursor = $collection->find($filter);
    echo "<h2>Результати пошуку</h2>";
    displayResults($cursor);
}
?>
