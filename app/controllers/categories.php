<?php
require_once(ROOT . '/app/database/db.php');
if (str_contains($_SERVER['SCRIPT_FILENAME'], 'admin')) {
    if ($_SESSION['admin'] == 0) {
        header('location: ' . BASE_URL . 'auth.php');
    }
}

$statusMessage = [];

// Создание категории
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['category-create'])) {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $statusMessage = checkInput($name, $description);
    if (!count($statusMessage)) {
        if (!empty(selectAny('categories', ['name'=>$name]))) {
            $statusMessage[] = "Такая категория уже существует";
        } else {
            $category = [
                'name' => $name,
                'description' => $description,
            ];
            $id = insert('categories', $category);
            header('location: ' . BASE_URL . 'admin/categories/index.php');
        }
    }
} else {
    $name = '';
    $description = '';
}

// Получение всех категорий для вывода в админ-панели
if ($_SERVER['REQUEST_METHOD'] === 'GET' && basename($_SERVER['SCRIPT_FILENAME']) === 'index.php') {
    $categories = selectAny('categories', []);
}

// Получение конкретной категории по id
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $category = selectAny('categories', ['id' => $id], 1);
    $id = $category['id'];
    $name = $category['name'];
    $description = $category['description'];
}

// Редактирование категории в админ-панели
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['category-edit'])) {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $statusMessage = checkInput($name, $description);
    $id = $_POST['id'];
    if (!count($statusMessage)) {
        $category = [
            'name' => $name,
            'description' => $description,
        ];
        update('categories', $id, $category);
        header('location: ' . BASE_URL . 'admin/categories/index.php');
    }
}

// Удаление категории по id
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    delete('categories', ['id' => $id]);
    header("location: " . BASE_URL . "admin/categories/index.php");
}

// Получение и проверка полученных из формы данных
function checkInput($name, $description) : array
{
    $statusMessage = [];
    if ($name === '' || $description === '') {
        $statusMessage[] = "Не все поля заполнены!";
    } elseif (mb_strlen($name, 'UTF-8') <= 2) {
        $statusMessage[] = "Категория должна быть более 2 символов";
    }
    return $statusMessage;
}