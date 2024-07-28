<script>
document.getElementById('viewActiveRequests').addEventListener('click', function() {
    fetch('get_fuel_readings.php')
        .then(response => response.json())
        .then(data => {
            const tableBody = document.getElementById('fuelReadingsTable');
            tableBody.innerHTML = '';

            if (data.length > 0) {
                data.forEach(row => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td>${row.employee_id}</td>
                        <td>${row.vehicle_id}</td>
                        <td>${row.phone_number}</td>
                        <td>${row.detected_reading}</td>
                        <td>${row.created_at}</td>
                    `;
                    tableBody.appendChild(tr);
                });
            } else {
                const tr = document.createElement('tr');
                tr.innerHTML = '<td colspan="5">No records found</td>';
                tableBody.appendChild(tr);
            }

            // Show the table
            document.getElementById('fuelReadingsContainer').style.display = 'block';
        })
        .catch(error => console.error('Error fetching data:', error));
});
</script>
