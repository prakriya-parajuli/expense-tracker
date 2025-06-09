<?php
class TransactionModel {
    private $transactions = [];

    public function addTransaction($amount, $category, $date) {
        $this->transactions[] = [
            'id' => uniqid(),
            'amount' => floatval($amount),
            'category' => $category,
            'date' => $date
        ];
        return true;
    }

    public function removeTransaction($id) {
        foreach ($this->transactions as $key => $transaction) {
            if ($transaction['id'] === $id) {
                unset($this->transactions[$key]);
                return true;
            }
        }
        return false;
    }

    public function getTransactions() {
        return array_values($this->transactions);
    }

    public function getTotalBalance() {
        $total = 0;
        foreach ($this->transactions as $transaction) {
            $total += $transaction['amount'];
        }
        return $total;
    }
}
?>