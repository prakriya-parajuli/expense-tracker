<div class="dashboard">
    <h1>Dashboard</h1>
    <div class="balance-card">
        <h2>Total Balance</h2>
        <p id="total-balance">$0.00</p>
    </div>
    <div class="form-card">
        <h3>Add Transaction</h3>
        <form id="transaction-form">
            <input type="number" id="amount" placeholder="Amount" step="0.01" required>
            <input type="text" id="category" placeholder="Category (e.g., Food, Salary)" required>
            <input type="date" id="date" required>
            <button type="submit">Add Transaction</button>
        </form>
    </div>
    <div class="transaction-card">
        <h3>Transactions</h3>
        <ul id="transaction-list"></ul>
    </div>
</div>