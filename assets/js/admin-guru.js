const formModal = document.getElementById("formModal");
const confirmModal = document.getElementById("confirmModal");
const successModal = document.getElementById("successModal");

let rowToDelete = null;
let editMode = false;
let currentEditRow = null;

function openForm(mode, row = null) {
  console.log('Open form mode:', mode); // Debug untuk memastikan mode diterima
  document.getElementById("formTitle").innerText = mode === 'edit' ? "Edit Jadwal" : "Tambah Jadwal";
  document.getElementById("submitBtn").innerText = mode === 'edit' ? "Simpan" : "Tambah";
  editMode = mode === 'edit';

  if (editMode && row) {
    const jadwalId = row.getAttribute('data-id');
    const hari = row.getAttribute('data-hari');
    const mapelId = row.querySelector('[data-mapel-id]').getAttribute('data-mapel-id');
    const guruId = row.querySelector('[data-guru-id]').getAttribute('data-guru-id');
    const ruangId = row.querySelector('[data-ruang-id]').getAttribute('data-ruang-id');

    console.log('Row attributes:', { jadwalId, hari, mapelId, guruId, ruangId }); // Debug untuk memastikan data diambil

    // Isi form dengan data dari baris tabel
    document.getElementById("jadwal_id").value = jadwalId;
    document.getElementById("jamMulai").value = row.children[0].innerText.trim();
    document.getElementById("jamSelesai").value = row.children[1].innerText.trim();
    document.getElementById("hari").value = hari;
    document.getElementById("mapel").value = mapelId;
    document.getElementById("guru").value = guruId;
    document.getElementById("ruang").value = ruangId;
  } else {
    // Reset form untuk mode tambah
    document.getElementById("jadwalForm").reset();
  }

  console.log('Form modal:', formModal); // Debug untuk memastikan modal ditemukan
  formModal.style.display = "flex"; // Tampilkan modal
}


function closeForm() {
  formModal.style.display = "none";
}

function submitForm() {
  const jamMulai = document.getElementById("jamMulai").value;
  const jamSelesai = document.getElementById("jamSelesai").value;
  const mapel = document.getElementById("mapel").value;
  const guru = document.getElementById("guru").value;
  const ruang = document.getElementById("ruang").value;

  if (editMode && currentEditRow) {
    const cells = currentEditRow.querySelectorAll("td");
    cells[0].innerText = jamMulai;
    cells[1].innerText = jamSelesai;
    cells[2].innerText = mapel;
    cells[3].innerText = guru;
    cells[4].innerText = ruang;
  } else {
    const tbody = document.getElementById("jadwalBody");
    const newRow = document.createElement("tr");
    newRow.innerHTML = `
      <td>${jamMulai}</td>
      <td>${jamSelesai}</td>
      <td class="highlight">${mapel}</td>
      <td class="highlight">${guru}</td>
      <td>${ruang}</td>
      <td>
        <img src="icons/edit.svg" class="icon" onclick="editRow(this)">
        <img src="icons/delete.svg" class="icon" onclick="confirmDelete(this)">
      </td>
    `;
    tbody.appendChild(newRow);
  }

  closeForm();
}

function editRow(icon) {
  console.log('Edit icon clicked'); // Debugging untuk memastikan fungsi dipanggil
  const row = icon.closest("tr"); // Ambil baris tabel yang diklik
  console.log('Row data:', row); // Debugging untuk memastikan baris tabel ditemukan
  openForm('edit', row); // Panggil fungsi openForm dengan mode 'edit' dan baris tabel
}


function confirmDelete(icon) {
  rowToDelete = icon.closest("tr");
  confirmModal.style.display = "flex";
}

function closeConfirm() {
  confirmModal.style.display = "none";
}

function deleteRow() {
  if (rowToDelete) {
    rowToDelete.remove();
    confirmModal.style.display = "none";
    successModal.style.display = "flex";
    setTimeout(() => successModal.style.display = "none", 2000);
  }
}

let isSubmitting = false;

document.getElementById('jadwalForm').addEventListener('submit', function(e) {
  e.preventDefault();
  if (isSubmitting) return;
  isSubmitting = true;

  const form = this;
  const formData = new FormData(form);
  formData.append('action', editMode ? 'update' : 'tambah');
  formData.append('hari', document.getElementById("hari").value); // Pastikan 'hari' dikirim

  // Debug data yang dikirim
  for (var pair of formData.entries()) {
    console.log(pair[0] + ': ' + pair[1]);
  }

  fetch('admin-xirpl1.php', {
    method: 'POST',
    body: formData
  })
  .then(response => {
    if (!response.ok) {
      throw new Error('Network response was not ok');
    }
    return response.text();
  })
  .then(function(text) {
    isSubmitting = false;
    console.log('Server Response:', text); // Debug respons server
    if (text.trim() === 'success') {
      alert('Jadwal berhasil diperbarui!');
      window.location.reload();
    } else {
      alert('Jadwal berhasil diperbarui!');
      window.location.reload();
    }
  })
  .catch(function(error) {
    isSubmitting = false;
    alert('Terjadi kesalahan: ' + error.message);
  });
});