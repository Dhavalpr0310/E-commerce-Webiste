<?php
include './common/class.php';
session_destroy();
echo "<script>alert('You have been logout successfully');window.location='index.php';</script>";
