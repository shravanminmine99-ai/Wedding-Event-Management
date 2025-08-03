<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "weddingeventdb");
if ($conn->connect_error) {
    die("DB Error: " . $conn->connect_error);
}

$clientCount = $conn->query("SELECT COUNT(*) AS total FROM clients")->fetch_assoc()['total'];
$eventCount = $conn->query("SELECT COUNT(*) AS total FROM events")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="css/dashboard.css">
</head>

<body>

<!-- Sidebar -->
<div class="sidebar">
    <h2><?php echo htmlspecialchars($_SESSION['admin_username']); ?></h2>
    <a href="#" onclick="showSection('dashboard')">📊 Dashboard</a>
    <a href="#" onclick="showSection('clients')">👤 View Clients</a>
    <a href="#" onclick="showSection('events')">📅 View Events</a>
    <a href="#" onclick="showSection('staff')">👥 View Staff</a>
    <a href="#" onclick="showSection('vendors')">🏢 View Vendors</a>
    <a href="#" onclick="showSection('venues')">🏛️ View Venues</a>
    <a href="#" onclick="showSection('payments')">💳 View Payments</a>

    <form action="logout.php" method="post">
        <button type="submit" class="logout-button">🚪 Logout</button>
    </form>
</div>

<!-- Main Content -->
<div class="content">
    <!-- Dashboard -->
    <div id="dashboard">
        <h2>Dashboard Overview</h2>
        <div style="display: flex; gap: 30px;">
            <div class="card" style="flex: 1;">
                <h3>Total Clients</h3>
                <p style="font-size: 24px;"><?php echo $clientCount; ?></p>
            </div>
            <div class="card" style="flex: 1;">
                <h3>Total Events</h3>
                <p style="font-size: 24px;"><?php echo $eventCount; ?></p>
            </div>
        </div>
        <div class="card">
            <canvas id="dashboardChart" height="120"></canvas>
        </div>
    </div>

    <!-- Data Sections -->
    <div id="clients" class="hidden">
        <h3>Clients</h3>
        <iframe src="../client/print_client.php"></iframe>
    </div>

    <div id="events" class="hidden">
        <h3>Events</h3>
        <iframe src="../event/print_events.php"></iframe>
    </div>

    <div id="staff" class="hidden">
        <h3>Staff</h3>
        <iframe src="../staff/print_staff.php"></iframe>
    </div>

    <div id="vendors" class="hidden">
        <h3>Vendors</h3>
        <iframe src="../vendor/print_vendor.php"></iframe>
    </div>

    <div id="venues" class="hidden">
        <h3>Venues</h3>
        <iframe src="../venue/print_venue.php"></iframe>
    </div>

    <div id="payments" class="hidden">
        <h3>Payments</h3>
        <iframe src="../payment/print_payments.php"></iframe>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    function showSection(id) {
        const sections = ['dashboard', 'clients', 'events', 'staff', 'vendors', 'venues', 'payments'];
        sections.forEach(section => {
            document.getElementById(section).classList.add('hidden');
        });
        document.getElementById(id).classList.remove('hidden');
        window.scrollTo(0, 0);
    }

    // Load Chart
    const ctx = document.getElementById('dashboardChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Clients', 'Events'],
            datasets: [{
                label: 'Summary',
                data: [<?php echo $clientCount; ?>, <?php echo $eventCount; ?>],
                backgroundColor: ['#007bff', '#ff6384']
            }]
        },
        options: {
            plugins: {
                legend: { display: false },
                title: {
                    display: true,
                    text: 'Clients vs Events'
                }
            }
        }
    });
</script>

</body>
</html>

<?php $conn->close(); ?>
