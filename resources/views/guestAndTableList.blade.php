<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guest and Table Management</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container my-4">
    <h1 class="text-center">Guest and Table Management</h1>
    <div class="row mt-4">
        <div class="col-md-6">
            <h2>Guest List</h2>
            <table class="table table-striped" id="guestList">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Table Number</th>
                        <th>Is Present</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
        <div class="col-md-6">
            <h2>Table List</h2>
            <table class="table table-striped" id="tableList">
                <thead>
                    <tr>
                        <th>Table Number</th>
                        <th>Description</th>
                        <th>Seats</th>
                        <th>Guests</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        fetchGuests();
        fetchTables();
    });

    async function fetchGuests() {
        try {
            const response = await fetch('/api/guest_lists');
            const guests = await response.json();
            const guestList = document.getElementById('guestList').querySelector('tbody');
            guestList.innerHTML = '';
            guests.forEach(guest => {
                const tableNum = guest.table ? guest.table.num : 'N/A';
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${guest.name}</td>
                    <td>${tableNum}</td>
                    <td>${guest.is_present ? 'Yes' : 'No'}</td>
                    <td><button class="btn btn-danger btn-sm" onclick="deleteGuest(${guest.id})">Delete</button></td>
                `;
                guestList.appendChild(row);
            });
        } catch (error) {
            console.error('Error fetching guest data:', error);
        }
    }

    async function fetchTables() {
        try {
            const response = await fetch('/api/tables');
            const tables = await response.json();
            const tableList = document.getElementById('tableList').querySelector('tbody');
            tableList.innerHTML = '';
            tables.forEach(table => {
                const guests = table.guests && table.guests.length > 0 ? table.guests.map(guest => `<li>${guest.name}</li>`).join('') : 'No guests';
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${table.num}</td>
                    <td>${table.description}</td>
                    <td>${table.maxGuests}</td>
                    <td><ul>${guests}</ul></td>
                `;
                tableList.appendChild(row);
            });
        } catch (error) {
            console.error('Error fetching table data:', error);
        }
    }

    async function deleteGuest(id) {
        if (!confirm('Are you sure you want to delete this guest?')) return;
        try {
            const response = await fetch(`/api/guest_lists/${id}`, { method: 'DELETE' });
            if (response.ok) {
                fetchGuests();
            } else {
                console.error('Failed to delete guest');
            }
        } catch (error) {
            console.error('Error deleting guest:', error);
        }
    }
</script>
</body>
</html>
