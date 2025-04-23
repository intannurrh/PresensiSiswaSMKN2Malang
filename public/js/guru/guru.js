function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const toggleBtn = document.getElementById('sidebarToggle');
    sidebar.classList.toggle('closed');
    toggleBtn.classList.toggle('hidden');
}

function downloadCSV() {
    const rows = document.querySelectorAll("#attendance-table tr");
    let csv = [];
    for (let row of rows) {
        let cols = row.querySelectorAll("td, th");
        let rowData = [];
        for (let col of cols) {
            rowData.push(col.innerText);
        }
        csv.push(rowData.join(","));
    }
    const blob = new Blob([csv.join("\n")], { type: "text/csv" });
    const url = URL.createObjectURL(blob);
    const a = document.createElement("a");
    a.href = url;
    a.download = "rekapan_kehadiran.csv";
    a.click();
}

function handleRoute() {
    const hash = window.location.hash;
    document.getElementById('dashboard').classList.remove('active-section');
    document.getElementById('laporan').classList.remove('active-section');

    if (hash === '#/laporan') {
        document.getElementById('laporan').classList.add('active-section');
    } else {
        document.getElementById('dashboard').classList.add('active-section');
    }
}

window.addEventListener("hashchange", handleRoute);
window.addEventListener("load", handleRoute);

document.getElementById('search-input').addEventListener('input', function () {
    const searchValue = this.value.toLowerCase();
    const rows = document.querySelectorAll('#attendance-table tbody tr');
    rows.forEach(row => {
        const name = row.children[0].textContent.toLowerCase();
        row.style.display = name.includes(searchValue) ? '' : 'none';
    });
});

document.getElementById('filter-date').addEventListener('input', function () {
    const selectedDate = this.value;
    const rows = document.querySelectorAll('#attendance-table tbody tr');
    rows.forEach(row => {
        const date = row.children[2].textContent;
        row.style.display = !selectedDate || date === selectedDate ? '' : 'none';
    });
});

let students = [
    { id: 1, name: 'Budi Santoso', kelas: '10A' },
    { id: 2, name: 'Siti Aminah', kelas: '10B' },
];

function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const toggleBtn = document.getElementById('sidebarToggle');
    sidebar.classList.toggle('closed');
    toggleBtn.classList.toggle('hidden');
}

function handleRoute() {
    const hash = window.location.hash;
    document.getElementById('dashboard').classList.remove('active-section');
    document.getElementById('laporan').classList.remove('active-section');
    document.getElementById('data-siswa').classList.remove('active-section');

    if (hash === '#/laporan') {
        document.getElementById('laporan').classList.add('active-section');
    } else if (hash === '#/data-siswa') {
        document.getElementById('data-siswa').classList.add('active-section');
        renderStudents();
    } else {
        document.getElementById('dashboard').classList.add('active-section');
    }
}

window.addEventListener("hashchange", handleRoute);
window.addEventListener("load", handleRoute);

function renderStudents() {
    const tbody = document.getElementById('data-siswa-body');
    tbody.innerHTML = '';

    students.forEach(student => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
  <td>${student.name}</td>
  <td>${student.kelas}</td>
  <td class="crud-btns">
  <button class="crud-btn" onclick="addStudent(${student.id})" title="Tambah"><i class="fas fa-add"></i></button>
    <button class="crud-btn" onclick="editStudent(${student.id})" title="Edit"><i class="fas fa-edit"></i></button>
    <button class="crud-btn" onclick="deleteStudent(${student.id})" title="Hapus"><i class="fas fa-trash"></i></button>
  </td>
`;
        tbody.appendChild(tr);
    });
}

function addStudent() {
    const name = prompt("Masukkan nama siswa:");
    const kelas = prompt("Masukkan kelas siswa:");

    if (name && kelas) {
        const newStudent = { id: Date.now(), name, kelas };
        students.push(newStudent);
        renderStudents();
    }
}

function editStudent(id) {
    const student = students.find(student => student.id === id);
    if (student) {
        const newName = prompt("Edit nama siswa:", student.name);
        const newKelas = prompt("Edit kelas siswa:", student.kelas);
        if (newName && newKelas) {
            student.name = newName;
            student.kelas = newKelas;
            renderStudents();
        }
    }
}

function deleteStudent(id) {
    const index = students.findIndex(student => student.id === id);
    if (index !== -1) {
        if (confirm("Apakah Anda yakin ingin menghapus siswa ini?")) {
            students.splice(index, 1);
            renderStudents();
        }
    }
}

let attendanceData = [
    { id: 1, name: 'Budi Santoso', status: 'Hadir', date: '2025-04-22', time: '07:15' },
    { id: 2, name: 'Siti Aminah', status: 'Tidak Hadir', date: '2025-04-22', time: '-' },
];

function renderAttendance() {
    const tbody = document.getElementById('attendance-body');
    tbody.innerHTML = '';

    attendanceData.forEach(data => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
<td>${data.name}</td>
<td>${data.status}</td>
<td>${data.date}</td>
<td>${data.time}</td>
<td class="crud-btns">
<button class="crud-btn" onclick="deleteAttendance(${data.id})" title="Hapus">
  <i class="fas fa-trash"></i>
</button>
</td>
`;
        tbody.appendChild(tr);
    });
}

function deleteAttendance(id) {
    const index = attendanceData.findIndex(data => data.id === id);
    if (index !== -1) {
        if (confirm("Apakah Anda yakin ingin menghapus data kehadiran ini?")) {
            attendanceData.splice(index, 1);
            renderAttendance();
        }
    }
}

// render ketika masuk ke halaman laporan
function handleRoute() {
    const hash = window.location.hash;
    document.getElementById('dashboard').classList.remove('active-section');
    document.getElementById('laporan').classList.remove('active-section');
    document.getElementById('data-siswa').classList.remove('active-section');

    if (hash === '#/laporan') {
        document.getElementById('laporan').classList.add('active-section');
        renderAttendance();
    } else if (hash === '#/data-siswa') {
        document.getElementById('data-siswa').classList.add('active-section');
        renderStudents();
    } else {
        document.getElementById('dashboard').classList.add('active-section');
    }
}
