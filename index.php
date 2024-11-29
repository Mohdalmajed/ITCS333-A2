<?php
// Student Info:
// Name: Mohammed Mansoor Ebrahim | ID:202209552 | Section: 9 | Assignment #2

// URL of the API endpoint
$url = 'https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?where=colleges%20like%20%22IT%22%20AND%20the_programs%20like%20%22bachelor%22&limit=100';

// Use file_get_contents to fetch data from the API
$response = file_get_contents($url);

// Check if the response is valid
if ($response === FALSE) {
    die('Error occurred while fetching data.');
}

// Decode the JSON response into an associative array
$data = json_decode($response, true);

// Check if the data was decoded successfully
if ($data === NULL) {
    die('Error decoding JSON data.');
}

// Below is the HTML Code to display data in a table after retrival and using pico css ->
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bahrain Students Data</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
</head>

<body>
    <div class="container">
        <br />
        <h1>University of Bahrain Students Enrollment by Nationality</h1>
        <br />

        <!-- Table to display the data while ensuring its responsiveness -->
        <div class="overflow-auto">
            <table class="striped">
                <thead data-theme="dark">
                    <tr>
                        <th>Year</th>
                        <th>Semester</th>
                        <th>The Programs</th>
                        <th>Nationality</th>
                        <th>Colleges</th>
                        <th>Number of Students</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Loop through the data and display each record
                    foreach ($data['results'] as $record) {
                        // Safely extract each field using htmlspecialchars
                        $year = htmlspecialchars($record['year']);
                        $semester = htmlspecialchars($record['semester']);
                        $program = htmlspecialchars($record['the_programs']);
                        $nationality = htmlspecialchars($record['nationality']);
                        $college = htmlspecialchars($record['colleges']);
                        $num_students = htmlspecialchars($record['number_of_students']);

                        // Display data in table row
                        echo "<tr>";
                        echo "<td>{$year}</td>";
                        echo "<td>{$semester}</td>";
                        echo "<td>{$program}</td>";
                        echo "<td>{$nationality}</td>";
                        echo "<td>{$college}</td>";
                        echo "<td>{$num_students}</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>