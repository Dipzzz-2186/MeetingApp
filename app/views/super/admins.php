<?php
/** @var array $admins */
?>

<h1>Daftar Admin</h1>

<div class="card">
    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Plan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($admins as $a): ?>
                <tr>
                    <td><?= htmlspecialchars($a['name']) ?></td>
                    <td><?= htmlspecialchars($a['email']) ?></td>
                    <td><?= htmlspecialchars($a['plan_type']) ?></td>
                    <td>
                        <?php if ($a['plan_type'] === 'trial'): ?>
                            <span class="badge">Trial</span>
                        <?php else: ?>
                            <span class="badge">Paid</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <button class="btn small" onclick="openAdminDetail(<?= (int)$a['id'] ?>)">
                            Detail
                        </button>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
<div id="adminModal" class="modal hidden">
  <div class="modal-card">
    <h3 id="adminName"></h3>

    <h4>Users</h4>
    <ul id="adminUsers"></ul>

    <h4>Rooms</h4>
    <ul id="adminRooms"></ul>

    <button class="btn ghost" onclick="closeAdminModal()">Tutup</button>
  </div>
</div>

<script>
function openAdminDetail(id) {
  fetch('/super/admin-detail?id=' + id)
    .then(r => r.json())
    .then(d => {
      document.getElementById('adminName').innerText =
        d.admin.name + ' (' + d.admin.email + ')';

      const users = document.getElementById('adminUsers');
      users.innerHTML = '';
      if (d.users.length === 0) {
        users.innerHTML = '<li class="muted">Belum ada user</li>';
      } else {
        d.users.forEach(u => {
          users.innerHTML += `<li>${u.name} – ${u.email}</li>`;
        });
      }

      const rooms = document.getElementById('adminRooms');
      rooms.innerHTML = '';
      if (d.rooms.length === 0) {
        rooms.innerHTML = '<li class="muted">Belum ada room</li>';
      } else {
        d.rooms.forEach(r => {
          rooms.innerHTML += `<li>${r.name} (${r.capacity})</li>`;
        });
      }

      document.getElementById('adminModal').classList.remove('hidden');
    });
}

function closeAdminModal() {
  document.getElementById('adminModal').classList.add('hidden');
}
</script>

<style>
    .modal {
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,.4);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .modal.hidden { 
        display: none; 
    }

    .modal-card {
        background: #0b1220;
        padding: 20px;
        width: 420px;
        border-radius: 14px;
    }
    .muted {
        color: #8b93a7;
        font-style: italic;
    }
</style>