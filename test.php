<?php

// Include Composer's autoloader
require 'vendor/autoload.php';

use Phpml\Association\Apriori;
use Phpml\ModelManager;

// Sample dataset
$dataset = [
    ['bread', 'milk'],
    ['bread', 'butter', 'cheese'],
    ['bread', 'jam', 'butter'],
    ['bread', 'milk', 'butter'],
    ['bread', 'milk', 'jam'],
    ['butter', 'jam']
];

// Instantiate the Apriori algorithm
$apriori = new Apriori();

// Train the model with the dataset
$apriori->train($dataset, []);

// Save the trained model
$modelManager = new ModelManager();
$modelManager->saveToFile($apriori, 'apriori.model');

// Load the trained model
$apriori = $modelManager->restoreFromFile('apriori.model');

// Get association rules
$rules = $apriori->getRules();

// Process rules to provide recommendations
foreach ($rules as $rule) {
    $antecedent = $rule[0];
    $consequent = $rule[1];
    
    echo implode(', ', $antecedent) . ' => ' . implode(', ', $consequent) . PHP_EOL;
}
?>
