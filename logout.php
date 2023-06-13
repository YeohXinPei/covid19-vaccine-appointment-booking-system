<?php

session_start();// to ensure using same session
session_unset();
session_destroy();// destroy the session

header("Location: index.php");// redirect back to index.php after logging out