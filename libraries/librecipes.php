<?php
require_once __DIR__.'/nosql.php';

NoSQL::configure('../_data');

function createRecipe(string $title) {
    $saved = NoSQL::getInstance('recipes')->save(['title' => $title,]);
    return $saved['id'];
}

function getRecipe($id) {
    return NoSQL::getInstance('recipes')->find(strval($id));
}

function getAllRecipes(): array {
    return NoSQL::getInstance('recipes')->all();
}

function deleteAllRecipes() {
    NoSQL::getInstance('grades')->truncate();
    NoSQL::getInstance('recipes')->truncate();
}

function deleteRecipe($id) {
    $recipe = NoSQL::getInstance('recipes')->find(strval($id));
    if(!empty($recipe)) {
        // remove grades
        $grades = array_keys(NoSQL::getInstance('grades')->search('recipe', $id, NoSQL::OP_EQ));
        foreach($grades as $grade) { NoSQL::getInstance('grades')->delete($grade); }
        NoSQL::getInstance('recipes')->delete(strval($id));
    } else {
        throw new Exception('Recipe ID '.$id.' not found');
    }
}

function saveTitle($id, string $title) {
    $recipe = NoSQL::getInstance('recipes')->find(strval($id));
    if(!empty($recipe)) {
        $recipe['title'] = $title;
        NoSQL::getInstance('recipes')->save($recipe);
    } else {
        throw new Exception('Recipe ID '.$id.' not found');
    }
}

function saveIngredients($id, string $ingredients) {
    $recipe = NoSQL::getInstance('recipes')->find(strval($id));
    if(!empty($recipe)) {
        $recipe['ingredients'] = $ingredients;
        NoSQL::getInstance('recipes')->save($recipe);
    } else {
        throw new Exception('Recipe ID '.$id.' not found');
    }
}

function saveSteps($id, string $steps) {
    $recipe = NoSQL::getInstance('recipes')->find(strval($id));
    if(!empty($recipe)) {
        $recipe['steps'] = $steps;
        NoSQL::getInstance('recipes')->save($recipe);
    } else {
        throw new Exception('Recipe ID '.$id.' not found');
    }
}

function savePreptime($id, int $time) {
    $recipe = NoSQL::getInstance('recipes')->find(strval($id));
    if(!empty($recipe)) {
        $recipe['time'] = $time;
        NoSQL::getInstance('recipes')->save($recipe);
    } else {
        throw new Exception('Recipe ID '.$id.' not found');
    }
}

function hasAlreadyRated($recipeId, string $userIp): bool {
    $returns = false;
    $recipe = NoSQL::getInstance('recipes')->find(strval($recipeId));
    if(!empty($recipe)) {
        $foundByIp = NoSQL::getInstance('grades')->search('ip', $userIp, NoSQL::OP_EQ);
        $foundByRecipe = NoSQL::getInstance('grades')->search('recipe', $recipeId, NoSQL::OP_EQ);
        $returns = !empty(array_intersect(array_keys($foundByIp), array_keys($foundByRecipe)));
    } else {
        throw new Exception('Recipe ID '.$recipeId.' not found');
    }
    return $returns;
}

function rateRecipe($recipeId, string $userIp, int $note, string $comment) {
    $recipe = NoSQL::getInstance('recipes')->find(strval($recipeId));
    if(!empty($recipe)) {
        NoSQL::getInstance('grades')->save([
            'recipe' => $recipe['id'],
            'ip' => $userIp,
            'note' => $note,
            'comment' => $comment,
            'date' => date('Y-m-d H:i'),
        ]);
    } else {
        throw new Exception('Recipe ID '.$recipeId.' not found');
    }
}

function searchRecipesByTitle(string $title): array {
    return NoSQL::getInstance('recipes')->search('title', $title, NoSQL::OP_LK);
}

function searchRecipesByIngredient(string $ingredient): array {
    return NoSQL::getInstance('recipes')->search('ingredients', $ingredient, NoSQL::OP_LK);
}

function getRecipeComments($recipeId): array {
    $returns = [];
    $recipe = NoSQL::getInstance('recipes')->find(strval($recipeId));
    if(!empty($recipe)) {
        $returns = NoSQL::getInstance('grades')->search('recipe', $recipeId, NoSQL::OP_EQ);
    } else {
        throw new Exception('Recipe ID '.$recipeId.' not found');
    }
    return $returns;
}
