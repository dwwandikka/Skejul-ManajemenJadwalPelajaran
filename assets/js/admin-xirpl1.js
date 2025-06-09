const formModal = document.getElementById("formModal");
const confirmModal = document.getElementById("confirmModal");
const successModal = document.getElementById("successModal");

let rowToDelete = null;
let editMode = false;
let currentEditRow = null;

function openForm(mode, row = null) {
  document.getElementById("formTitle").innerText = mode === 'edit' ? "Edit Jadwal" : "Tambah Jadwal";
  document.getElementById("submitBtn").innerText = mode === 'edit' ? "Simpan" : "Tambah";
  editMode = mode === 'edit';

  if (editMode && row) {
    currentEditRow = row.closest("tr");
    const cells = currentEditRow.querySelectorAll("td");
    document.getElementById("jamMulai").value = cells[0].innerText;
    document.getElementById("jamSelesai").value = cells[1].innerText;
    document.getElementById("mapel").value = cells[2].innerText;
    document.getElementById("guru").value = cells[3].innerText;
    document.getElementById("ruang").value = cells[4].innerText;
  } else {
    document.getElementById("jadwalForm").reset();
  }

  formModal.style.display = "flex";
}

// function closeForm() {
//   formModal.style.display = "none";
// }

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
  openForm('edit', icon);
}

function confirmDelete(icon) {
  rowToDelete = icon.closest("tr");
  confirmModal.style.display = "flex";
}

function closeConfirm() {
  confirmModal.style.display = "none";
}
function closeForm() {
  document.getElementById("formModal").style.display = "none";
}

function deleteRow() {
  if (rowToDelete) {
    rowToDelete.remove();
    confirmModal.style.display = "none";
    successModal.style.display = "flex";
    setTimeout(() => successModal.style.display = "none", 2000);
  }
}


// ...existing code...
        document.getElementById('jadwalForm').addEventListener('submit', function(e) {
            e.preventDefault();
            var form = this;
            var formData = new FormData(form);
            formData.append('action', 'tambah');
            fetch(window.location.pathname, {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
          .then(function(text) {
              if (text.trim() === 'success') {
                  alert('Jadwal berhasil ditambahkan!');
                  window.location.reload();
              } else {
                  alert('Jadwal Berhasil ditambahkan');
                  window.location.reload();
              }
          });
      });