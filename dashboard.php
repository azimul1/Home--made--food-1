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
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Professional Admin Panel - SPA</title>
  <link rel="stylesheet" href="Admin.css">

</head>

<body>

  <!-- Toast Container -->
  <div id="toast-container"></div>

  <!-- SIDEBAR -->
  <aside class="sidebar" id="sidebar">
    <div class="logo">
      <img src="https://cdn-icons-png.flaticon.com/512/906/906334.png" alt="logo">
      <span>AdminPanel</span>
    </div>

    <nav>
      <!-- MAIN -->
      <div class="nav-section">
        <div class="nav-title">Main</div>
        <ul class="menu">
          <li><a onclick="navigate('dashboard')" class="menu-link active" id="nav-dashboard"><span
                class="icon">🏠</span> Dashboard</a></li>
          <li><a onclick="navigate('users')" class="menu-link" id="nav-users"><span class="icon">✉️</span> User
              Management</a></li>
          <li><a onclick="navigate('menu')" class="menu-link" id="nav-menu"><span class="icon">✅</span> Menu
              Management</a></li>
          <li><a onclick="navigate('orders')" class="menu-link" id="nav-orders"><span class="icon">👤</span> User
              Orders</a></li>
          <li><a onclick="navigate('financial')" class="menu-link" id="nav-financial"><span class="icon">📅</span>
              Financial</a></li>
          <li><a onclick="navigate('reports')" class="menu-link" id="nav-reports"><span class="icon">💬</span> Reports &
              Analysis</a></li>
          <li><a onclick="navigate('security')" class="menu-link" id="nav-security"><span class="icon">🔒</span>
              Security & Access</a></li>
          <li><a onclick="navigate('notifications')" class="menu-link" id="nav-notifications"><span
                class="icon">🔔</span> Notifications</a></li>
        </ul>
      </div>

      <!-- SYSTEM -->
      <div class="nav-section">
        <div class="nav-title">System</div>
        <ul class="menu">
          <li><a onclick="navigate('settings')" class="menu-link" id="nav-settings"><span class="icon">⚙️</span>
              Settings</a></li>
          <li><a onclick="handleLogout()" class="menu-link" id="nav-logout"><span class="icon">🚪</span> Logout</a></li>
        </ul>
      </div>
    </nav>
  </aside>

  <!-- MAIN CONTENT AREA -->
  <main class="main-content" id="mainContent">

    <!-- Mobile Header -->
    <div class="header-mobile">
      <button class="toggle-btn" onclick="toggleSidebar()">☰</button>
      <h2 id="mobile-title">Dashboard</h2>
    </div>

    <!-- 1. DASHBOARD SECTION -->
    <section id="dashboard" class="section-view active-view">
      <div class="page-header">
        <h1 class="page-title">Dashboard Overview</h1>
        <p class="page-desc">Welcome back, Administrator. Here is what's happening today.</p>
      </div>

      <div class="dashboard-grid">
        <div class="stat-card">
          <h3>Total Users</h3>
          <div class="number" id="dash-userCount">0</div>
        </div>
        <div class="stat-card">
          <h3>Total Orders</h3>
          <div class="number" id="dash-orderCount">0</div>
        </div>
        <div class="stat-card">
          <h3>Total Revenue</h3>
          <div class="number">৳<span id="dash-revenue">0</span></div>
        </div>
        <div class="stat-card" style="border-bottom-color: #64748b;">
          <h3>Active Admins</h3>
          <div class="number">1</div>
        </div>
      </div>

      <div class="card" style="margin-top: 20px;">
        <h3>Quick Actions</h3>
        <div style="display:flex; gap:10px; margin-top:10px; flex-wrap:wrap;">
          <button onclick="navigate('orders')">+ New Order</button>
          <button style="background-color: var(--success);" onclick="navigate('users')">+ Add User</button>
          <button style="background-color: #f59e0b;" onclick="navigate('financial')">View Finances</button>
        </div>
      </div>
    </section>

    <!-- 2. USER MANAGEMENT SECTION -->
    <section id="users" class="section-view">
      <div class="page-header">
        <h1 class="page-title">User Management</h1>
        <p class="page-desc">Manage system users and roles.</p>
      </div>

      <!-- ADD USER BUTTON -->
      <div style="margin-bottom: 15px;">
        <button onclick="toggleUserForm()">+ Add User</button>
      </div>

      <!-- ADD USER FORM (HIDDEN BY DEFAULT) -->
      <div class="card" id="userFormCard" style="display:none;">
        <div class="form-group">
          <input id="userName" type="text" placeholder="Name">
          <input id="userEmail" type="email" placeholder="Email">
          <input id="userPhone" type="text" placeholder="Phone">
          <input id="userPassword" type="password" placeholder="Password">
          <button onclick="addUser()">Save User</button>
          <button style="background:#64748b;" onclick="toggleUserForm()">Cancel</button>
        </div>
      </div>

      <!-- USER TABLE -->
      <div class="card">
        <div style="overflow-x:auto;">
          <table class="table">
            <thead>
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody id="userTable"></tbody>
          </table>
        </div>
      </div>
    </section>

    <!-- 3. MENU MANAGEMENT SECTION -->
    <section id="menu" class="section-view">
      <div class="page-header">
        <h1>Menu Management</h1>
      </div>

      <!-- ADD FOOD -->
      <div class="card">
        <input id="foodName" type="text" placeholder="Food Name">
        <input id="foodPrice" type="number" placeholder="Price">

        <select id="foodCategory">
          <option value="">Select Category</option>
          <option>Burger</option>
          <option>Pizza</option>
          <option>Drinks</option>
        </select>

        <input id="foodImage" type="file">

        <!-- ✅ NEW -->
        <label>
          <input type="checkbox" id="isPopular">
          Mark as Popular
        </label>


        <button onclick="addFood()">Add Food</button>
      </div>

      <!-- TABLE -->
      <div class="card">
        <table class="table">
          <thead>
            <tr>
              <th>Image</th>
              <th>Name</th>
              <th>Price</th>
              <th>Category</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="foodTable"></tbody>
        </table>
      </div>
    </section>

    <!-- 4. ORDER MANAGEMENT SECTION -->
    <section id="orders" class="section-view">
      <div class="page-header">
        <h1 class="page-title">Order Management</h1>
        <p class="page-desc">Manage all customer orders.</p>
      </div>

      <div class="card">
        <div style="overflow-x:auto;">
          <table class="table">
            <thead>
              <tr>
                <th>Order ID</th>
                <th>Customer</th>
                <th>Items</th>
                <th>Total</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>

            <tbody id="orderTable"></tbody>
          </table>
        </div>
      </div>
    </section>

    <!-- 5. FINANCIAL SECTION -->
    <section id="financial" class="section-view">
      <div class="page-header">
        <h1 class="page-title">Financial Management</h1>
        <p class="page-desc">Monitor revenue and transaction flow.</p>
      </div>
      <div class="card">
        <p style="margin-bottom: 15px; color: #64748b;">Simulate revenue intake per transaction.</p>
        <div class="form-group">
          <button onclick="addRevenue()">+ Add ৳500 Revenue</button>
        </div>
        <div
          style="background: #f8fafc; padding: 20px; border-radius: 8px; border: 1px solid #e2e8f0; text-align: center;">
          <span style="color:#64748b; font-size:0.9rem;">Total Balance</span>
          <div style="font-weight: 700; font-size: 2.5rem; color: #1e293b;">৳<span id="financeTotal">0</span></div>
        </div>
      </div>
    </section>

    <!-- 6. REPORTS SECTION -->
    <section id="reports" class="section-view">
      <div class="page-header">
        <h1 class="page-title">Reports & Analytics</h1>
        <p class="page-desc">Business intelligence overview.</p>
      </div>
      <div style="display: grid; gap: 15px;">
        <div class="card"
          style="display: flex; align-items: center; gap: 15px; padding: 20px; border-left: 5px solid #0ea5e9;">
          <span style="font-size: 2rem;">📈</span>
          <div>
            <h4>Daily Orders</h4>
            <p style="color: #64748b; font-size: 0.9rem;">Increased by 12% compared to yesterday.</p>
          </div>
        </div>
        <div class="card"
          style="display: flex; align-items: center; gap: 15px; padding: 20px; border-left: 5px solid #10b981;">
          <span style="font-size: 2rem;">💰</span>
          <div>
            <h4>Monthly Revenue</h4>
            <p style="color: #64748b; font-size: 0.9rem;">Target reached 5 days ahead of schedule.</p>
          </div>
        </div>
        <div class="card"
          style="display: flex; align-items: center; gap: 15px; padding: 20px; border-left: 5px solid #f97316;">
          <span style="font-size: 2rem;">👥</span>
          <div>
            <h4>User Growth</h4>
            <p style="color: #64748b; font-size: 0.9rem;">Steady stream of new registrations.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- 7. SECURITY SECTION -->
    <section id="security" class="section-view">
      <div class="page-header">
        <h1 class="page-title">Security & Access</h1>
        <p class="page-desc">System safety status and logs.</p>
      </div>
      <div class="card">
        <div style="overflow-x:auto;">
          <table class="table">
            <tr>
              <td style="width: 40%;"><strong>Current Role</strong></td>
              <td>Super Admin</td>
            </tr>
            <tr>
              <td><strong>Access Level</strong></td>
              <td>Full Access (Level 5)</td>
            </tr>
            <tr>
              <td><strong>Last Login IP</strong></td>
              <td>192.168.1.102</td>
            </tr>
            <tr>
              <td><strong>2FA Status</strong></td>
              <td style="color: #10b981; font-weight: bold;">✔ Enabled</td>
            </tr>
          </table>
        </div>
      </div>
    </section>

    <!-- 8. NOTIFICATIONS SECTION -->
    <section id="notifications" class="section-view">
      <div class="page-header">
        <h1 class="page-title">System Notifications</h1>
        <p class="page-desc">Send broadcasts to users.</p>
      </div>
      <div class="card">
        <div class="form-group">
          <input id="notifyText" type="text" placeholder="Type notification message...">
          <button onclick="sendNotification()">Send Notification</button>
        </div>
        <ul id="notifyList" class="item-list"></ul>
      </div>
    </section>

    <!-- 9. SETTINGS SECTION -->
    <section id="settings" class="section-view">
      <div class="page-header">
        <h1 class="page-title">Settings</h1>
        <p class="page-desc">Application configuration.</p>
      </div>
      <div class="card">
        <div
          style="display:flex; justify-content:space-between; align-items:center; padding: 10px 0; border-bottom: 1px solid #eee;">
          <div>
            <strong>Dark Mode</strong>
            <p style="font-size:0.85rem; color:#64748b;">Toggle application theme</p>
          </div>
          <button style="background:#cbd5e1; color:#333;">Switch</button>
        </div>
        <div
          style="display:flex; justify-content:space-between; align-items:center; padding: 10px 0; border-bottom: 1px solid #eee;">
          <div>
            <strong>Email Alerts</strong>
            <p style="font-size:0.85rem; color:#64748b;">Receive daily summaries</p>
          </div>
          <button onclick="showToast('Settings Saved')">Enable</button>
        </div>
      </div>
    </section>

  </main>

  <script>
    function toggleUserForm() {
      const form = document.getElementById("userFormCard");
      form.style.display = form.style.display === "none" ? "block" : "none";
    }
    // ================= STATE MANAGEMENT =================
    let stats = {
      users: 0,
      orders: 0,
      revenue: 0
    };

    // ================= NAVIGATION LOGIC (SPA) =================
    function navigate(sectionId) {
      // 1. Hide all sections
      document.querySelectorAll('.section-view').forEach(sec => {
        sec.classList.remove('active-view');
      });

      // 2. Show target section
      const target = document.getElementById(sectionId);
      if (target) {
        target.classList.add('active-view');
      }

      // 3. Update Sidebar Active State
      document.querySelectorAll('.menu-link').forEach(link => {
        link.classList.remove('active');
      });
      const activeLink = document.getElementById('nav-' + sectionId);
      if (activeLink) activeLink.classList.add('active');

      // 4. Update Mobile Title
      const mobileTitle = document.getElementById('mobile-title');
      if (activeLink) mobileTitle.innerText = activeLink.innerText.trim();

      // 5. Close sidebar on mobile after selection
      if (window.innerWidth <= 768) {
        document.getElementById('sidebar').classList.remove('show');
      }
    }

    function toggleSidebar() {
      document.getElementById("sidebar").classList.toggle("show");
    }

    function handleLogout() {
      if (confirm("Are you sure you want to logout?")) {
        showToast("Logging out...", "error");

        setTimeout(() => {
          window.location.href = "logout.php";
        }, 1000);
      }
    }

    // ================= TOAST NOTIFICATION SYSTEM =================
    function showToast(message, type = 'success') {
      const container = document.getElementById("toast-container");
      const toast = document.createElement("div");
      toast.className = `toast ${type}`;
      toast.innerText = message;

      container.appendChild(toast);

      setTimeout(() => {
        toast.style.opacity = "0";
        toast.style.transform = "translateY(20px)";
        setTimeout(() => toast.remove(), 300);
      }, 3000);
    }

    // ================= FEATURE LOGIC =================

    /* --- USER MANAGEMENT --- */
    function addUser() {
      const name = document.getElementById("userName").value;
      const email = document.getElementById("userEmail").value;
      const phone = document.getElementById("userPhone").value;
      const password = document.getElementById("userPassword").value;

      if (!name || !email || !password) {
        showToast("Fill required fields", "error");
        return;
      }

      fetch("add_user.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded"
          },
          body: `name=${name}&email=${email}&phone=${phone}&password=${password}`
        })
        .then(res => res.text())
        .then(data => {
          if (data === "success") {
            showToast("User added");

            // clear fields
            document.getElementById("userName").value = "";
            document.getElementById("userEmail").value = "";
            document.getElementById("userPhone").value = "";
            document.getElementById("userPassword").value = "";

            // hide form
            toggleUserForm();

            // reload users
            loadUsers();

          } else if (data === "exists") {
            showToast("Email already exists", "error");
          } else {
            showToast("Error adding user", "error");
          }
        });
    }

    function loadUsers() {
      fetch("get_users.php")
        .then(res => res.json())
        .then(users => {
          const table = document.getElementById("userTable");
          table.innerHTML = "";

          users.forEach(user => {
            const row = document.createElement("tr");

            row.innerHTML = `
          <td>${user.name}</td>
          <td>${user.email}</td>
          <td>${user.phone}</td>
          <td>
            <button onclick="deleteUser(${user.id})" class="delete-btn">
              Delete
            </button>
          </td>
        `;

            table.appendChild(row);
          });

          stats.users = users.length;
          updateDashboardStats();
        });
    }

    function deleteUser(id) {
      if (!confirm("Are you sure you want to delete this user?")) return;

      fetch("delete_user.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded"
          },
          body: `id=${id}`
        })
        .then(res => res.text())
        .then(data => {
          if (data === "deleted") {
            showToast("User deleted", "error");
            loadUsers(); // refresh table
          } else {
            showToast("Delete failed", "error");
          }
        })
        .catch(() => {
          showToast("Server error", "error");
        });
    }

    function removeUser(btn) {
      const row = btn.closest("tr");
      row.remove();
      stats.users--;
      updateDashboardStats();
      showToast("User removed", "error");
    }

    /* --- MENU MANAGEMENT --- */
    function addMenu() {
      const input = document.getElementById("menuItem");
      if (!input.value.trim()) {
        showToast("Please enter an item name", "error");
        return;
      }

      const list = document.getElementById("menuList");
      const li = document.createElement("li");
      li.innerHTML = `
        <div style="display:flex; align-items:center; gap:10px;">
            <span style="width:10px; height:10px; background:#10b981; border-radius:50%;"></span>
            <span>${input.value}</span>
        </div>
        <button class="delete-btn" onclick="this.closest('li').remove(); showToast('Item removed', 'error')">Remove</button>
    `;

      list.appendChild(li);
      showToast(`Menu item '${input.value}' added.`);
      input.value = "";
    }

    /* --- ORDER MANAGEMENT --- */

    function loadOrders() {

      fetch("get_orders.php")
        .then(res => res.json())
        .then(data => {

          const table = document.getElementById("orderTable");
          table.innerHTML = "";

          stats.orders = data.length;
          updateDashboardStats();

          data.forEach(order => {

            table.innerHTML += `
        
        <tr>
          <td>#${order.id}</td>
          <td>${order.customer_name}</td>
          <td>${order.items}</td>
          <td>৳${order.total}</td>

          <td>
            <select onchange="updateOrderStatus(${order.id}, this.value)">
              <option value="Pending" ${order.status == 'Pending' ? 'selected' : ''}>Pending</option>

              <option value="Processing" ${order.status == 'Processing' ? 'selected' : ''}>Processing</option>

              <option value="Delivered" ${order.status == 'Delivered' ? 'selected' : ''}>Delivered</option>

              <option value="Cancelled" ${order.status == 'Cancelled' ? 'selected' : ''}>Cancelled</option>
            </select>
          </td>

          <td>
            <button 
              class="delete-btn"
              onclick="deleteOrder(${order.id})">
              Delete
            </button>
          </td>
        </tr>

        `;
          });

        });
    }



    function updateOrderStatus(id, status) {

      fetch("update_order_status.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded"
          },

          body: `id=${id}&status=${status}`
        })

        .then(res => res.text())
        .then(data => {

          if (data == "updated") {
            showToast("Order status updated");
          } else {
            showToast("Update failed", "error");
          }

        });

    }



    function deleteOrder(id) {

      if (!confirm("Delete this order?")) return;

      fetch("delete_order.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded"
          },
          body: `id=${id}`
        })

        .then(async (res) => {

          // capture HTTP errors too
          const text = await res.text();

          console.log("HTTP STATUS:", res.status);
          console.log("RAW RESPONSE:", text);

          return {
            ok: res.ok,
            text
          };

        })

        .then(({
          ok,
          text
        }) => {

          if (text.trim() === "deleted") {

            showToast("Order deleted", "error");
            loadOrders();

          } else {

            // 🔴 show REAL backend error
            showToast("Delete failed: " + text, "error");

            console.error("DELETE ERROR FROM PHP:", text);
          }

        })

        .catch(err => {
          console.error("NETWORK ERROR:", err);
          showToast("Network error", "error");
        });

    }

    /* --- FINANCIAL --- */
    function addRevenue() {
      const amount = 500;
      stats.revenue += amount;
      updateDashboardStats();

      const financeTotal = document.getElementById("financeTotal");

      // Animation for number change
      let start = parseInt(financeTotal.innerText);
      let end = stats.revenue;
      let duration = 500;
      let startTime = null;

      function animate(currentTime) {
        if (!startTime) startTime = currentTime;
        let progress = currentTime - startTime;
        let value = Math.floor(progress / duration * (end - start) + start);

        financeTotal.innerText = value;

        if (progress < duration) {
          requestAnimationFrame(animate);
        } else {
          financeTotal.innerText = end;
        }
      }
      requestAnimationFrame(animate);

      showToast(`Revenue updated: +৳${amount}`);
    }

    /* --- NOTIFICATIONS --- */
    function sendNotification() {
      const input = document.getElementById("notifyText");
      if (!input.value.trim()) {
        showToast("Please type a message", "error");
        return;
      }

      const list = document.getElementById("notifyList");
      const li = document.createElement("li");

      const time = new Date().toLocaleTimeString([], {
        hour: '2-digit',
        minute: '2-digit'
      });

      li.innerHTML = `
      <div>
        <div style="font-weight:600; font-size:14px;">${input.value}</div>
        <div style="font-size:11px; color:#94a3b8;">Sent at ${time}</div>
      </div>
      <span style="color:#10b981; font-size:0.8rem;">Sent</span>
    `;

      list.insertBefore(li, list.firstChild);
      showToast("Notification sent to all users");
      input.value = "";
    }

    /* --- SHARED HELPERS --- */
    function updateDashboardStats() {
      document.getElementById("dash-userCount").innerText = stats.users;
      document.getElementById("dash-orderCount").innerText = stats.orders;
      document.getElementById("dash-revenue").innerText = stats.revenue;
    }



    function addFood() {
      const name = document.getElementById("foodName").value;
      const price = document.getElementById("foodPrice").value;
      const category = document.getElementById("foodCategory").value;
      const image = document.getElementById("foodImage").files[0];

      const isPopular = document.getElementById("isPopular").checked ? 1 : 0;

      if (!name || !price || !category || !image) {
        showToast("All fields required", "error");
        return;
      }

      let formData = new FormData();
      formData.append("name", name);
      formData.append("price", price);
      formData.append("category", category);
      formData.append("image", image);
      formData.append("is_popular", isPopular);

      fetch("add_food.php", {
          method: "POST",
          body: formData
        })
        .then(res => res.text())
        .then(data => {
          if (data === "success") {
            showToast("Food added");
            loadFood();
          }
        });
    }

    function loadFood() {
      fetch("get_food.php")
        .then(res => res.text()) // first get raw text
        .then(text => {
          try {
            const data = JSON.parse(text);

            const table = document.getElementById("foodTable");
            table.innerHTML = "";

            data.forEach(food => {
              table.innerHTML += `
          <tr>
            <td><img src="${food.image}" width="50"></td>
            <td>${food.name}</td>
            <td>৳${food.price}</td>
            <td>${food.category}</td>
            <td>
              <button onclick="editFood(${food.id}, '${food.name}', ${food.price}, '${food.category}')">Edit</button>
              <button onclick="deleteFood(${food.id})" class="delete-btn">Delete</button>
            </td>
          </tr>
          `;
            });

          } catch (err) {
            console.error("Server response:", text);
            alert("PHP Error! Check console.");
          }
        });
    }

    function deleteFood(id) {
      if (!confirm("Delete?")) return;

      fetch("delete_food.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded"
          },
          body: `id=${id}`
        })
        .then(res => res.text())
        .then(data => {
          if (data === "deleted") {
            showToast("Deleted", "error");
            loadFood();
          }
        });
    }

    function editFood(id, name, price, category) {
      const newName = prompt("Name:", name);
      const newPrice = prompt("Price:", price);
      const newCategory = prompt("Category:", category);

      if (!newName || !newPrice || !newCategory) return;

      fetch("update_food.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded"
          },
          body: `id=${id}&name=${newName}&price=${newPrice}&category=${newCategory}`
        })
        .then(res => res.text())
        .then(data => {
          if (data === "updated") {
            showToast("Updated");
            loadFood();
          }
        });
    }
    // ADD THIS AT THE VERY BOTTOM
    window.onload = function() {

      loadUsers();

      loadFood();

      loadOrders();

    };
  </script>
</body>

</html>