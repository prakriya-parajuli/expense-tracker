<?php
require_once '../model/TransactionModel.php';

header('Content-Type: application/json');

$model = new TransactionModel();

$action = $_POST['action'] ?? '';

if ($action === 'add') {
    $amount = $_POST['amount'] ?? 0;
    $category = $_POST['category'] ?? '';
    $date = $_POST['date'] ?? date('Y-m-d');
    
    if ($model->addTransaction($amount, $category, $date)) {
        echo json_encode([
            'success' => true,
            'transactions' => $model->getTransactions(),
            'total' => $model->getTotalBalance()
        ]);
    } else {
        echo json_encode(['success' => false]);
    }
} elseif ($action === 'remove') {
    $id = $_POST['id'] ?? '';
    
    if ($model->removeTransaction($id)) {
        echo json_encode([
            'success' => true,
            'transactions' => $model->getTransactions(),
            'total' => $model->getTotalBalance()
        ]);
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid action']);
}
?>