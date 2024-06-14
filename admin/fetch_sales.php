<?php
    // Sample data including 2023 instead of a real database connection for demonstration
    $sales_data_example = [
        2021 => [
            ['month' => 1, 'total_sales' => 5000],
            ['month' => 2, 'total_sales' => 6200],
            ['month' => 3, 'total_sales' => 7000],
            ['month' => 4, 'total_sales' => 8500],
            ['month' => 5, 'total_sales' => 9000],
            ['month' => 6, 'total_sales' => 10500],
            ['month' => 7, 'total_sales' => 11000],
            ['month' => 8, 'total_sales' => 12000],
            ['month' => 9, 'total_sales' => 13000],
            ['month' => 10, 'total_sales' => 14500],
            ['month' => 11, 'total_sales' => 15000],
            ['month' => 12, 'total_sales' => 16000],
        ],
        2022 => [
            ['month' => 1, 'total_sales' => 5600],
            ['month' => 2, 'total_sales' => 6600],
            ['month' => 3, 'total_sales' => 7600],
            ['month' => 4, 'total_sales' => 8700],
            ['month' => 5, 'total_sales' => 9800],
            ['month' => 6, 'total_sales' => 10800],
            ['month' => 7, 'total_sales' => 11800],
            ['month' => 8, 'total_sales' => 12800],
            ['month' => 9, 'total_sales' => 13800],
            ['month' => 10, 'total_sales' => 14800],
            ['month' => 11, 'total_sales' => 15800],
            ['month' => 12, 'total_sales' => 16800],
        ],
        2023 => [
            ['month' => 1, 'total_sales' => 6000],
            ['month' => 2, 'total_sales' => 7100],
            ['month' => 3, 'total_sales' => 8200],
            ['month' => 4, 'total_sales' => 9300],
            ['month' => 5, 'total_sales' => 10400],
            ['month' => 6, 'total_sales' => 11500],
            ['month' => 7, 'total_sales' => 12600],
            ['month' => 8, 'total_sales' => 13700],
            ['month' => 9, 'total_sales' => 14800],
            ['month' => 10, 'total_sales' => 15900],
            ['month' => 11, 'total_sales' => 17000],
            ['month' => 12, 'total_sales' => 18100],
        ]
    ];

    $year = isset($_GET['year']) ? intval($_GET['year']) : date("Y");

    $sales_data = $sales_data_example[$year] ?? [];

    header('Content-Type: application/json');
    echo json_encode($sales_data);
?>
