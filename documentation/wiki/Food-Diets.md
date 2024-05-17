# Food Diets

This are the diets we recommend for the different types of goals users have.

The goals are:
- lose_weight
- maintain_weight
- gain_weight
- muscle_gain

Diet example:
(durable)
```json
{
   "carb":55,
   "protein":15,
   "fat":30,
   "name":"Durable",
   "description":"This diet will help you lose weight with lasting results, allowing you to slim gradually while getting all the necessary nutrients. This diet is based on balanced, healthy foods in combination with a lowered energy and fats intake.",
   "type":"lose_weight",
   "select":"lose_weight"
}
```

The carb, protein and fat values are percentage goals of the way the total kcal consumption of the users should be like.
The "select" value, if this is set this is the recommended plan for the goal type. So if the user would choose to lose weight this diet will be recommended.