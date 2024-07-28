document.addEventListener('DOMContentLoaded', function() {
    const authUrl = 'https://api.onupkeep.com/api/v2/auth';
    const workOrdersUrl = 'https://api.onupkeep.com/api/v2/work-orders';
    const email = 'abhishekpingale27@gmail.com'; // Replace with your email
    const password = 'XLVN8g7e8h@uYJW'; // Replace with your password

    // Function to authenticate and get the API token
    function authenticate() {
        return fetch(authUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ email, password })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Authentication failed');
            }
            return response.json();
        })
        .then(data => data.token)
        .catch(error => {
            console.error('There has been a problem with your fetch operation:', error);
        });
    }

    // Function to fetch work orders using the API token
    function fetchWorkOrders(token) {
        return fetch(workOrdersUrl, {
            method: 'GET',
            headers: {
                'Authorization': `Bearer ${token}`,
                'Content-Type': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => data)
        .catch(error => {
            console.error('There has been a problem with your fetch operation:', error);
        });
    }

    // Function to display work orders in the HTML
    function displayWorkOrders(workOrders) {
        const workOrdersContainer = document.getElementById('work-orders');
        workOrdersContainer.innerHTML = '';

        workOrders.forEach(order => {
            const orderElement = document.createElement('div');
            orderElement.className = 'work-order';
            orderElement.innerHTML = `
                <h2>Work Order #${order.id}</h2>
                <p>Status: ${order.status}</p>
                <p>Description: ${order.description}</p>
            `;
            workOrdersContainer.appendChild(orderElement);
        });
    }

    // Authenticate and fetch work orders when the page loads
    authenticate().then(token => {
        if (token) {
            fetchWorkOrders(token).then(workOrders => {
                if (workOrders) {
                    displayWorkOrders(workOrders);
                }
            });
        }
    });
});
