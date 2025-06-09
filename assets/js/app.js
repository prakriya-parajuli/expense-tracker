document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('transaction-form');
    const transactionList = document.getElementById('transaction-list');
    const totalBalance = document.getElementById('total-balance');

    // Fetch and display transactions (initial load)
    fetchTransactions();

    // Form submission to add transaction
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        const amount = document.getElementById('amount').value;
        const category = document.getElementById('category').value;
        const date = document.getElementById('date').value;

        fetch('../controller/TransactionController.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `action=add&amount=${amount}&category=${category}&date=${date}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updateUI(data.transactions, data.total);
                form.reset();
            } else {
                alert('Error adding transaction');
            }
        });
    });

    // Remove transaction
    transactionList.addEventListener('click', (e) => {
        if (e.target.classList.contains('remove-btn')) {
            const id = e.target.dataset.id;
            fetch('../controller/TransactionController.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `action=remove&id=${id}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    updateUI(data.transactions, data.total);
                } else {
                    alert('Error removing transaction');
                }
            });
        }
    });

    // Update UI with transactions and total
    function updateUI(transactions, total) {
        transactionList.innerHTML = '';
        transactions.forEach(t => {
            const li = document.createElement('li');
            li.className = 'transaction-item';
            li.innerHTML = `
                ${t.category}: $${t.amount.toFixed(2)} (${t.date})
                <button class="remove-btn" data-id="${t.id}">Remove</button>
            `;
            transactionList.appendChild(li);
        });
        totalBalance.textContent = `$${total.toFixed(2)}`;
    }

    // Fetch transactions (for initial load or refresh)
    function fetchTransactions() {
        fetch('../controller/TransactionController.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'action=get'
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updateUI(data.transactions, data.total);
            }
        });
    }
});