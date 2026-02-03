<?php /** @var array $users */ ?>

<h1>Daftar User</h1>

<div class="card">
    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Admin Pemilik</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $u): ?>
                <tr>
                    <td><?= htmlspecialchars($u['name']) ?></td>
                    <td><?= htmlspecialchars($u['email']) ?></td>
                    <td><?= htmlspecialchars($u['admin_name'] ?? '-') ?></td>
                    <td>
                        <button class="btn small" onclick="openUserDetail(<?= (int)$u['id'] ?>)">
                            Detail
                        </button>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<!-- MODAL -->
<div id="userModal" class="modal hidden">
  <div class="modal-card">
    <h3 id="userName"></h3>

    <p class="muted" id="userAdmin"></p>

    <h4>Room yang Pernah Dibooking</h4>
    <ul id="userRooms"></ul>

    <button class="btn ghost" onclick="closeUserModal()">Tutup</button>
  </div>
</div>

<script>
function openUserDetail(id) {
  fetch('/super/user-detail?id=' + id)
    .then(r => r.json())
    .then(d => {
      document.getElementById('userName').innerText =
        d.user.name + ' (' + d.user.email + ')';

      document.getElementById('userAdmin').innerText =
        'Admin: ' + (d.admin_name ?? '-');

      const rooms = document.getElementById('userRooms');
      rooms.innerHTML = '';

      if (d.rooms.length === 0) {
        rooms.innerHTML = '<li class="muted">Belum pernah booking room</li>';
      } else {
        d.rooms.forEach(r => {
          rooms.innerHTML += `<li>${r.room_name} (${r.start_time} – ${r.end_time})</li>`;
        });
      }

      document.getElementById('userModal').classList.remove('hidden');
    });
}

function closeUserModal() {
  document.getElementById('userModal').classList.add('hidden');
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
.modal.hidden { display: none; }

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
