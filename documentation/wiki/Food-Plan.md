# Food Plan

|Method|URL|Info|URL-params|
|---|---|---|---|
|GET|/api/v0/food/plan|Returns an array of food plans of the user||
|PUT|/api/v0/food/plan|Insert a new food plan||
|PUT|/api/v0/food/plan/`<plan_id>`|Update an existing food plan||

**STRUCTURE**

|Field|Type|Optional|In put request|Values|Information|
|---|---|---|---|---|---|
|id|int|no|no| |Food plan id|
|diet_id|string|no|yes| |Refers to a diet found in [[Food-Diets]]|
|pref_weight|int|no|yes| |The weight goal in the user's unit.|
|calories|int|no|yes| |The daily calorie advice|
|protein|int|yes|yes| |the daily amount of protein adviced in grams|
|fats|int|yes|yes| |the daily amount of fats adviced in grams|
|carbs|int|yes|yes| |the daily amount of carbs adviced in grams|
|daily_need|int|no|yes| |The amount of calories needed to maintain the current weight|
|start_date|int|no|yes| |the start date of this plan|
|end_date|int|no|yes| |the end date of this plan|
|workhours|int|no|yes| |the amount of hours of work per day|
|workdays|int|no|yes| |the amount of work days per week|
|sleeptime|int|no|yes| |hours of sleep per day|
|active_type|int|no|yes| |0 = not active, 1 = semi active, 2 = very active|
|work_type|int|no|yes| |0 = no work, 1 = office work, 2 = standing work light, 3 = standing work average, 4 = standing work heavy|
|timestamp_created|timestamp|no|yes| |Timestamp of when this plan instance has been created|
|timestamp_edit|timestamp|no|yes| |Timestamp of the last edit|

```java
    /**
     * Calculates the BMR. BMR is the amount of kcal you need to maintain weight in a day when you don't do anything
     * @param isMale
     * @param age in years
     * @param weight in kg
     * @return bmr
     */
    public static long calculateBMR(boolean isMale, int age, double weight) {

        class BMRtableData {
            BMRtableData(int age, double multiplier, int plus) {
                this.age = age;
                this.multiplier = multiplier;
                this.plus = plus;
            }

            public int age;
            public double multiplier;
            public int plus;
        }

        List<BMRtableData> BMRdataList = new ArrayList<BMRtableData>();

        if(isMale) {
            //enter the male data to the list
            BMRdataList.add(new BMRtableData(3, 60.9, -54));
            BMRdataList.add(new BMRtableData(10, 22.7, 495));
            BMRdataList.add(new BMRtableData(18, 17.5, 651));
            BMRdataList.add(new BMRtableData(29, 15.3, 679));
            BMRdataList.add(new BMRtableData(59, 11.6, 879));
            BMRdataList.add(new BMRtableData(74, 11.9, 700));
            BMRdataList.add(new BMRtableData(999, 8.4, 820));
        } else {
            //female data
            BMRdataList.add(new BMRtableData(3, 61.0, -51));
            BMRdataList.add(new BMRtableData(10, 22.5, 499));
            BMRdataList.add(new BMRtableData(18, 12.2, 746));
            BMRdataList.add(new BMRtableData(29, 14.7, 496));
            BMRdataList.add(new BMRtableData(59, 8.7, 829));
            BMRdataList.add(new BMRtableData(74, 9.2, 688));
            BMRdataList.add(new BMRtableData(999, 9.8, 624));
        }

        for (BMRtableData data : BMRdataList) {
            if(data.age > age)
            {
                return Math.round(data.multiplier * weight + data.plus);
            }
        }
        
        return 0;
    }

  /**
     * Calculates the amount of kcal the user needs to consume to maintain his current weight, based on the given values.
     * @param bmr
     * @param workType
     * @param activityType
     * @param workDays
     * @param workHours
     * @param sleepHours
     * @return daily kcal need
     */
    public static long calculateDailyKcal(long bmr, int workType, int activityType, int workDays, int workHours, int sleepHours) {
        double workHoursPerDay = 0;
        double workActivity = 0;
        double baseActivity = 0;

        if(workType != 0) {
            workHoursPerDay = (double)(workDays * workHours) / 7;

            switch (workType) {
                case 1: //office work
                    workActivity = 1.5 * workHoursPerDay;
                    break;
                case 2: //standing work light
                    workActivity = 1.9 * workHoursPerDay;
                    break;
                case 3: // standing work average
                    workActivity = 2.25 * workHoursPerDay;
                    break;
                case 4: //standing work hard
                    workActivity = 2.5 * workHoursPerDay;
                    break;
            }
        }

        switch (activityType) {
            case 0:
                //not active
                baseActivity = 1.5 * (24 - workHoursPerDay - sleepHours);
                break;
            case 1:
                //semi active
                baseActivity = 1.75 * (24 - workHoursPerDay - sleepHours);
                break;
            case 2:
                //very active
                baseActivity = 2 * (24 - workHoursPerDay - sleepHours);
                break;
        }

        double sleepActivity = sleepHours * 0.9;

        double pal = ((sleepActivity + workActivity + baseActivity) / 24);

        return Math.round(bmr * pal);
    }

  /**
     * Calculates the daily amount of kcal the user should consume to reach his goal at the goalDate
     * @param goalType
     * @param weightDif
     * @param dailyKcal
     * @param goalDate
     */
    public static long calculateKcalGoal(int goalType, double weightDif, long dailyKcal, Date goalDate) {
        long daysToGoal = daysBetween(new Date(), goalDate);

        if(daysToGoal == 0) daysToGoal = 1;
        long kcalDif = 0;

        if(goalType != 1) //not maintain weight
            kcalDif = Math.round((weightDif * 7000) / daysToGoal);

        //goalType = lose weight
        return (goalType == 0) ? dailyKcal-kcalDif : dailyKcal+kcalDif;
    }
```

**Calculating the week score**

```java
   /**
     * Calculates the score of the day for a specific nutrition value.
     * Nutrition values can come from kcal, protein, fats and carbs. Kcal should always have a maxPerfectValue of 20, others 10
     * @param nutritionGrams the amount of grams eaten of this nutrition
     * @param nutritionGramsGoal the amount of grams that should be eaten
     * @param maxPerfectValue for every nutrition this is 15% of the nutritionGramsGoal, except for kcal, that has to be 120
     * @param maxScore Kcal should always have a maxPerfectValue of 20, others 10
     * @return
     */
    public double calcDayScore(double nutritionGrams, double nutritionGramsGoal, double maxPerfectValue, double maxScore)
    {
        double score = 0.0;

        if(nutritionGrams == 0.0)
        {
            score = 0;
        }
        else if((nutritionGrams > (nutritionGramsGoal - maxPerfectValue)) && (nutritionGrams < (nutritionGramsGoal + maxPerfectValue)))
        {
            score = maxScore;

        }
        else if(nutritionGrams < (nutritionGramsGoal - maxPerfectValue))
        {
            //prevent devision by 0
            if(maxScore == 0) maxScore = 0.01;
            if((nutritionGramsGoal + maxPerfectValue) == 0) maxPerfectValue = 0.01;

            score = ( 1 / (Math.pow(1 - (nutritionGrams / (nutritionGramsGoal - maxPerfectValue)), 2) * 5 + 1 / maxScore));
        }
        else if(nutritionGrams > (nutritionGramsGoal + maxPerfectValue))
        {
            //prevent devision by 0
            if(maxScore == 0) maxScore = 0.01;
            if((nutritionGramsGoal + maxPerfectValue) == 0) maxPerfectValue = 0.01;

            score = ( 1 / (Math.pow(1 - (nutritionGrams / (nutritionGramsGoal + maxPerfectValue)), 2) * 5 + 1 / maxScore));
        }

        return score;
    }

    //The week score, totalScore is all the scores of all 7 days summed up
    double weekScore = 10 * (((totalScore / (daysWithCalories * 5))));
```