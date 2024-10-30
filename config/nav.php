<?php
return [
    [
        "icon" => "nav-icon fas fa-tachometer-alt",
        "route" => "dashboard.dashboard",
        "title" => "Dashboard"
    ],
    [
        "icon" => "nav-icon fas fa-tachometer-alt",
        "route" => "dashboard.categories.index",
        "title" => "Categories",
        "badge"=> "New",
        "active" => "dashboard.categories"  // You might want to use a static value like "New" instead of route name
    ],
    [
        "icon" => "nav-icon fas fa-tachometer-alt",
        "route" => "dashboard.products.index", // Note: Corrected capitalization for consistency
        "title" => "Products",
        "active" => "dashboard.products"
    ],
    [
        "icon" => "nav-icon fas fa-tachometer-alt",
        "route" => "dashboard.products.index", // Note: Corrected capitalization for consistency
        "title" => "orders",
        "active" => "dashboard.Orders"
    ]
];
