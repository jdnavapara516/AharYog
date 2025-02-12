const startScanButton = document.getElementById('start-scan');
const resultContainer = document.getElementById('result-container');
const healthConditionInput = document.getElementById('health-condition');
const productRatingCanvas = document.getElementById('product-rating');

startScanButton.addEventListener('click', () => {
    startBarcodeScan();
});

function startBarcodeScan() {
    // Initialize the camera and start scanning
    Quagga.init({
        inputStream: {
            name: "Live",
            type: "LiveStream",
            target: document.getElementById('scanner-container'),
        },
        decoder: {
            readers: ["ean_reader"],
        },
    }, function(err) {
        if (err) {
            console.error("Error initializing Quagga:", err);
            return;
        }
        Quagga.start();
    });

    Quagga.onDetected(function(result) {
        const barcode = result.codeResult.code;
        Quagga.stop();
        fetchProductDetails(barcode);
    });
}

function fetchProductDetails(barcode) {
    fetch('fetch_product.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ barcode }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            analyzeFoodQuality(data.product, healthConditionInput.value);
        } else {
            alert('Product not found!');
        }
    })
    .catch(err => console.error("Error fetching product details:", err));
}

function analyzeFoodQuality(product, healthCondition) {
    fetch('analyze_food.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ product, healthCondition }),
    })
    .then(response => response.json())
    .then(data => {
        displayProductRating(data.rating);
    })
    .catch(err => console.error("Error analyzing food quality:", err));
}

function displayProductRating(rating) {
    const ctx = productRatingCanvas.getContext('2d');
    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Product Rating'],
            datasets: [{
                label: 'Rating out of 5',
                data: [rating],
                backgroundColor: 'rgba(75, 192, 192, 0.6)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    max: 5
                }
            }
        }
    });
}