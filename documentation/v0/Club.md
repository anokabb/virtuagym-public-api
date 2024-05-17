# Club

|Method|URL|Info|URL-params|
|---|---|---|---|
|GET|/api/v0/club|Returns array of clubs associated with the user, skips locked clubs|sync_from (timestamp)|
|GET|/api/v0/club/`<club_id>`|Returns the club with the given id||
|GET|/api/v0/club/`<club_id>`/map|Return an image id of the map of the club location|width (default 1024), height (default 1024), zoomlevel (default 14)|

**STRUCTURE Club**

|Field|Type|Optional|Values|Information|
|---|---|---|---|---|
|id|int| | |Club id|
|url_id|string| | |Club url id|
|name|string| | |Name of the club|
|fb_page|string|yes| |Absolute URL to the facebook page of the club|
|pro_link|string|yes| |Relative URL of the clubs pro-membership page|
|description|string|yes| |The clubs description (editable in the manager panel)|
|logo|string|yes| |Absolute URL of the club's logo, possibly transparent (to be shown in front of the gradient)|
|avatar|string|yes| |Absolute URL of the club's avatar/print logo|
|domain|string| | |Domainname of the club (e.g. clubtest.test.your-lifestyle.com). Use this to prepend to the relative links (like classes).|
|background|string|yes| |Absolute URL of the background of the clublogo. If given, don't show gradient.|
|color|string|yes|a1a1a1|The default club color (e.g. ffffff for white)|
|gradient_dark|string|yes|a1a1a1|The dark club color (used for gradient behind logo)|
|gradient_light|string|yes|a1a1a1|The light club color (used for gradient behind logo)|
|classes_link|string|yes| |Relative URL to the classplanner (only given if class registration module is enabled!)|
|club_info_link|string|yes| |Relatie URL to information about the club(not implemented yet!)|
|android_application_id|string|no| |Android package id of the custom app of the club|
|ios_app_id|string|no| |Ios app id of the custom app of the club|
|opening_periods|array|yes| |Array of opening periods (structure specified below)|
|opening_notes|string|yes| |Manual club notes regarding the opening hours|
|country_code|string|no| |two letter country code|
|street_name|string|no| |Street name of the club location|
|-street_nr-|-string-|-yes- (deprecated)| |-Street number of the club location including street number addition-|
|zipcode|string|yes| |Zipcode of the club location|
|city|string|yes| |City of the club location|
|website|string|yes| |link to the website of the club|
|email|string|yes| |club email address|
|phone|string|yes| |Club phone number|
|gps_location|json object|no| |gps location(obj with lat and lng properties) of the club|
|accent_color|string|yes|016eff|The color used for the accents and buttons|
|formatted_address|string|no| |Formatted address of the club|
|lang|string|no|en,nl,de,pt,es,fr|Club default language|
|club_info_cover_image|string|yes| |Portal group image|
|portal_group_id|int|no| |Portal group id|
|features|array| | |Array with features (false/true)|
|enabled_devices|array| | |Array with only the enabled devices|
|timestamp_edit|timestamp| | |Timestamp of last edit|
|is_nonfitness|boolean|yes|true or false|Is non fitness club|
|superclub_id|string|yes|12345|yes|ID of the superclub| 
|is_freemium_coaching|boolean|yes|true or false|Free app enabled or not (default is false)| 
|currency_sign| |yes| |Which type of currency is used|

**STRUCTURE Opening periods**

|Field|Type|Optional|Values|Information|
|---|---|---|---|---|
|day|int| |1..7|1=Monday, ... , 7=Sunday Please note that there may be two or more of the same days because the club can be open in the morning then close and open again in the evening, see the example|
|start|string| |14:00:00|Time of period start(24 hour notation, ISO 8601)|
|end|string| |23:00:00|Time of period end(24 hour notation, ISO 8601)|

**Features**

|Field|Type|Values|Default|Description|
|---|---|---|---|---|
|enable_qrcodes|boolean|true/false|false|if club is using QR codes|
|enable_nutrition|boolean|true/false|true|If the nutrition WEB app is enabled|
|enable_community|boolean|true/false|true|If the community is enabled|
|enable_training|boolean|true/false|true|If the workout/training WEB app is enabled|
|enable_progress_tracker|boolean|true/false|true|If the progress tracker WEB app is enabled|
|enable_activity_calendar|boolean|true/false|true|If the activity calendar WEB app is enabled|
|enable_challenges|boolean|true/false|true|If the challenges WEB app is enabled|
|enable_plan_creation|boolean|true/false|true|if clients are able to create their own plans|
|enable_platform_plans|boolean|true/false|false|show platform plans|
|enable_club_plans|boolean|true/false|false|if club has club plans|
|enable_club_challenges|boolean|true/false|false|show club challenges (todo)|
|enable_club_picker|boolean|true/false|false|show club picklist|
|enable_club_picker_add_club|boolean|true/false|false|show 'add club' in club picklist|
|enable_custom_homescreen|int|no|0,1|0 if club doens't use a custom homescreen, 1 if the club uses a custom homescreen|
|enable_custom_menu|int|no|0,1|0 if club doens't use a custom app menu, 1 if the club uses a custom app menu|
|enable_extra_calories|boolean|true/false|true|true if the nutrition plan should count extra calories burnt with activities, false if nutrition should ignore extra burnt calories|

Example:
```json
{
  "statuscode": 200,
  "statusmessage": "Everything OK",
  "result_count": 33,
  "timestamp": 1440668888,
  "result": {
    "id": 55,
    "url_id": "club-test-rotterdam-puntegaalstraat",
    "name": "Club Test",
    "domain": "clubtest.dev.virtuagym.com",
    "gradient_dark": "1b50c0",
    "gradient_light": "8e9be6",
    "accents_buttons": "d31b71",
    "club_info_link": "/club/club-test-rotterdam-puntegaalstraat",
    "pro_link": "/club/club-test-rotterdam-puntegaalstraat/getpro",
    "timestamp_edit": 1440664080,
    "street_name": "Puntegaalstraat 75",
    "country_code": "NL",
    "formatted_address": "Puntegaalstraat 75, 3024 EB Rotterdam, Nederland",
    "lang": "es",
    "gps_location": {
      "lat": "51.9071429",
      "lng": "4.4629284"
    },
    "android_application_id": "digifit.android.virtuagym.pro.cityfitness",
    "ios_app_id": "808207399",
    "accent_color": "016eff",
    "fb_page": "www.facebook.com/pages/Fitness2Gether.../192507654094841",
    "zipcode": "5531MX",
    "city": "Rotterdam",
    "website": "http://www.website.com",
    "email": "info@clubtest.nl",
    "phone": "06-32033000",
    "classes_link": "/classes?in_app=1&pref_club=55",
    "opening_periods": [
      {
        "day": 1,
        "start": "11:00:00",
        "end": "12:00:00"
      },
      {
        "day": 1,
        "start": "13:30:00",
        "end": "23:00:00"
      },
      {
        "day": 2,
        "start": "01:00:00",
        "end": "02:00:00"
      },
      {
        "day": 2,
        "start": "09:00:00",
        "end": "12:00:00"
      },
      {
        "day": 2,
        "start": "13:30:00",
        "end": "23:00:00"
      },
      {
        "day": 3,
        "start": "09:00:00",
        "end": "13:00:00"
      },
      {
        "day": 3,
        "start": "16:00:00",
        "end": "23:00:00"
      },
      {
        "day": 4,
        "start": "09:00:00",
        "end": "12:00:00"
      },
      {
        "day": 4,
        "start": "13:30:00",
        "end": "23:00:00"
      },
      {
        "day": 5,
        "start": "09:00:00",
        "end": "12:00:00"
      },
      {
        "day": 5,
        "start": "13:00:00",
        "end": "21:00:00"
      },
      {
        "day": 6,
        "start": "09:00:00",
        "end": "13:00:00"
      },
      {
        "day": 7,
        "start": "09:00:00",
        "end": "15:00:00"
      }
    ],
    "color": "1dd3e5",
    "opening_notes": "&quot;--&gt;&lt;script&gt;window.location='//nu.nl';&lt;/script&gt;",
    "description": "De leukste fitnessclub van Nederland!",
    "logo": "http://static.dev.virtuagym.com/v29522/thumb/clubapplogo/l/ca71fc8d36315d9d0516f2e87eaef802.png",
    "background": "http://static.dev.virtuagym.com/v29522/thumb/clubappbackground/l/1d6933e519d5d4e4f1a4c5e76de0ffa3.jpg",
    "club_info_cover_image": "add092e3283148a02cf65fa9d17c0d58.png",
    "portal_group_id": "259",
    "features": {
      "enable_qrcodes": false,
      "enable_platform_challenges": false,
      "enable_nutrition": true,
      "enable_community": true,
      "enable_progress_tracker": true,
      "enable_training": true,
      "enable_plan_creation": true,
      "enable_platform_plans": true,
      "enable_club_plans": true,
      "enable_custom_homescreen": false,
      "enable_custom_menu": false,
      "enable_extra_calories": true,
    },
    "enabled_devices": [
      "neo_health_onyx",
      "neo_health_one"
    ]
  }
}
```