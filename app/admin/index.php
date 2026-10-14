<?php

require '../../config/config.php';

requireRole('admin');

// Determine current section
$section = $_GET['section'] ?? 'activity-logs';

// Determine CRUD Operation
$action = $_GET['action'] ?? '';

// Fetch data based on current section
if ($section === 'activity-logs') {

    // Activity Logs Query
    $stmt = $pdo->query("
        SELECT *
        FROM activity_logs
        ORDER BY activity_log_created_at DESC
    ");

    $activities = $stmt->fetchAll(PDO::FETCH_ASSOC);

} elseif ($section === 'user-sessions') {

    // User Sessions Query
    $stmt = $pdo->query("
        SELECT
            us.session_id,
            us.user_id,
            u.user_username,
            u.user_email,
            u.user_role,
            us.session_start,
            us.session_end,
            us.session_duration
        FROM user_sessions us
        INNER JOIN users u
            ON us.user_id = u.user_id
        ORDER BY us.session_start DESC
    ");

    $sessions = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Activity Logs</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f5f5f5;
            color: #333;
            padding: 30px;
        }

        .container {
            max-width: 1400px;
            margin: auto;
        }

        /* HEADER */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .header h1 {
            font-size: 26px;
            color: #222;
        }

        .header p {
            margin-top: 5px;
            color: #777;
            font-size: 14px;
        }

        .signout {
            text-decoration: none;
            background: #222;
            color: white;
            padding: 9px 16px;
            border-radius: 6px;
            font-size: 14px;
        }

        .signout:hover {
            background: #444;
        }

        /* TABLE CARD */
        .table-card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #ddd;
        }

        .table-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .table-title h2 {
            font-size: 18px;
        }

        .records {
            color: #777;
            font-size: 13px;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 1000px;
        }

        th {
            background: #222;
            color: white;
            padding: 12px;
            text-align: left;
            font-size: 13px;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #eee;
            font-size: 13px;
        }

        tbody tr:hover {
            background: #fafafa;
        }

        /* ACTION */
        .action {
            background: #f0f0f0;
            padding: 5px 8px;
            border-radius: 4px;
            font-size: 12px;
        }

        /* STATUS */
        .status {
            padding: 5px 9px;
            border-radius: 4px;
            font-size: 12px;
        }

        .success {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .failed {
            background: #ffebee;
            color: #c62828;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            color: #999;
            font-size: 12px;
        }

    </style>

</head>

<body>

<div class="container">

    <!-- HEADER -->
    <div class="header">

        <div>
            <h1>Activity Logs</h1>
        </div>

        <a href="../../auth/signout.php" class="signout">
            Sign Out
        </a>

    </div>

<nav>
        <a href="index.php?section=activity-logs">Activity Logs |</a>
        <a href="index.php?section=user-sessions">User Sessions |</a>
        
    </nav>

  <?php if ($section === 'activity-logs'): ?>

    <!-- TABLE -->
    <div class="table-card">

        <div class="table-title">

            <h2>All Activity Logs</h2>

            <span class="records">
                <?= count($activities) ?> Records
            </span>

        </div>


        <div class="table-wrapper">

            <table>

                <thead>
                    <tr>
                        <th>Record ID</th>
                        <th>User ID</th>
                        <th>User Email</th>
                        <th>Action</th>
                        <th>Status</th>
                        <th>IP Address</th>
                        <th>User Agent</th>
                        <th>Date & Time</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach($activities as $activity): ?>

                    <tr>

                        <td>
                            <?= htmlspecialchars($activity['activity_logger_id']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($activity['user_id']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($activity['user_email']) ?>
                        </td>

                        <td>
                            <span class="action">
                                <?= htmlspecialchars($activity['activity_log_action']) ?>
                            </span>
                        </td>

                        <td>

                            <?php
                            $status = strtolower($activity['activity_log_status']);
                            ?>

                            <span class="status <?= $status ?>">
                                <?= htmlspecialchars($activity['activity_log_status']) ?>
                            </span>

                        </td>

                        <td>
                            <?= htmlspecialchars($activity['activity_log_ip_address']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($activity['activity_log_user_agent']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($activity['activity_log_created_at']) ?>
                         </td>
                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    <?php endif; ?>

     <?php if ($section === 'user-sessions'): ?>

        <h4>User Sessions</h4>

        <table id="sessionTable" border="1" cellpadding="5" cellspacing="0">

            <thead>
                <tr>
                    <th>Session ID</th>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Session Start</th>
                    <th>Session End</th>
                    <th>Duration</th>
                </tr>
            </thead>

            <tbody>

                <?php foreach ($sessions as $session): ?>

                    <tr>

                        <td>
                            <?= htmlspecialchars($session['session_id']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($session['user_id']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($session['user_username']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($session['user_email']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($session['user_role']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($session['session_start']) ?>
                        </td>

                        <td>
                            <?= $session['session_end']
                                ? htmlspecialchars($session['session_end'])
                                : 'Active'
                            ?>
                        </td>

                        <td>

                            <?php

                            if ($session['session_duration'] !== null) {

                                $seconds = (int) $session['session_duration'];

                                $hours = floor($seconds / 3600);
                                $minutes = floor(($seconds % 3600) / 60);
                                $seconds = $seconds % 60;

                                echo sprintf(
                                    '%02d hr %02d min %02d sec',
                                    $hours,
                                    $minutes,
                                    $seconds
                                );

                            } else {

                                echo 'Active';

                            }

                            ?>

                        </td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    <?php endif; ?>
</body>
</html>