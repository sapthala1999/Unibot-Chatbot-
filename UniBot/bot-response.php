<?php
header('Content-Type: application/json');

$data = json_decode(file_get_contents("traning.json"), true);
$message = strtolower(trim($_POST['message'] ?? ''));

$university_keywords = ['university', 'vertex', 'admission', 'course', 'program', 'fee', 'faculty', 'location', 'history', 'contact', 'library', 'facility', 'requirement'];

$found = false;
foreach ($university_keywords as $kw) {
    if (strpos($message, $kw) !== false) {
        $found = true;
        break;
    }
}

if (!$found) {
    echo json_encode(["status" => "success", "reply" => "Please ask only questions related to Vertex University."]);
    exit;
}

function getAnswer($msg, $data) {
    if (strpos($msg, "admission") !== false) {
        return "Admission deadlines: " . $data["admissions"]["deadlines"] .
               ". Requirements: " . $data["admissions"]["requirements"];
    }

    if (strpos($msg, "contact") !== false) {
        return "Phone: " . $data["contact"]["phone"] .
               ", Email: " . $data["contact"]["email"];
    }

    if (strpos($msg, "faculty") !== false) {
        return "Faculties include: " . implode(", ", $data["faculties"]);
    }

    if (strpos($msg, "location") !== false) {
        return "Vertex University is located at: " . $data["location"];
    }

    if (strpos($msg, "course") !== false || strpos($msg, "program") !== false) {
        return "Programs offered: " . implode(", ", array_map(function($p) {
            return $p['name'];
        }, $data["programs"]));
    }

    return null;
}

$reply = getAnswer($message, $data);
if ($reply) {
    echo json_encode(["status" => "success", "reply" => $reply]);
} else {
    echo json_encode(["status" => "fallback"]);
}
?>