<?php
function getCategoriesByGender($conn, $gender) {
    $stmt = $conn->prepare("SELECT id, category_name FROM categories WHERE gender = ? ORDER BY category_name ASC");
    $stmt->bind_param("s", $gender);
    $stmt->execute();
    $result = $stmt->get_result();
    $categories = [];
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }
    $stmt->close();
    return $categories;
}