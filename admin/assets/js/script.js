document.addEventListener('DOMContentLoaded', function () {
    const yearSelect = document.getElementById('yearSelect');
    const updateButton = document.getElementById('updateButton');
    const tableContainer = document.getElementById('tableContainer');

    // Function to fetch sales data for a given year
    async function fetchSalesData(year) {
        const response = await fetch(`fetch_sales.php?year=${year}`);
        const data = await response.json();
        return data;
    }

    // Function to update chart data and table
    async function updateChartAndTable(year) {
        const data = await fetchSalesData(year);
        const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        const labels = [];
        const values = [];

        data.forEach(item => {
            const monthIndex = item.month - 1;
            labels.push(months[monthIndex]);
            values.push(item.total_sales);
        });

        // Update chart
        chart.data.labels = labels;
        chart.data.datasets[0].data = values;
        chart.update();

        // Create table
        createTable(data);
    }

    // Function to create table
    function createTable(data) {
        let tableHtml = '<table><tr><th>Month</th><th>Total Sales</th></tr>';
        const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        data.forEach(item => {
            tableHtml += `<tr><td>${months[item.month - 1]}</td><td>${item.total_sales}</td></tr>`;
        });

        tableHtml += '</table>';
        tableContainer.innerHTML = tableHtml;
    }

    // Event listener for the update button
    updateButton.addEventListener('click', function () {
        const selectedYear = yearSelect.value;
        updateChartAndTable(selectedYear);
    });

    // Initial chart setup
    const ctx = document.getElementById('salesChart').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [],
            datasets: [{
                label: 'Total Sales',
                data: [],
                backgroundColor: 'rgba(75, 192, 192, 0.2)', // Default bar color
                borderColor: 'rgba(75, 192, 192, 1)', // Default bar border color
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function (context) {
                            var label = context.dataset.label || '';

                            if (label) {
                                label += ': ';
                            }
                            if (context.parsed.y !== null) {
                                label += new Intl.NumberFormat().format(context.parsed.y);
                            }
                            return label;
                        }
                    }
                }
            }
        }
    });

    // Populate the year select options and initialize the chart
    const currentYear = new Date().getFullYear();
    for (let year = currentYear - 3; year <= currentYear; year++) {
        const option = document.createElement('option');
        option.value = year;
        option.textContent = year;
        yearSelect.appendChild(option);
    }
    yearSelect.value = currentYear;
    updateChartAndTable(currentYear);
});
