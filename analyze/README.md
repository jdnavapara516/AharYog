# Barcode Scanner Project

## Overview
The Barcode Scanner Project is a web application that allows users to scan food package barcodes using their device's camera. The application retrieves product details from the Open Food Facts API and analyzes the food quality based on user-defined health conditions using the OpenAI API. The results are displayed in a user-friendly format, including a graphical representation of the product rating out of 5.

## Features
- **Barcode Scanning**: Initiate the camera to scan barcodes on food packages.
- **Product Information Retrieval**: Fetch product details from the Open Food Facts API.
- **Health Analysis**: Analyze food quality based on user health conditions using the OpenAI API.
- **Graphical Representation**: Display results in a graph format with product ratings.

## Project Structure
```
barcode-scanner-project
├── src
│   ├── index.php            # Main entry point of the application
│   ├── scan.php             # Handles barcode scanning functionality
│   ├── fetch_product.php     # Processes API response from Open Food Facts
│   ├── analyze_food.php      # Analyzes food quality using OpenAI API
│   ├── assets
│   │   ├── css
│   │   │   └── styles.css    # CSS styles for the application
│   │   ├── js
│   │   │   └── scripts.js     # JavaScript for user interactions
│   │   └── images            # Directory for images used in the project
│   └── types
│       └── index.php         # Defines types or interfaces for the project
├── package.json              # npm configuration file
├── tsconfig.json             # TypeScript configuration file
└── README.md                 # Project documentation
```

## Installation
1. Clone the repository:
   ```
   git clone <repository-url>
   ```
2. Navigate to the project directory:
   ```
   cd barcode-scanner-project
   ```
3. Install dependencies:
   ```
   npm install
   ```

## Usage
1. Open `src/index.php` in a web browser.
2. Click the "Start Scan" button to initiate the barcode scanning process.
3. Allow camera access when prompted.
4. Scan a food package barcode.
5. Enter any relevant health conditions.
6. View the product details and health analysis results displayed in a graph format.

## Contributing
Contributions are welcome! Please submit a pull request or open an issue for any enhancements or bug fixes.

## License
This project is licensed under the MIT License. See the LICENSE file for details.