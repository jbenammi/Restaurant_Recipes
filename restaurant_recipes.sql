SELECT * FROM restaurant_recipies.ingredients;

INSERT INTO ingredients(name, usda_number, ingr_category_id, uom_categories_id, created_on, updated_on) 
VALUES('Roma Tomato', '11529', '1', '1', now(), now());

SELECT ingredients.name, usda_number, uom_categories.category FROM ingredients
JOIN ingr_categories
ON ingr_categories.id = ingredients.ingr_category_id
JOIN uom_categories
ON ingredients.uom_categories_id = uom_categories.id;

SELECT id AS ingr_cat_id, category AS ingr_category FROM ingr_categories;