<?php
/*
 * Copy to conn.php and fill in. conn.php is gitignored.
 *
 * The original 2021 version of this file hard-coded a live Amazon RDS
 * endpoint, username and password, and was committed to the repository.
 * See "What I'd fix" in the README — credentials belong in environment
 * variables, not in source control.
 */

$server = getenv('OCP_DB_HOST') ?: '127.0.0.1';
$user   = getenv('OCP_DB_USER') ?: 'ocp';
$pass   = getenv('OCP_DB_PASS') ?: '';
$db     = getenv('OCP_DB_NAME') ?: 'ocp_tracker';

$link = mysqli_connect($server, $user, $pass, $db);

if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
