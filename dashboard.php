<?php
session_start();

if (!isset($_SESSION['user_email'])) {
    header("Location: login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Professional Admin Panel</title>
<link rel="stylesheet" href="Admin.css">

<style>
/* small fix */
.hidden { display:none; }
</style>

</head>
<body>

<!-- Toast -->
<div id="toast-container"></div>

<!-- Mobile Toggle -->
<button class="toggle-btn" onclick="toggleSidebar()">☰ Menu</button>

<div class="app-wrapper">

<!-- SIDEBAR -->
<aside class="sidebar" id="sidebar">

  <div class="logo">
    <img src="https://cdn-icons-png.flaticon.com/512/906/906334.png">
    <span>AdminPanel</span>
  </div>

  <!-- ✅ Logged user -->
  <p style="color:white;text-align:center;margin:10px 0;">
    <?php echo $_SESSION['user_email']; ?>
  </p>

  <nav>
    <div class="section">Main</div>
    <ul class="menu">
      <li class="open">
        <a href="#" class="active" onclick="toggleMenu(event)">
          🏠 Dashboard
        </a>
        <div class="submenu">
          <a href="#dashboard">Overview</a>
        </div>
      </li>

      <li><a href="#user-mgmt">✉️ User Management</a></li>
      <li><a href="#menu-mgmt">✅ Menu</a></li>
      <li><a href="#order-mgmt">👤 Orders</a></li>
      <li><a href="#financial-mgmt">📅 Financial</a></li>
      <li><a href="#reports">💬 Reports</a></li>
      <li><a href="#security">🔒 Security</a></li>
      <li><a href="#notifications">🔔 Notifications</a></li>
    </ul>

    <div class="section">System</div>
    <ul class="menu">
      <li><a href="#">⚙️ Settings</a></li>

      <!-- ✅ Logout -->
      <li><a href="logout.php">🚪 Logout</a></li>
    </ul>
  </nav>
</aside>

<!-- MAIN -->
<main class="main-content">

<div class="page-title">Overview</div>

<!-- STATS -->
<section id="dashboard" class="card">
  <div class="dashboard-grid">
    <div class="stat-card">
      <h3>Total Users</h3>
      <div id="userCount">0</div>
    </div>

    <div class="stat-card">
      <h3>Total Orders</h3>
      <div id="orderCount">0</div>
    </div>

    <div class="stat-card">
      <h3>Total Revenue</h3>
      ৳<span id="revenue">0</span>
    </div>
  </div>
</section>

<!-- USER -->
<section id="user-mgmt" class="card">
  <h2>User Management</h2>

  <input id="userName" placeholder="User name">
  <select id="userRole">
    <option>Customer</option>
    <option>Admin</option>
  </select>

  <button onclick="addUser()">Add</button>

  <table>
    <tbody id="userTable"></tbody>
  </table>
</section>

<!-- MENU -->
<section id="menu-mgmt" class="card">
  <h2>Menu</h2>
  <input id="menuItem" placeholder="Item name">
  <button onclick="addMenu()">Add</button>
  <ul id="menuList"></ul>
</section>

<!-- ORDER -->
<section id="order-mgmt" class="card">
  <h2>Orders</h2>
  <button onclick="addOrder()">New Order</button>
  <ul id="orderList"></ul>
</section>

<!-- FINANCE -->
<section id="financial-mgmt" class="card">
  <h2>Finance</h2>
  <button onclick="addRevenue()">+500</button>
  ৳<span id="financeTotal">0</span>
</section>

<!-- NOTIFY -->
<section id="notifications" class="card">
  <h2>Notifications</h2>
  <input id="notifyText">
  <button onclick="sendNotification()">Send</button>
  <ul id="notifyList"></ul>
</section>

</main>
</div>

<script>
// STATE
let stats = {users:0, orders:0, revenue:0};

// SIDEBAR
function toggleSidebar(){
  document.getElementById("sidebar").classList.toggle("show");
}

// USER
function addUser(){
  let name = document.getElementById("userName").value;
  if(!name) return alert("Enter name");

  let row = `<tr>
    <td>${name}</td>
    <td><button onclick="this.parentElement.parentElement.remove()">Delete</button></td>
  </tr>`;

  userTable.innerHTML += row;
  stats.users++;
  userCount.innerText = stats.users;
}

// MENU
function addMenu(){
  let item = menuItem.value;
  if(!item) return;

  menuList.innerHTML += `<li>${item}</li>`;
}

// ORDER
function addOrder(){
  stats.orders++;
  orderCount.innerText = stats.orders;

  orderList.innerHTML += `<li>Order #${stats.orders}</li>`;
}

// FINANCE
function addRevenue(){
  stats.revenue += 500;
  revenue.innerText = stats.revenue;
  financeTotal.innerText = stats.revenue;
}

// NOTIFY
function sendNotification(){
  let msg = notifyText.value;
  if(!msg) return;

  notifyList.innerHTML += `<li>${msg}</li>`;
}
</script>

</body>
</html>