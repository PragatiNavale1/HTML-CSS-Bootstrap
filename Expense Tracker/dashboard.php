<?php
session_start();

if (!isset($_SESSION['budget'])) {
    $_SESSION['budget'] = 10000; // Default budget
}

if (!isset($_SESSION['expenses'])) {
    $_SESSION['expenses'] = [];
}

// Handling form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['set_budget'])) {
        $new_budget = (float) $_POST['budget'];
        if ($new_budget >= array_sum(array_column($_SESSION['expenses'], 'amount'))) {
            $_SESSION['budget'] = $new_budget;
            $budget_message = "Budget updated successfully!";
        } else {
            $budget_message = "New budget must be greater than or equal to your expenses.";
        }
    } elseif (isset($_POST['add_expense'])) {
        $name = trim($_POST['name']);
        $amount = (float) $_POST['amount'];
        if ($name && $amount > 0) {
            $_SESSION['expenses'][] = ['name' => $name, 'amount' => $amount];
            $expense_message = "Expense added successfully!";
        } else {
            $expense_message = "Please provide a valid name and amount for the expense.";
        }
    } elseif (isset($_POST['delete_expense'])) {
        $index = $_POST['delete_expense'];
        unset($_SESSION['expenses'][$index]);
        $_SESSION['expenses'] = array_values($_SESSION['expenses']);
        $expense_message = "Expense deleted successfully!";
    }
}

// Calculate remaining budget
$total_expense = array_sum(array_column($_SESSION['expenses'], 'amount'));
$remaining_budget = $_SESSION['budget'] - $total_expense;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Tracker</title>
    <link rel="stylesheet" href="css/dash_css.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<div class="container">
    <!-- Budget Section -->
    <div class="column">
        <h2>Your Budget: $<?php echo number_format($_SESSION['budget']); ?></h2>

        <!-- Budget Input -->
        <form method="post">
            <label for="budget">Set Budget (Minimum: $<?php echo number_format($total_expense); ?>):</label>
            <input type="number" id="budget" name="budget" value="<?php echo $_SESSION['budget']; ?>" required>
            <button type="submit" name="set_budget">Set Budget</button>
        </form>

        <?php if (isset($budget_message)): ?>
            <p class="message"><?php echo $budget_message; ?></p>
        <?php endif; ?>

        <!-- Remaining Budget -->
        <h3 class="budget-left">Budget Left: $<?php echo number_format($remaining_budget); ?></h3>
    </div>

    <!-- Expenses Section -->
    <div class="column">
        <h3>Enter Your Expenses</h3>
        <form method="post">
            <label for="name">Expense Name:</label>
            <input type="text" id="name" name="name" required>
            <label for="amount">Amount ($):</label>
            <input type="number" id="amount" name="amount" required>
            <button type="submit" name="add_expense">Add Expense</button>
        </form>

        <?php if (isset($expense_message)): ?>
            <p class="message"><?php echo $expense_message; ?></p>
        <?php endif; ?>

        <!-- Expense List -->
        <h3>List of Expenses</h3>
        <ul class="expense-list">
            <?php if (empty($_SESSION['expenses'])): ?>
                <p>No expenses added yet!</p>
            <?php else: ?>
                <?php foreach ($_SESSION['expenses'] as $index => $expense): ?>
                    <li>
                        <span class="expense-name"><?php echo $expense['name']; ?></span>
                        <span class="expense-amount">$<?php echo number_format($expense['amount']); ?></span>
                        <form method="post" class="delete-form">
                            <button type="submit" name="delete_expense" value="<?php echo $index; ?>">Delete</button>
                        </form>
                    </li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
    </div>

    <!-- Chart Section -->
    <div class="column">
        <h3>Expense Breakdown</h3>
        <canvas id="expenseChart"></canvas>
    </div>
</div>

<script>
    const ctx = document.getElementById('expenseChart').getContext('2d');
    const chartData = {
        labels: <?php echo json_encode(array_column($_SESSION['expenses'], 'name')); ?>,
        datasets: [{
            data: <?php echo json_encode(array_column($_SESSION['expenses'], 'amount')); ?>,
            backgroundColor: ['#FF5733', '#FFC300', '#28A745', '#007BFF', '#900C3F']
        }]
    };

    new Chart(ctx, {
        type: 'pie',
        data: chartData
    });
</script>

</body>
</html>
