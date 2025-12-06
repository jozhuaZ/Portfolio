<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized access']);
    exit;
}

// Include database connection
require_once './connect.php';
$conn = connect();

if (!$conn) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit;
}

header('Content-Type: application/json');

// Get action from request
$action = isset($_GET['action']) ? $_GET['action'] : (isset($_POST['action']) ? $_POST['action'] : '');

try {
    switch ($action) {
        case 'get_form':
            $section = $_GET['section'] ?? '';
            echo json_encode(getFormHTML($section, $conn));
            break;

        case 'get_edit_form':
            $section = $_GET['section'] ?? '';
            $id = $_GET['id'] ?? 0;
            echo json_encode(getEditFormHTML($section, $id, $conn));
            break;

        case 'get_add_form':
            $section = $_GET['section'] ?? '';
            echo json_encode(getAddFormHTML($section));
            break;

        case 'update':
            echo json_encode(handleUpdate($_POST, $conn));
            break;

        case 'insert':
            echo json_encode(handleInsert($_POST, $conn));
            break;

        case 'delete':
            $section = $_POST['section'] ?? '';
            $id = $_POST['id'] ?? 0;
            echo json_encode(handleDelete($section, $id, $conn));
            break;

        default:
            echo json_encode(['success' => false, 'message' => 'Invalid action']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
} finally {
    if ($conn) {
        mysqli_close($conn);
    }
}

// ============================
// GET FORM HTML FUNCTIONS
// ============================

function getFormHTML($section, $conn)
{
    switch ($section) {
        case 'admin':
            return getPersonalInfoForm($conn);
        case 'education':
            return getEducationList($conn);
        case 'tech_stack':
            return getTechStackList($conn);
        case 'project':
            return getProjectList($conn);
        default:
            return ['success' => false, 'message' => 'Invalid section'];
    }
}

// ============================
// PERSONAL INFO SECTION
// ============================

function getPersonalInfoForm($conn)
{
    // Get logged in user's email from session
    $email = $_SESSION['email'] ?? '';

    if (!$email) {
        return ['success' => false, 'message' => 'No user email in session'];
    }

    $stmt = mysqli_prepare($conn, "SELECT * FROM admin WHERE email = ? LIMIT 1");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $data = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);

    if (!$data) {
        return ['success' => false, 'message' => 'User not found'];
    }

    $html = '
    <h3 style="color: #ffffff; margin-bottom: 20px;">Edit Personal Information</h3>
    <form class="admin-form" enctype="multipart/form-data">
        <input type="hidden" name="action" value="update">
        <input type="hidden" name="section" value="admin">
        <input type="hidden" name="email" value="' . htmlspecialchars($data['email']) . '">
        
        <div class="form-group">
            <label>Full Name</label>
            <input type="text" name="name" value="' . htmlspecialchars($data['name'] ?? '') . '" required>
        </div>
        
        <div class="form-group">
            <label>Email (Primary Key - Cannot Change)</label>
            <input type="email" value="' . htmlspecialchars($data['email']) . '" disabled style="opacity: 0.6; cursor: not-allowed;">
        </div>
        
        <div class="form-group">
            <label>Bio (Short Description)</label>
            <input type="text" name="bio" value="' . htmlspecialchars($data['bio'] ?? '') . '" required>
        </div>
        
        <div class="form-group">
            <label>Description (Long)</label>
            <textarea name="description" rows="5" required>' . htmlspecialchars($data['description'] ?? '') . '</textarea>
        </div>
        
        <div class="form-group">
            <label>Contact Number</label>
            <input type="tel" name="contact_no" value="' . htmlspecialchars($data['contact_no'] ?? '') . '" required>
        </div>
        
        <div class="form-group">
            <label>First Image (Profile Photo)</label>
            <input type="file" name="first_image" accept="image/*">
            ' . (isset($data['first_image']) && $data['first_image'] ? '<p style="font-size: 12px; color: #94a3b8;">Current: ' . htmlspecialchars($data['first_image']) . '</p>' : '') . '
        </div>
        
        <div class="form-group">
            <label>Second Image (Background/Banner)</label>
            <input type="file" name="second_image" accept="image/*">
            ' . (isset($data['second_image']) && $data['second_image'] ? '<p style="font-size: 12px; color: #94a3b8;">Current: ' . htmlspecialchars($data['second_image']) . '</p>' : '') . '
        </div>
        
        <div class="form-group">
            <label>Facebook Link</label>
            <input type="url" name="facebook_link" value="' . htmlspecialchars($data['facebook_link'] ?? '') . '">
        </div>
        
        <div class="form-group">
            <label>GitHub Link</label>
            <input type="url" name="github_link" value="' . htmlspecialchars($data['github_link'] ?? '') . '">
        </div>
        
        <button type="submit" class="admin-btn admin-btn-primary">Save Changes</button>
    </form>';

    return ['success' => true, 'html' => $html];
}

// ============================
// EDUCATION SECTION
// ============================

function getEducationList($conn)
{
    $query = "SELECT * FROM education ORDER BY end_year DESC";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        return ['success' => false, 'message' => 'Query failed: ' . mysqli_error($conn)];
    }

    $html = '<h3 style="color: #ffffff; margin-bottom: 20px;">Education</h3>';
    $html .= '<button class="admin-btn admin-btn-success add-new-btn" data-section="education" style="margin-bottom: 20px;">+ Add New Education</button>';
    $html .= '<div class="admin-item-list">';

    if (mysqli_num_rows($result) == 0) {
        $html .= '<p style="text-align: center; color: #94a3b8; padding: 20px;">No education records found.</p>';
    }

    while ($row = mysqli_fetch_assoc($result)) {
        $html .= '
        <div class="admin-item">
            <div class="admin-item-info">
                <h4>' . htmlspecialchars($row['title']) . '</h4>
                <p>' . htmlspecialchars($row['school']) . ' | ' . $row['start_year'] . ' - ' . $row['end_year'] . '</p>
            </div>
            <div class="admin-item-actions">
                <button class="admin-btn admin-btn-primary admin-btn-sm edit-btn" data-section="education" data-id="' . $row['id'] . '">Edit</button>
                <button class="admin-btn admin-btn-danger admin-btn-sm delete-btn" data-section="education" data-id="' . $row['id'] . '">Delete</button>
            </div>
        </div>';
    }

    $html .= '</div>';

    return ['success' => true, 'html' => $html];
}

function getEducationEditForm($id, $conn)
{
    $stmt = mysqli_prepare($conn, "SELECT * FROM education WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $data = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);

    if (!$data) {
        return ['success' => false, 'message' => 'Education record not found'];
    }

    $html = '
    <h3 style="color: #ffffff; margin-bottom: 20px;">Edit Education</h3>
    <form class="admin-form">
        <input type="hidden" name="action" value="update">
        <input type="hidden" name="section" value="education">
        <input type="hidden" name="id" value="' . $data['id'] . '">
        
        <div class="form-group">
            <label>Degree/Title</label>
            <input type="text" name="title" value="' . htmlspecialchars($data['title']) . '" required>
        </div>
        
        <div class="form-group">
            <label>School/Institution</label>
            <input type="text" name="school" value="' . htmlspecialchars($data['school']) . '" required>
        </div>
        
        <div class="form-group">
            <label>School Address</label>
            <input type="text" name="school_address" value="' . htmlspecialchars($data['school_address']) . '" required>
        </div>
        
        <div class="form-group">
            <label>Start Year</label>
            <input type="number" name="start_year" value="' . $data['start_year'] . '" required>
        </div>
        
        <div class="form-group">
            <label>End Year</label>
            <input type="number" name="end_year" value="' . $data['end_year'] . '" required>
        </div>
        
        <div style="display: flex; gap: 10px;">
            <button type="submit" class="admin-btn admin-btn-primary">Update</button>
            <button type="button" class="admin-btn admin-btn-secondary cancel-btn" data-section="education">Cancel</button>
        </div>
    </form>';

    return ['success' => true, 'html' => $html];
}

// ============================
// TECH STACK SECTION
// ============================

function getTechStackList($conn)
{
    $query = "SELECT * FROM tech_stack ORDER BY type, name";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        return ['success' => false, 'message' => 'Query failed: ' . mysqli_error($conn)];
    }

    $html = '<h3 style="color: #ffffff; margin-bottom: 20px;">Tech Stack</h3>';
    $html .= '<button class="admin-btn admin-btn-success add-new-btn" data-section="tech_stack" style="margin-bottom: 20px;">+ Add New Technology</button>';
    $html .= '<div class="admin-item-list">';

    if (mysqli_num_rows($result) == 0) {
        $html .= '<p style="text-align: center; color: #94a3b8; padding: 20px;">No tech stack records found.</p>';
    }

    while ($row = mysqli_fetch_assoc($result)) {
        $html .= '
        <div class="admin-item">
            <div class="admin-item-info">
                <h4>' . htmlspecialchars($row['name']) . '</h4>
                <p>Proficiency: ' . $row['percentage'] . '% | Type: ' . htmlspecialchars($row['type']) . '</p>
            </div>
            <div class="admin-item-actions">
                <button class="admin-btn admin-btn-primary admin-btn-sm edit-btn" data-section="tech_stack" data-id="' . $row['id'] . '">Edit</button>
                <button class="admin-btn admin-btn-danger admin-btn-sm delete-btn" data-section="tech_stack" data-id="' . $row['id'] . '">Delete</button>
            </div>
        </div>';
    }

    $html .= '</div>';

    return ['success' => true, 'html' => $html];
}

// ============================
// PROJECT SECTION
// ============================

function getProjectList($conn)
{
    $query = "SELECT * FROM project ORDER BY id DESC";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        return ['success' => false, 'message' => 'Query failed: ' . mysqli_error($conn)];
    }

    $html = '<h3 style="color: #ffffff; margin-bottom: 20px;">Projects</h3>';
    $html .= '<button class="admin-btn admin-btn-success add-new-btn" data-section="project" style="margin-bottom: 20px;">+ Add New Project</button>';
    $html .= '<div class="admin-item-list">';

    if (mysqli_num_rows($result) == 0) {
        $html .= '<p style="text-align: center; color: #94a3b8; padding: 20px;">No project records found.</p>';
    }

    while ($row = mysqli_fetch_assoc($result)) {
        $html .= '
        <div class="admin-item">
            <div class="admin-item-info">
                <h4>' . htmlspecialchars($row['title']) . '</h4>
                <p>' . htmlspecialchars(substr($row['short_desc'], 0, 60)) . '...</p>
            </div>
            <div class="admin-item-actions">
                <button class="admin-btn admin-btn-primary admin-btn-sm edit-btn" data-section="project" data-id="' . $row['id'] . '">Edit</button>
                <button class="admin-btn admin-btn-danger admin-btn-sm delete-btn" data-section="project" data-id="' . $row['id'] . '">Delete</button>
            </div>
        </div>';
    }

    $html .= '</div>';

    return ['success' => true, 'html' => $html];
}

// ============================
// GET EDIT FORM HTML
// ============================

function getEditFormHTML($section, $id, $conn)
{
    $id = intval($id);

    if ($section === 'education') {
        return getEducationEditForm($id, $conn);
    }

    if ($section === 'tech_stack') {
        $stmt = mysqli_prepare($conn, "SELECT * FROM tech_stack WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $data = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);

        if (!$data) {
            return ['success' => false, 'message' => 'Tech stack record not found'];
        }

        $html = '
        <h3 style="color: #ffffff; margin-bottom: 20px;">Edit Tech Stack</h3>
        <form class="admin-form" enctype="multipart/form-data">
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="section" value="tech_stack">
            <input type="hidden" name="id" value="' . $data['id'] . '">
            
            <div class="form-group">
                <label>Technology Name</label>
                <input type="text" name="name" value="' . htmlspecialchars($data['name']) . '" required>
            </div>
            
            <div class="form-group">
                <label>Proficiency (%)</label>
                <input type="number" name="percentage" value="' . $data['percentage'] . '" min="0" max="100" required>
            </div>
            
            <div class="form-group">
                <label>Image/Icon</label>
                <input type="file" name="image" accept="image/*">
                ' . (isset($data['image']) && $data['image'] ? '<p style="font-size: 12px; color: #94a3b8;">Current: ' . htmlspecialchars($data['image']) . '</p>' : '') . '
            </div>
            
            <div class="form-group">
                <label>Type</label>
                <select name="type" required>
                    <option style="color: black;" value="Core Technology" ' . ($data['type'] === 'Core Technology' ? 'selected' : '') . '>Core Technology</option>
                    <option style="color: black;" value="Framework & Libraries" ' . ($data['type'] === 'Framework & Libraries' ? 'selected' : '') . '>Framework & Libraries</option>
                    <option style="color: black;" value="Tools and Platforms" ' . ($data['type'] === 'Tools and Platforms' ? 'selected' : '') . '>Tools and Platforms</option>
                </select>
            </div>
            
            <div style="display: flex; gap: 10px;">
                <button type="submit" class="admin-btn admin-btn-primary">Update</button>
                <button type="button" class="admin-btn admin-btn-secondary cancel-btn" data-section="tech_stack">Cancel</button>
            </div>
        </form>';

        return ['success' => true, 'html' => $html];
    }

    if ($section === 'project') {
        $stmt = mysqli_prepare($conn, "SELECT * FROM project WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $data = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);

        if (!$data) {
            return ['success' => false, 'message' => 'Project record not found'];
        }

        $html = '
        <h3 style="color: #ffffff; margin-bottom: 20px;">Edit Project</h3>
        <form class="admin-form" enctype="multipart/form-data">
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="section" value="project">
            <input type="hidden" name="id" value="' . $data['id'] . '">
            
            <div class="form-group">
                <label>Project Title</label>
                <input type="text" name="title" value="' . htmlspecialchars($data['title']) . '" required>
            </div>
            
            <div class="form-group">
                <label>Project Image</label>
                <input type="file" name="image" accept="image/*">
                ' . (isset($data['image']) && $data['image'] ? '<p style="font-size: 12px; color: #94a3b8;">Current: ' . htmlspecialchars($data['image']) . '</p>' : '') . '
            </div>
            
            <div class="form-group">
                <label>Short Description</label>
                <textarea name="short_desc" rows="3" required>' . htmlspecialchars($data['short_desc']) . '</textarea>
            </div>
            
            <div class="form-group">
                <label>Long Description</label>
                <textarea name="long_desc" rows="6" required>' . htmlspecialchars($data['long_desc']) . '</textarea>
            </div>
            
            <div class="form-group">
                <label>Video URL (Optional)</label>
                <input type="url" name="vid" value="' . htmlspecialchars($data['vid'] ?? '') . '">
            </div>
            
            <div class="form-group">
                <label>Repository URL</label>
                <input type="url" name="repository" value="' . htmlspecialchars($data['repository']) . '" required>
            </div>
            
            <div style="display: flex; gap: 10px;">
                <button type="submit" class="admin-btn admin-btn-primary">Update</button>
                <button type="button" class="admin-btn admin-btn-secondary cancel-btn" data-section="project">Cancel</button>
            </div>
        </form>';

        return ['success' => true, 'html' => $html];
    }

    return ['success' => false, 'message' => 'Invalid section'];
}

// ============================
// ADD FORM HTML FUNCTIONS
// ============================

function getAddFormHTML($section)
{
    if ($section === 'education') {
        $html = '
        <h3 style="color: #ffffff; margin-bottom: 20px;">Add New Education</h3>
        <form class="admin-form">
            <input type="hidden" name="action" value="insert">
            <input type="hidden" name="section" value="education">
            
            <div class="form-group">
                <label>Degree/Title</label>
                <input type="text" name="title" required>
            </div>
            
            <div class="form-group">
                <label>School/Institution</label>
                <input type="text" name="school" required>
            </div>
            
            <div class="form-group">
                <label>School Address</label>
                <input type="text" name="school_address" required>
            </div>
            
            <div class="form-group">
                <label>Start Year</label>
                <input type="number" name="start_year" required>
            </div>
            
            <div class="form-group">
                <label>End Year</label>
                <input type="number" name="end_year" required>
            </div>
            
            <div style="display: flex; gap: 10px;">
                <button type="submit" class="admin-btn admin-btn-success">Add Education</button>
                <button type="button" class="admin-btn admin-btn-secondary cancel-btn" data-section="education">Cancel</button>
            </div>
        </form>';

        return ['success' => true, 'html' => $html];
    }

    if ($section === 'tech_stack') {
        $html = '
        <h3 style="color: #ffffff; margin-bottom: 20px;">Add New Technology</h3>
        <form class="admin-form" enctype="multipart/form-data">
            <input type="hidden" name="action" value="insert">
            <input type="hidden" name="section" value="tech_stack">
            
            <div class="form-group">
                <label>Technology Name</label>
                <input type="text" name="name" required>
            </div>
            
            <div class="form-group">
                <label>Proficiency (%)</label>
                <input type="number" name="percentage" min="0" max="100" required>
            </div>
            
            <div class="form-group">
                <label>Image/Icon</label>
                <input type="file" name="image" accept="image/*" required>
            </div>
            
            <div class="form-group">
                <label>Type</label>
                <select name="type" required>
                    <option style="color: black;" value="">Select Type</option>
                    <option style="color: black;" value="Core Technology">Core Technology</option>
                    <option style="color: black;" value="Framework & Libraries">Framework & Libraries</option>
                    <option style="color: black;" value="Tools and Platforms">Tools and Platforms</option>
                </select>
            </div>
            
            <div style="display: flex; gap: 10px;">
                <button type="submit" class="admin-btn admin-btn-success">Add Technology</button>
                <button type="button" class="admin-btn admin-btn-secondary cancel-btn" data-section="tech_stack">Cancel</button>
            </div>
        </form>';

        return ['success' => true, 'html' => $html];
    }

    if ($section === 'project') {
        $html = '
        <h3 style="color: #ffffff; margin-bottom: 20px;">Add New Project</h3>
        <form class="admin-form" enctype="multipart/form-data">
            <input type="hidden" name="action" value="insert">
            <input type="hidden" name="section" value="project">
            
            <div class="form-group">
                <label>Project Title</label>
                <input type="text" name="title" required>
            </div>
            
            <div class="form-group">
                <label>Project Image</label>
                <input type="file" name="image" accept="image/*" required>
            </div>
            
            <div class="form-group">
                <label>Short Description</label>
                <textarea name="short_desc" rows="3" required></textarea>
            </div>
            
            <div class="form-group">
                <label>Long Description</label>
                <textarea name="long_desc" rows="6" required></textarea>
            </div>
            
            <div class="form-group">
                <label>Video URL (Optional)</label>
                <input type="url" name="vid">
            </div>
            
            <div class="form-group">
                <label>Repository URL</label>
                <input type="url" name="repository" required>
            </div>
            
            <div style="display: flex; gap: 10px;">
                <button type="submit" class="admin-btn admin-btn-success">Add Project</button>
                <button type="button" class="admin-btn admin-btn-secondary cancel-btn" data-section="project">Cancel</button>
            </div>
        </form>';

        return ['success' => true, 'html' => $html];
    }

    return ['success' => false, 'message' => 'Invalid section'];
}

// ============================
// HANDLE UPDATE OPERATIONS
// ============================

function handleUpdate($data, $conn)
{
    $section = mysqli_real_escape_string($conn, $data['section']);

    if ($section === 'admin') {
        // Use EMAIL instead of ID for admin table
        $email = mysqli_real_escape_string($conn, $data['email']);
        return updatePersonalInfo($data, $conn, $email);
    } elseif ($section === 'education') {
        $id = intval($data['id']);
        return updateEducation($data, $conn, $id);
    } elseif ($section === 'tech_stack') {
        $id = intval($data['id']);
        return updateTechStack($data, $conn, $id);
    } elseif ($section === 'project') {
        $id = intval($data['id']);
        return updateProject($data, $conn, $id);
    }

    return ['success' => false, 'message' => 'Invalid section'];
}

function updatePersonalInfo($data, $conn, $email)
{
    $name = mysqli_real_escape_string($conn, $data['name']);
    $bio = mysqli_real_escape_string($conn, $data['bio']);
    $description = mysqli_real_escape_string($conn, $data['description']);
    $contact_no = mysqli_real_escape_string($conn, $data['contact_no']);
    $facebook_link = mysqli_real_escape_string($conn, $data['facebook_link']);
    $github_link = mysqli_real_escape_string($conn, $data['github_link']);

    // Use email as WHERE condition (primary key)
    $stmt = mysqli_prepare($conn, "UPDATE admin SET name = ?, bio = ?, description = ?, contact_no = ?, facebook_link = ?, github_link = ? WHERE email = ?");
    mysqli_stmt_bind_param($stmt, "sssssss", $name, $bio, $description, $contact_no, $facebook_link, $github_link, $email);

    // Handle first image upload
    if (isset($_FILES['first_image']) && $_FILES['first_image']['error'] === 0) {
        $first_image = uploadImage($_FILES['first_image'], 'profile');
        if ($first_image) {
            $stmt2 = mysqli_prepare($conn, "UPDATE admin SET first_image = ? WHERE email = ?");
            mysqli_stmt_bind_param($stmt2, "ss", $first_image, $email);
            mysqli_stmt_execute($stmt2);
            mysqli_stmt_close($stmt2);
        }
    }

    // Handle second image upload
    if (isset($_FILES['second_image']) && $_FILES['second_image']['error'] === 0) {
        $second_image = uploadImage($_FILES['second_image'], 'banner');
        if ($second_image) {
            $stmt3 = mysqli_prepare($conn, "UPDATE admin SET second_image = ? WHERE email = ?");
            mysqli_stmt_bind_param($stmt3, "ss", $second_image, $email);
            mysqli_stmt_execute($stmt3);
            mysqli_stmt_close($stmt3);
        }
    }

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);

        // Update session data
        $_SESSION['name'] = $name;
        $_SESSION['bio'] = $bio;
        $_SESSION['contact_no'] = $contact_no;
        $_SESSION['facebook_link'] = $facebook_link;
        $_SESSION['github_link'] = $github_link;

        return ['success' => true, 'message' => 'Personal information updated successfully'];
    } else {
        mysqli_stmt_close($stmt);
        return ['success' => false, 'message' => 'Failed to update personal information: ' . mysqli_error($conn)];
    }
}

function updateEducation($data, $conn, $id)
{
    $title = mysqli_real_escape_string($conn, $data['title']);
    $school = mysqli_real_escape_string($conn, $data['school']);
    $school_address = mysqli_real_escape_string($conn, $data['school_address']);
    $start_year = intval($data['start_year']);
    $end_year = intval($data['end_year']);

    $stmt = mysqli_prepare($conn, "UPDATE education SET title = ?, school = ?, school_address = ?, start_year = ?, end_year = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "sssiii", $title, $school, $school_address, $start_year, $end_year, $id);

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        return ['success' => true, 'message' => 'Education updated successfully'];
    } else {
        mysqli_stmt_close($stmt);
        return ['success' => false, 'message' => 'Failed to update education: ' . mysqli_error($conn)];
    }
}

function updateTechStack($data, $conn, $id)
{
    $name = mysqli_real_escape_string($conn, $data['name']);
    $percentage = intval($data['percentage']);
    $type = mysqli_real_escape_string($conn, $data['type']);

    $stmt = mysqli_prepare($conn, "UPDATE tech_stack SET name = ?, percentage = ?, type = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "sisi", $name, $percentage, $type, $id);

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $image = uploadImage($_FILES['image'], 'tech');
        if ($image) {
            $stmt2 = mysqli_prepare($conn, "UPDATE tech_stack SET image = ? WHERE id = ?");
            mysqli_stmt_bind_param($stmt2, "si", $image, $id);
            mysqli_stmt_execute($stmt2);
            mysqli_stmt_close($stmt2);
        }
    }

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        return ['success' => true, 'message' => 'Tech stack updated successfully'];
    } else {
        mysqli_stmt_close($stmt);
        return ['success' => false, 'message' => 'Failed to update tech stack: ' . mysqli_error($conn)];
    }
}

function updateProject($data, $conn, $id)
{
    $title = mysqli_real_escape_string($conn, $data['title']);
    $short_desc = mysqli_real_escape_string($conn, $data['short_desc']);
    $long_desc = mysqli_real_escape_string($conn, $data['long_desc']);
    $vid = mysqli_real_escape_string($conn, $data['vid'] ?? '');
    $repository = mysqli_real_escape_string($conn, $data['repository']);

    $stmt = mysqli_prepare($conn, "UPDATE project SET title = ?, short_desc = ?, long_desc = ?, vid = ?, repository = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "sssssi", $title, $short_desc, $long_desc, $vid, $repository, $id);

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $image = uploadImage($_FILES['image'], 'project');
        if ($image) {
            $stmt2 = mysqli_prepare($conn, "UPDATE project SET image = ? WHERE id = ?");
            mysqli_stmt_bind_param($stmt2, "si", $image, $id);
            mysqli_stmt_execute($stmt2);
            mysqli_stmt_close($stmt2);
        }
    }

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        return ['success' => true, 'message' => 'Project updated successfully'];
    } else {
        mysqli_stmt_close($stmt);
        return ['success' => false, 'message' => 'Failed to update project: ' . mysqli_error($conn)];
    }
}

// ============================
// HANDLE INSERT OPERATIONS
// ============================

function handleInsert($data, $conn)
{
    $section = mysqli_real_escape_string($conn, $data['section']);

    if ($section === 'education') {
        return insertEducation($data, $conn);
    } elseif ($section === 'tech_stack') {
        return insertTechStack($data, $conn);
    } elseif ($section === 'project') {
        return insertProject($data, $conn);
    }

    return ['success' => false, 'message' => 'Invalid section'];
}

function insertEducation($data, $conn)
{
    $title = mysqli_real_escape_string($conn, $data['title']);
    $school = mysqli_real_escape_string($conn, $data['school']);
    $school_address = mysqli_real_escape_string($conn, $data['school_address']);
    $start_year = intval($data['start_year']);
    $end_year = intval($data['end_year']);

    $stmt = mysqli_prepare($conn, "INSERT INTO education (title, school, school_address, start_year, end_year) VALUES (?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sssii", $title, $school, $school_address, $start_year, $end_year);

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        return ['success' => true, 'message' => 'Education added successfully'];
    } else {
        mysqli_stmt_close($stmt);
        return ['success' => false, 'message' => 'Failed to add education: ' . mysqli_error($conn)];
    }
}

function insertTechStack($data, $conn)
{
    $name = mysqli_real_escape_string($conn, $data['name']);
    $percentage = intval($data['percentage']);
    $type = mysqli_real_escape_string($conn, $data['type']);

    $image = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $image = uploadImage($_FILES['image'], 'tech');
        if (!$image) {
            return ['success' => false, 'message' => 'Failed to upload image'];
        }
    }

    $stmt = mysqli_prepare($conn, "INSERT INTO tech_stack (name, percentage, image, type) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "siss", $name, $percentage, $image, $type);

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        return ['success' => true, 'message' => 'Technology added successfully'];
    } else {
        mysqli_stmt_close($stmt);
        return ['success' => false, 'message' => 'Failed to add technology: ' . mysqli_error($conn)];
    }
}

function insertProject($data, $conn)
{
    $title = mysqli_real_escape_string($conn, $data['title']);
    $short_desc = mysqli_real_escape_string($conn, $data['short_desc']);
    $long_desc = mysqli_real_escape_string($conn, $data['long_desc']);
    $vid = mysqli_real_escape_string($conn, $data['vid'] ?? '');
    $repository = mysqli_real_escape_string($conn, $data['repository']);

    $image = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $image = uploadImage($_FILES['image'], 'project');
        if (!$image) {
            return ['success' => false, 'message' => 'Failed to upload image'];
        }
    }

    $stmt = mysqli_prepare($conn, "INSERT INTO project (title, image, short_desc, long_desc, vid, repository) VALUES (?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssssss", $title, $image, $short_desc, $long_desc, $vid, $repository);

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        return ['success' => true, 'message' => 'Project added successfully'];
    } else {
        mysqli_stmt_close($stmt);
        return ['success' => false, 'message' => 'Failed to add project: ' . mysqli_error($conn)];
    }
}

// ============================
// HANDLE DELETE OPERATIONS
// ============================

function handleDelete($section, $id, $conn)
{
    $id = intval($id);
    $section = mysqli_real_escape_string($conn, $section);

    // Don't allow deleting from admin table
    if ($section === 'admin') {
        return ['success' => false, 'message' => 'Cannot delete personal information'];
    }

    // Validate table name
    $allowed_tables = ['education', 'tech_stack', 'project'];
    if (!in_array($section, $allowed_tables)) {
        return ['success' => false, 'message' => 'Invalid section'];
    }

    $stmt = mysqli_prepare($conn, "DELETE FROM $section WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        return ['success' => true, 'message' => 'Item deleted successfully'];
    } else {
        mysqli_stmt_close($stmt);
        return ['success' => false, 'message' => 'Failed to delete item: ' . mysqli_error($conn)];
    }
}

// ============================
// FILE UPLOAD HANDLER
// ============================

function uploadImage($file, $prefix = 'upload')
{
    $target_dir = "../uploads/";

    // Create uploads directory if it doesn't exist
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $file_extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

    // Validate file extension
    if (!in_array($file_extension, $allowed_extensions)) {
        return false;
    }

    // Generate unique filename
    $new_filename = $prefix . '_' . time() . '_' . uniqid() . '.' . $file_extension;
    $target_file = $target_dir . $new_filename;

    // Validate file size (5MB max)
    if ($file['size'] > 5000000) {
        return false;
    }

    // Validate image
    $check = getimagesize($file['tmp_name']);
    if ($check === false) {
        return false;
    }

    // Move uploaded file
    if (move_uploaded_file($file['tmp_name'], $target_file)) {
        return $new_filename;
    }

    return false;
}
