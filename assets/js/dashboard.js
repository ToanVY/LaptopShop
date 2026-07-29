// assets/js/dashboard.js

// Revenue Chart
const revenueCanvas = document.getElementById("revenueChart");

if (revenueCanvas) {
    new Chart(revenueCanvas, {
        type: "line",
        data: {
            labels: ["T2", "T3", "T4", "T5", "T6", "T7", "CN"],
            datasets: [{
                label: "Doanh thu",
                data: [15, 22, 18, 30, 28, 36, 40],
                borderColor: "#ff6b35",
                backgroundColor: "rgba(255,107,53,.2)",
                fill: true,
                tension: .4
            }]
        }
    });
}

// Order Chart
const orderCanvas = document.getElementById("orderChart");

if (orderCanvas) {
    new Chart(orderCanvas, {
        type: "doughnut",
        data: {
            labels: ["Đã giao", "Đang giao", "Huỷ"],
            datasets: [{
                data: [65, 25, 10],
                backgroundColor: [
                    "#ff6b35",
                    "#198754",
                    "#dc3545"
                ]
            }]
        }
    });
}

// Month Chart
const monthCanvas = document.getElementById("monthChart");

if (monthCanvas) {
    new Chart(monthCanvas, {
        type: "bar",
        data: {
            labels: ["T1", "T2", "T3", "T4", "T5", "T6"],
            datasets: [{
                label: "Doanh thu",
                data: [40, 60, 55, 80, 95, 120],
                backgroundColor: "#ff6b35"
            }]
        }
    });
}

// Top Product
const productCanvas = document.getElementById("productChart");

if (productCanvas) {
    new Chart(productCanvas, {
        type: "bar",
        data: {
            labels: [
                "ROG G16",
                "MacBook",
                "Dell XPS",
                "HP Victus"
            ],
            datasets: [{
                label: "Đã bán",
                data: [120, 95, 80, 60],
                backgroundColor: "#0d6efd"
            }]
        },
        options: {
            indexAxis: "y"
        }
    });
}