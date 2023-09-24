<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>control panel page</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <nav class="navbar">
    <h2 class="logo">Control Panel</h2>
  </nav>

  <div class="content" id="in_content">
    <input type="submit" onclick="<?php header('location: home.php'); ?>" value="Home">
    <input type="submit" onclick="<?php header('location: candidates.php'); ?>" value="Candidates">
    <input type="submit" onclick="<?php header('location: add_candidate.php'); ?>" value="Add Candidate">
    <input type="submit" onclick="<?php header('location: del_candidate.php'); ?>" value="Del Candidate">
    <input type="submit" onclick="<?php header('location: voters.php'); ?>" value="Voters">
    <input type="submit" onclick="<?php header('location: add_voter.php'); ?>" value="Add Voter">
    <input type="submit" onclick="<?php header('location: del_voter.php'); ?>" value="Del Voter">
    <input type="submit" onclick="<?php header('location: voting.php'); ?>" value="Voting">
    <input type="submit" onclick="<?php header('location: add_admin.php'); ?>" value="Add Admin">
    <input type="submit" onclick="<?php header('location: result.php'); ?>" value="Result">
    <input type="submit" onclick="<?php header('location: date_time.php'); ?>" value="Date & Time">
    <input type="submit" onclick="<?php header('location: logout.php'); ?>" value="Logout">
  </div>

  <div id="continer">