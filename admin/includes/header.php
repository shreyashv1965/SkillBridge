<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SkillBridge | Admin Panel</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="/SkillBridge/assets/css/bootstrap.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="/SkillBridge/assets/css/font-awesome.css">

    <!-- Common CSS -->
    <link rel="stylesheet" href="/SkillBridge/assets/css/style.css">

    <!-- Admin CSS -->
    <link rel="stylesheet" href="/SkillBridge/assets/css/admin.css">

    <style>

        body{
            background:#f4f6f9;
            margin:0;
            padding:0;
        }

        /* ===========================
           ADMIN HEADER
        =========================== */

        .top-navbar{
            background:#34495E;
            padding:15px 0;
            box-shadow:0 2px 8px rgba(0,0,0,.15);
        }

        .brand-link{
            display:flex;
            align-items:center;
            text-decoration:none;
            color:#fff;
        }

        .brand-link:hover{
            text-decoration:none;
            color:#fff;
        }

        .brand-logo{
            height:65px;
            width:auto;
            margin-right:15px;
        }

        .brand-title{
            font-size:28px;
            font-weight:bold;
            color:#fff;
            line-height:1.1;
        }

        .sub-title{
            font-size:14px;
            color:#dcdcdc;
        }

        /* ===========================
           CONTENT
        =========================== */

        .content-wrapper{
            min-height:550px;
            padding:30px 0;
        }

    </style>

</head>

<body>

<!-- ===========================
     HEADER
=========================== -->

<div class="top-navbar">

    <div class="container">

        <a href="/SkillBridge/admin/dashboard.php" class="brand-link">

            <img src="/SkillBridge/assets/img/logo.png"
                 alt="SkillBridge Logo"
                 class="brand-logo">

            <div>

                <div class="brand-title">
                    SkillBridge
                </div>

                <div class="sub-title">
                    Online Course Registration System
                </div>

            </div>

        </a>

    </div>

</div>

<!-- ===========================
     PAGE CONTENT START
=========================== -->

<div class="content-wrapper">

