<?php
// This file defines necessary types or interfaces for the project

// Define a type for product details retrieved from the Open Food Facts API
interface ProductDetails {
    public function getName(): string;
    public function getBrand(): string;
    public function getIngredients(): string;
    public function getNutrition(): string;
    public function getAllergens(): string;
    public function getPackaging(): string;
    public function getCountries(): string;
    public function getLabels(): string;
    public function getCategories(): string;
    public function isHealthy(): string;
    public function getQuantity(): string;
    public function getBarcode(): string;
    public function getBrandsText(): string;
    public function getIngredientsText(): string;
    public function getImageUrl(): string;
    public function getUrl(): string;
}

// Define a type for user health conditions
interface UserHealthCondition {
    public function getCondition(): string;
}

// Define a type for the analysis result from OpenAI API
interface AnalysisResult {
    public function getRating(): float;
    public function getComments(): string;
}
?>