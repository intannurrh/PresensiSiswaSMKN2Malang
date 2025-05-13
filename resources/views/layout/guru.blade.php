<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Guru</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f0f4f8;
            min-height: 100vh;
            margin: 0;
        }

        .container {
            display: flex;
            width: 100%;
        }

        .laporan-cards {
            display: flex;
            gap: 1rem;
            margin: 1rem 0 2rem;
            flex-wrap: wrap;
        }

        .laporan-card {
            background-color: white;
            border-left: 6px solid #2196f3;
            border-radius: 0.5rem;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            padding: 1rem 1.5rem;
            flex: 1 1 200px;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .laporan-card i {
            font-size: 1.8rem;
            color: #2196f3;
        }

        .laporan-card.hadir {
            border-left-color: #4caf50;
        }

        .laporan-card.tidak-hadir {
            border-left-color: #f44336;
        }

        .laporan-card.telat {
            border-left-color: #ff9800;
        }

        .crud-btns {
            display: flex;
            gap: 0.5rem;
        }

        .crud-btn {
            font-size: 1.2rem;
            cursor: pointer;
            background: none;
            border: none;
            color: #2196f3;
            transition: color 0.3s ease;
        }

        .crud-btn:hover {
            color: #1565c0;
        }

        .data-siswa-section {
            /* padding: 2rem; */
            width: 100%;
            max-width: 1200px;
            margin: auto;
        }

        .data-siswa-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        .data-siswa-table th,
        .data-siswa-table td {
            padding: 0.75rem;
            text-align: left;
            border-bottom: 1px solid #ccc;
        }

        .data-siswa-table th {
            background-color: #e3f2fd;
        }


        .sidebar {
            width: 220px;
            background-color: #ffffff;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            padding: 2rem 1rem;
            display: flex;
            flex-direction: column;
            gap: 1rem;
            transition: transform 0.3s ease;
            position: fixed;
            height: 100vh;
            left: 0;
            top: 0;
            z-index: 999;
        }

        .sidebar.closed {
            transform: translateX(-100%);
        }

        .sidebar a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            transition: background 0.3s;
        }

        .sidebar a:hover {
            background-color: #e3f2fd;
        }

        .toggle-sidebar {
            position: fixed;
            top: 1rem;
            left: 1rem;
            background-color: #1565c0;
            color: white;
            border: none;
            padding: 0.5rem;
            border-radius: 50%;
            cursor: pointer;
            z-index: 1000;
        }

        .toggle-sidebar.hidden {
            display: none;
        }

        .back-icon {
            position: absolute;
            top: 1rem;
            right: 1rem;
            cursor: pointer;
            font-size: 1.2rem;
            color: #333;
        }

        .main-content {
            margin-left: 0;
            transition: margin-left 0.3s ease;
            width: 100%;
        }

        .sidebar:not(.closed)~.main-content {
            margin-left: 220px;
            width: calc(100% - 220px);
        }

        header {
            padding: 1rem 2rem 1rem 4rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #1565c0;
            color: white;
        }

        .header-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-left: 2.5rem;
        }

        .profile-icon {
            font-size: 1.5rem;
            cursor: pointer;
        }

        .dashboard-section,
        .laporan-section {
            /* padding: 2rem; */
            width: 100%;
            max-width: 1200px;
            margin: auto;
            /* display: none; */
        }

        .active-section {
            display: block;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        th,
        td {
            padding: 0.75rem;
            text-align: left;
            border-bottom: 1px solid #ccc;
        }

        th {
            background-color: #e3f2fd;
        }

        .filter-controls {
            margin: 1rem 0;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 0.5rem;
        }

        .filter-controls input[type="date"],
        .filter-controls input[type="text"] {
            padding: 0.5rem;
            font-size: 1rem;
        }

        .download-btn,
        .crud-btn {
            background-color: #2196f3;
            color: white;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 0.5rem;
            cursor: pointer;
        }

        .crud-btn {
            margin-left: 0.5rem;
        }

        footer {
            text-align: center;
            padding: 1rem;
            color: #fff;
            font-size: 0.9rem;
            background-color: #1565c0;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
            }

            header {
                padding-left: 3.5rem;
            }

            .header-title {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        {{-- sidebar --}}
        @include('part.sidebar')


        <div class="main-content" id="mainContent">
            {{-- header --}}
            @include('part.header')

            <!-- Dashboard Section -->

            @yield('content')

            {{-- footer --}}
            @include('part.footer')

        </div>
    </div>

    <script>
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
    </script>
</body>

</html>
