<?php
$filters = [
    'make' => $_GET['make'] ?? '',
    // ... other filters ...
];

$conditions = [];
foreach ($filters as $key => $value) {
    if ($value !== '') {
        $escaped = pg_escape_string($conn, $value);
        switch ($key) {
            case 'make':
                $conditions[] = "$key ILIKE '%$escaped%'";
                break;
            // ... other cases ...
        }
    }
}

$query = "SELECT * FROM vehicles";
if (!empty($conditions)) {
    $query .= " WHERE " . implode(" AND ", $conditions);
}