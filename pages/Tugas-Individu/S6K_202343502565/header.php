<?php
    // Deteksi file yang sedang aktif, dipakai menu.php untuk highlight menu
    $current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tugas PHP - Bagus Taufik N H | 202343502565</title>
    <style>
        :root{
            --primary:#6366f1;
            --primary-dark:#4338ca;
            --primary-light:#818cf8;
            --accent:#22d3ee;
            --bg:#f1f3fb;
            --sidebar-bg:#171334;
            --sidebar-bg2:#241d54;
            --card-bg:#ffffff;
            --text-dark:#1e1b3a;
            --text-muted:#6b7280;
            --border:#e6e8f0;
            --success:#10b981;
            --warning:#f59e0b;
            --danger:#ef4444;
            --radius:14px;
            --shadow:0 4px 18px rgba(30,27,75,0.08);
            --shadow-hover:0 10px 28px rgba(30,27,75,0.14);
        }

        *{ box-sizing:border-box; }

        body{
            font-family:'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            margin:0;
            background:var(--bg);
            color:var(--text-dark);
            -webkit-font-smoothing:antialiased;
        }

        a{ text-decoration:none; color:inherit; }

        .layout{
            display:flex;
            min-height:100vh;
            align-items:flex-start;
        }

        /* ================= SIDEBAR ================= */
        .sidebar{
            width:280px;
            min-width:280px;
            background:linear-gradient(180deg, var(--sidebar-bg) 0%, var(--sidebar-bg2) 100%);
            color:#e5e7ff;
            min-height:100vh;
            position:sticky;
            top:0;
            padding:26px 18px 40px;
            overflow-y:auto;
        }

        .profile-card{
            background:rgba(255,255,255,0.06);
            border:1px solid rgba(255,255,255,0.12);
            border-radius:var(--radius);
            padding:20px 16px;
            text-align:center;
            margin-bottom:26px;
        }

        .profile-card img{
            width:78px;
            height:78px;
            object-fit:cover;
            border-radius:50%;
            border:3px solid var(--accent);
            margin-bottom:10px;
            background:#fff;
        }

        .profile-card h3{
            margin:4px 0 2px;
            font-size:15.5px;
            color:#fff;
            font-weight:600;
        }

        .profile-card .npm{
            display:inline-block;
            font-size:12px;
            letter-spacing:.5px;
            background:rgba(34,211,238,0.15);
            color:var(--accent);
            padding:3px 10px;
            border-radius:999px;
            margin-top:6px;
            font-weight:600;
        }

        .profile-card .kelas{
            font-size:12px;
            color:#b6b3e0;
            margin-top:6px;
        }

        .nav-section{ margin-bottom:22px; }

        .nav-section-title{
            font-size:11px;
            text-transform:uppercase;
            letter-spacing:1.2px;
            color:#8f8ac2;
            font-weight:700;
            margin:0 0 10px 6px;
            display:flex;
            align-items:center;
            gap:6px;
        }

        .nav-section ul{
            list-style:none;
            margin:0;
            padding:0;
            display:flex;
            flex-direction:column;
            gap:3px;
        }

        .nav-section li a{
            display:flex;
            align-items:center;
            gap:9px;
            font-size:13.5px;
            color:#d5d3f3;
            padding:9px 12px;
            border-radius:9px;
            transition:all .15s ease;
            border:1px solid transparent;
        }

        .nav-section li a:hover{
            background:rgba(255,255,255,0.08);
            color:#fff;
            transform:translateX(2px);
        }

        .nav-section li a.active{
            background:linear-gradient(90deg, var(--primary) 0%, var(--primary-light) 100%);
            color:#fff;
            font-weight:600;
            box-shadow:0 4px 12px rgba(99,102,241,0.4);
            border-color:rgba(255,255,255,0.15);
        }

        .nav-section li a .dot{
            width:6px;
            height:6px;
            border-radius:50%;
            background:#7b76b8;
            flex-shrink:0;
        }

        .nav-section li a.active .dot{ background:#fff; }

        /* ================= MAIN CONTENT ================= */
        .main{
            flex:1;
            padding:32px 36px 60px;
            min-width:0;
        }

        .topbar{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:22px;
            flex-wrap:wrap;
            gap:10px;
        }

        .topbar .brand{
            font-size:13px;
            color:var(--text-muted);
            font-weight:600;
            letter-spacing:.3px;
        }

        .topbar .brand b{ color:var(--primary-dark); }

        .badge-course{
            background:#fff;
            border:1px solid var(--border);
            box-shadow:var(--shadow);
            padding:7px 14px;
            border-radius:999px;
            font-size:12px;
            font-weight:600;
            color:var(--primary-dark);
        }

        /* Content card - dipakai semua halaman (.image-container = alias lama) */
        .image-container,
        .content-card{
            background:var(--card-bg);
            border:1px solid var(--border);
            border-radius:var(--radius);
            box-shadow:var(--shadow);
            padding:30px 32px;
            animation:fadeIn .35s ease;
        }

        @keyframes fadeIn{
            from{ opacity:0; transform:translateY(6px); }
            to{ opacity:1; transform:translateY(0); }
        }

        .image-container h2,
        .content-card h2{
            margin-top:0;
            font-size:23px;
            color:var(--text-dark);
            padding-bottom:14px;
            border-bottom:2px solid var(--border);
            margin-bottom:18px;
            display:flex;
            align-items:center;
            gap:10px;
        }

        .image-container h3, .content-card h3{ color:var(--primary-dark); }

        .profile-img{
            width:110px;
            height:110px;
            object-fit:cover;
            border-radius:50%;
            border:4px solid var(--primary-light);
            box-shadow:var(--shadow);
            margin-bottom:14px;
        }

        /* Output box seragam untuk tampilkan hasil echo/print PHP */
        .output-box{
            background:#0f172a;
            color:#e2e8f0;
            border-radius:10px;
            padding:18px 20px;
            font-family:'Consolas','Courier New',monospace;
            font-size:14.5px;
            line-height:1.7;
            overflow-x:auto;
            border:1px solid #1e293b;
            box-shadow:inset 0 0 0 1px rgba(255,255,255,0.03);
        }

        .output-box .lbl{
            display:inline-block;
            background:var(--success);
            color:#04240f;
            font-size:10.5px;
            font-weight:800;
            letter-spacing:.6px;
            text-transform:uppercase;
            padding:2px 9px;
            border-radius:6px;
            margin-bottom:10px;
        }

        .info-box{
            background:#eef2ff;
            border-left:4px solid var(--primary);
            padding:14px 18px;
            border-radius:8px;
            margin:16px 0;
            font-size:14px;
            color:#312e81;
        }

        .warn-box{
            background:#fff8e1;
            border:1px solid #ffe4a3;
            border-left:4px solid var(--warning);
            padding:14px 18px;
            border-radius:8px;
            margin-top:22px;
            font-size:14px;
            color:#7a5b00;
        }

        .tag{
            display:inline-block;
            font-size:11px;
            font-weight:700;
            letter-spacing:.4px;
            text-transform:uppercase;
            padding:4px 11px;
            border-radius:999px;
            margin-bottom:14px;
        }
        .tag-dasar{ background:#e0e7ff; color:#4338ca; }
        .tag-logika{ background:#dcfce7; color:#15803d; }
        .tag-fungsi{ background:#ffedd5; color:#c2410c; }
        .tag-form{ background:#fce7f3; color:#be185d; }

        p{ line-height:1.65; color:#374151; }
        code{
            background:#f1f0fb;
            color:var(--primary-dark);
            padding:2px 7px;
            border-radius:5px;
            font-size:13px;
            font-family:'Consolas','Courier New',monospace;
        }

        /* Form styling */
        form{
            background:#f8f9ff;
            border:1px solid var(--border);
            border-radius:10px;
            padding:18px 20px;
            margin-bottom:20px;
        }
        form label, form{ font-size:14.5px; color:#374151; }
        input[type=text], input[type=number]{
            border:1px solid #d1d5db;
            border-radius:8px;
            padding:9px 12px;
            font-size:14px;
            margin:0 8px;
            outline:none;
            transition:border .15s ease;
        }
        input[type=text]:focus, input[type=number]:focus{
            border-color:var(--primary);
            box-shadow:0 0 0 3px rgba(99,102,241,0.15);
        }
        button, input[type=submit]{
            background:linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color:#fff;
            border:none;
            padding:9px 20px;
            border-radius:8px;
            font-size:14px;
            font-weight:600;
            cursor:pointer;
            box-shadow:0 4px 10px rgba(99,102,241,0.35);
            transition:transform .12s ease;
        }
        button:hover, input[type=submit]:hover{ transform:translateY(-1px); }

        table{ border-collapse:collapse; }
        .image-container table, .content-card table{
            width:100%;
            margin-top:14px;
            border-radius:8px;
            overflow:hidden;
        }
        .image-container table td, .image-container table th,
        .content-card table td, .content-card table th{
            border:1px solid var(--border);
            padding:10px 12px;
            font-size:13.5px;
        }
        .image-container table tr:nth-child(even),
        .content-card table tr:nth-child(even){ background:#f8f9ff; }

        footer.site-footer{
            text-align:center;
            font-size:12px;
            color:#9ca3af;
            margin-top:26px;
        }

        @media (max-width: 860px){
            .layout{ flex-direction:column; }
            .sidebar{ width:100%; min-width:100%; position:relative; min-height:auto; }
            .main{ padding:22px 18px 40px; }
        }
    </style>
</head>
<body>
<div class="layout">
