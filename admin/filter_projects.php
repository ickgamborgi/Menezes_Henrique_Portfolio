<?php
// filepath: /Applications/MAMP/htdocs/Menezes_Henrique_Portfolio/admin/filter_projects.php

require_once('../includes/connect.php'); // Include the database connection

// Get the filter sent via POST (or set to 'all' by default)
$filterTag = isset($_POST['filterTag']) ? $_POST['filterTag'] : 'all';

try {
    // Base SQL query
    $sql = 'SELECT project.id AS id, thumb, title, subtitle, date, areas, recap FROM project';

    // Add the WHERE clause if the filter is not "all"
    if ($filterTag !== 'all') {
        $sql .= ' WHERE areas LIKE :filterTag';
    }

    $sql .= ' ORDER BY date DESC'; // Order the projects by date

    // Prepare the query
    $stmt = $connect->prepare($sql);

    // If the filter is not "all", bind the parameter
    if ($filterTag !== 'all') {
        $stmt->bindValue(':filterTag', "%$filterTag%", PDO::PARAM_STR);
    }

    // Execute the query
    $stmt->execute();

    // Fetch the results
    $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Send the data as a JSON response
    header('Content-Type: application/json');
    echo json_encode($projects);
} catch (PDOException $e) {
    // Display an error message in case of database failure
    echo '<p class="error">Error fetching projects: ' . htmlspecialchars($e->getMessage()) . '</p>';
}
?>
