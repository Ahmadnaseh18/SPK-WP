<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['login'])) {
    header("location:../auth/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPK WP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }

        .wrapper {
            display: flex;
            width: 100%;
            align-items: stretch;
        }

        #sidebar {
            min-width: 250px;
            max-width: 250px;
            min-height: 100vh;
            background: #0d6efd;
            color: #fff;
            transition: all 0.3s;
        }

        #sidebar .sidebar-header {
            padding: 20px;
            background: #0b5ed7;
        }

        .sidebar-label {
            padding: 15px 20px;
            font-size: 12px;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.6);
            font-weight: 700;
        }

        #sidebar ul li a {
            padding: 15px 20px;
            display: block;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
        }

        #sidebar ul li.active>a {
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
            font-weight: 600;
            border-left: 4px solid #fff;
        }

        .content {
            width: 100%;
            padding: 20px;
        }

        .logout-btn {
            background-color: #dc3545 !important;
            color: white !important;
            margin: 10px 20px;
            border-radius: 5px;
            text-align: center;
        }

        .main-footer {
            position: fixed;
            bottom: 0;
            right: 0;
            /* Lebar footer adalah 100% dikurangi lebar sidebar (250px) */
            width: calc(100% - 250px);
            background-color: #ffffff;
            padding: 15px 0;
            border-top: 1px solid #dee2e6;
            text-align: center;
            /* Mengetengahkan teks */
            z-index: 999;
        }

        .main-footer p {
            margin: 0;
            color: #6c757d;
            font-weight: 500;
        }

        /* Pastikan konten utama tidak tertutup footer */
        .content {
            padding-bottom: 80px !important;
        }

        /* Pengaturan untuk layar HP (Sidebar biasanya tersembunyi/di atas) */
        @media (max-width: 768px) {
            .main-footer {
                width: 100%;
            }
        }

        .submenu {
    background: rgba(255, 255, 255, 0.1);
    margin-top: 5px;
    border-radius: 5px;
}
.submenu li a {
    font-size: 0.9em;
    padding: 8px 15px !important;
    display: block;
    color: #fff;
    text-decoration: none;
}
.submenu li a:hover {
    background: rgba(255, 255, 255, 0.2);
}
    </style>
</head>

<body>
    <div class="wrapper">