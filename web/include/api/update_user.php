<?
include "functions.php";
session_start();

function update_user(int $id, array $data): bool {
    $con = DBconnect();

    // At least one updatable field required
    $allowed = ['name', 'surname', 'document', 'phone', 'address', 'floor', 'password'];
    $fields = [];
    $types  = '';
    $values = [];

    foreach ($allowed as $key) {
        if (array_key_exists($key, $data) && $data[$key] !== '') {
            if ($key === 'password') {
                // hash password if provided
                $fields[] = 'password = ?';
                $types   .= 's';
                $values[] = hash('sha256', $data[$key]);
            } else {
                $fields[] = "$key = ?";
                $types   .= 's';
                $values[] = $data[$key];
            }
        }

        if (empty($fields)) {
            // nothing to update
            return false;
        }

        $fields[] = 'updated_at = UNIX_TIMESTAMP()';

        $set_sql = implode(', ', $fields);
        $sql = "UPDATE users SET $set_sql WHERE id = ? LIMIT 1";

        $stmt = $con->prepare($sql);
        if ($stmt === false) {
            return false;
        }

        $types .= 'i';
        $values[] = $id;

        $bind_names[] = $types;
        for ($i = 0; $i < count($values); $i++) {
            $bind_names[] = &$values[$i];
        }

        call_user_func_array([$stmt, 'bind_param'], $bind_names);

        if ($stmt->execute()) {
            return $stmt->affected_rows >= 0;
        }

        return false;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $raw = file_get_contents('php://input');
    $body = json_decode($raw, true);

    header('Content-Type: application/json');

    $is_success = update_user($_SESSION['user_id'], $body);

    if ($is_success) {
        echo json_encode([
            'success' => true, 
        ]);
    } else {
        echo json_encode([
            'success' => false, 
        ]);
    }
}

?>