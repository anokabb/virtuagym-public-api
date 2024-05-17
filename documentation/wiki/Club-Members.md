# Member

------

*Please note https is required for ALL API requests.* 

------

**Please note, in API endpoints we pass the "Club Key" as "club_secret"**

*(Club Key can be found in System Settings -> Business Info -> Advanced)*

------


## METHODS

|Method|URL|Info|URL-params|
|---|---|---|---|
|GET|/api/v1/club/12345/member|Returns all member of the club that have been edited since `<sync_from>` (See *STRUCTURE*)|sync_from (in milliseconds), from_id, api_key, club_secret, club_member_id (optional), with (optional), any_sub_club (optional), rfid_tag (optional), external_id (optional), email (optional), max_results (optional)|
|GET|/api/v1/club/12345/member/12345|Returns the specific member of the club|api_key, club_secret, with (optional), any_sub_club (optional)|
|PUT|/api/v1/club/12345/member/12345|Update and returns the member updated (See *STRUCTURE*)|api_key, club_secret|
|PUT|/api/v1/club/12345/member|Creates and returns a new member (See *STRUCTURE*)|api_key, club_secret|
|PUT|/api/v1/club/12345/member/create_or_update|Create or update a member based on external_id (See *STRUCTURE*)|api_key, club_secret|
|POST|/api/v1/club/12345/member/activate_user|Activate the user profile for a club’s member or allow that member to connect to an existing profile through the API.| api_key, club_secret

## GET Example

## STRUCTURE

|Field|Type|Optional|Values|Information|
|---|---|---|---|---|
|member_id|int|no| | The ID for the member ("Member ID" in Virtuagym)|
|club_id|int|no| |The ID of the club the user belongs to in Virtuagym (in case of a chain this is a sub-club)|
|club_member_id|string|yes| |Custom ID from the external system ("Own member ID" in Virtuagym)|
|external_id|string|yes| |ID from the external system|
|firstname|string|no| |The first name of the member|
|lastname|string|no| |Last name of the member|
|email|string|no| |The email address of the member, an invitation will be sent to this address when the member will be created (If enabled in System Settings→ Coach → Module Settings → Auto-invite newly added clients)|
|active|boolean|no| |If the member is active or inactive|
|is_pro|boolean|no| |If the member is pro|
|gender|string|yes|'m'<br />'f'<br />'o'<br />'-'<br />'u'|The gender of the edited member. Male (m), Female (f), Other (o), Prefer not to say (-), Unknown (u)|
|member_since|int|no| |The timestamp (in milliseconds) the member made an account (yyyy-mm-dd)|
|timestamp_edit|int|no| |The timestamp (in milliseconds) the members' information changed|
|birthday|string|yes| |The birthday of the member (YYYY-MM-DD)|
|lang|string|yes| |The language the member uses in the portal|
|zip|string|yes| |The zip code of the member|
|street|string|yes| |The street address of the member|
|street_extra|string|yes| |Extra street information of the member|
|place|string|yes| |The place where the member lives|
|country|string|yes| |The country code where the member lives|
|formatted_address|string|yes| |A nicely formatted string of the street address of the member|
|phone|string|yes| |The phone number of the member|
|mobile|string|yes| |The mobile phone number of the member|
|rfid_tag|string|yes| | Rf-ID tag that is tied to the member|



Send a GET request to `https://api.virtuagym.com/api/v1/club/<club_id>/member?api_key=<api_key>&club_secret=<club_key>&sync_from=<sync_from>` OR `https://api.virtuagym.com/api/v1/club/<club_id>/member?api_key=<api_key>&club_secret=<club_key>&from_id=<from_id>`

In some cases the it is better to use `from_id` as multiple rows might have the same `sync_from` thereby not allowing for pagination. For the first call when using `from_id` it is allowed to pass 0 and it would allow for pagination.

```json
{
    "statuscode": 200,
    "statusmessage": "Everything OK",
    "result_count": 2,
    "timestamp": 1429522483,
    "result": [
        {
            "member_id": 1234,
            "external_id": "EC6DEE14-052A-4708-B34F-C8ABE242DD61",
            "firstname": "John",
            "lastname": "Doe",
            "active": true,
            "is_pro": true,
            "gender": "m",
            "email": "johndoe@example.com",
            "member_since": "2015-01-14",
            "timestamp_edit": 1429522480252,
            "birthday": "1995-03-03",
            "zip": "1016 XX",
            "street": "Elandsgracht 32",
            "street_extra": "3rd floor",
            "place": "Amsterdam",
            "country": "NL",
            "formatted_address": "Elandsgracht 32, 1016 Amsterdam, Nederland",
            "phone": "0201234567",
            "mobile": "061234567"
        },
        {
            "member_id": 5678,
            "firstname": "Jane",
            "lastname": "Smith",
            "gender": "f",
            "email": "janesmith@example.com",
            "member_since": "2015-04-16",
            "timestamp_edit": 1429188946933,
            "country": "NL",
            "phone": "00312018293746"
        }
    ]
}
```

Use `max_results` to limit the maximum number of members returned.

`https://api.virtuagym.com/api/v1/club/<club_id>/member?api_key=<api_key>&club_secret=<club_key>&from_id=<from_id>&max_results=<limit>`

The default is 500 and the maximum result returned is 500

e.g `https://api.virtuagym.com/api/v1/club/<club_id>/member?api_key=<api_key>&club_secret=<club_key>&from_id=0&max_results=3`
```json
{
    "statuscode": 200,
    "statusmessage": "Everything OK",
    "result_count": 3,
    "timestamp": 1429522483,
    "results_remaining": 10970,
    "next_page": "from_id=5679",
    "result": [
        {
            "member_id": 1234,
            "external_id": "EC6DEE14-052A-4708-B34F-C8ABE242DD61",
            "firstname": "John",
            "lastname": "Doe",
            "active": true,
            "is_pro": true,
            "gender": "m",
            "email": "johndoe@example.com",
            "member_since": "2015-01-14",
            "timestamp_edit": 1429522480252,
            "birthday": "1995-03-03",
            "zip": "1016 XX",
            "street": "Elandsgracht 32",
            "street_extra": "3rd floor",
            "place": "Amsterdam",
            "country": "NL",
            "formatted_address": "Elandsgracht 32, 1016 Amsterdam, Nederland",
            "phone": "0201234567",
            "mobile": "061234567"
        },
        {
            "member_id": 5678,
            "firstname": "Jane",
            "lastname": "Smith",
            "gender": "f",
            "email": "janesmith@example.com",
            "member_since": "2015-04-16",
            "timestamp_edit": 1429188946933,
            "country": "NL",
            "phone": "00312018293746"
        },
        {
            "member_id": 5679,
            "firstname": "John",
            "lastname": "Smith",
            "gender": "m",
            "email": "johnsmith@example.com",
            "member_since": "2015-04-16",
            "timestamp_edit": 1429188947268,
            "country": "NL",
            "phone": "0123456789"
        }
    ]
}
```

It is also possible to retrieve the member from any of the other sub-clubs as well by passing `any_sub_club=1` in the URL parameter. For this case, remember to use the `club_secret` of the super club.

Therefore, for this call it should be something similar to :

`/api/v1/club/<other-club-id>/member/<member_id>?api_key=<api_key>&club_secret=<super_club_key>&any_sub_club=1`

And would return the response of the member details from the original club where his profile was first created.

In addition to retrieving the member resource itself, we allow for retrieving sub-resource using the `with` URL parameter for saving on making two separate requests.

At the moment, the valid `with` values are :

|`with` Value|Description|
|---|---|
|memberships|returns all memberships the member currently has (both active/inactive)|
|active_memberships|all active memberships of the member|

For instance send a GET request to:

`/api/v1/club/<club-id>/member/<member_id>?api_key=<api_key>&club_secret=<club_key>&with=memberships`

would return something similar to

```json
{
  "status": {
    "statuscode": 200,
    "statusmessage": "Everything OK",
    "result_count": 1,
    "timestamp": 1465470810743,
    "results_remaining": 0
  },
  "result": [
    {
      "member_id": 78166,
      "firstname": "ABC",
      "lastname": "DEF",
      "email": "abcdef@digifit.eu",
      "active": true,
      "member_since": 1453417200000,
      "timestamp_edit": 1453471427081,
      "country": "NL",
      "is_pro": false,
      "memberships": [
        {
          "instance_id": 2720,
          "member_id": 78166,
          "membership_id": 596,
          "active": 0,
          "cancelled": 1,
          "contract_autorenewed": 0,
          "completed": 0,
          "paused": 0,
          "stopped": 1,
          "start_date": "2016-01-29",
          "contract_start_date": "2016-02-01",
          "contract_end_date": "2016-06-09",
          "membership_name": "Bodytec"
        },
        {
          "instance_id": 2724,
          "member_id": 78166,
          "membership_id": 593,
          "active": 1,
          "cancelled": 0,
          "contract_autorenewed": 0,
          "completed": 0,
          "paused": 0,
          "stopped": 0,
          "start_date": "2016-06-09",
          "contract_start_date": "2016-07-01",
          "contract_end_date": "2016-07-31",
          "membership_name": "Credits test"
        }
      ]
    }
  ]
}
```

## PUT Example

The PUT request allows to both update an existing member and create a new member.

When using this request to create a new member, they will automatically get e-mail invites based upon the club setting.

* PUT ``/api/v1/club/<club_id>/member/`` would create a new member returning a ``member_id`` in the process.

  A simple implementation for creating a member in PHP - 
https://github.com/virtuagym/Virtuagym-Public-API/blob/master/php/member-creation-v1.php

* PUT ``/api/v1/club/<club_id>/member/<member_id>`` would update an existing member with the given ``member_id``.

|Field|Type|Optional|Values|Information|
|---|---|---|---|---|
|firstname|string|yes/no| |The first name of the member.  Field **NOT** optional for the creation of a new member|
|lastname|string|yes/no| |Last name of the member.  Field **NOT** optional for the creation of a new member|
|email|string|yes| |The email address of the member, an invitation will be sent to this address when the member will be created|
|level_id|int|yes|0 - 4|0 - Novice<br />1 - Beginner<br />2 - Intermediate<br />3 - Advanced<br />4 - Expert|
|goal_id|int|yes|1 - 7|1 - Lose Weight <br />2 - Build Muscle <br />3 - Improve well-being <br />4 – Improve Performance <br />5 – Rehabilitation <br />6 - Get Fit <br />7 - Shape and Tone <br /><br />**NOTE**: These are the default names. They could be different per club.|
|filled_intake_questionnaire|int|yes|1 - yes<br />0 - no|The member has filled in the mandatory intake questionaire.|
|external_id|string|yes| |ID from the external system|
|active|boolean|yes| |If the member is active or inactive|
|gender|string|yes|'m'<br />'f'<br />'o'<br />'-'<br />'u'|The gender of the edited member. Male (m), Female (f), Other (o), Prefer not to say (-), Unknown (u)|
|birthday|string|yes| |The birthday of the member (YYYY-MM-DD)|
|lang|string|yes| |The language the member uses in the portal|
|zip|string|yes| |The zip code of the member|
|street|string|yes| |The street address of the member|
|street_extra|string|yes| |Extra street information of the member|
|place|string|yes| |The place where the member lives|
|country|string|yes| |The country code where the member lives|
|formatted_address|string|yes| |A nicely formatted string of the street address of the member|
|phone|string|yes| |The phone number of the member|
|mobile|string|yes| |The mobile phone number of the member|
|ba_owner|string|yes| |The bank account holder name|
|ba_number|string|yes| |The bank account number|
|ba_bic_code|string|yes| |The BIC code of the bank account|
|is_pro|boolean|yes| |If set, this changes the member's pro status according to the input dates. <br />If dates are not provided for a true value, no changes are made to an existing pro membership or a lifetime pro will be added. <br />For a false value with no dates, any existing or upcoming pro will be cancelled.|
|pro_start|int|yes| |Timestamp of pro activation. Only used with is_pro = true; this will add a new pro membership or update an existing pro membership to start on this date.|
|pro_end|int|yes| |Timestamp of pro deactivation. Requires is_pro to be sent.|
|unsubscribe_date|string|yes| |The future inactive date of the member (YYYY-MM-DD)

#### Supported Languages

|API Value|Language|
|---|---|
|'ar' | Arabic|
|'zh' | Chinese|
|'da' | Danish|
|'nl' | Dutch|
|'en' | English|
|'fi' | Finnish|
|'fr' | French|
|'de' | German|
|'el' | Greek|
|'it' | Italian|
|'ja' | Japanese|
|'no' | Norwegian|
|'pl' | Polish|
|'pt' | Portuguese|
|'ru' | Russian|
|'es' | Spanish|
|'sv' | Swedish|
|'tr' | Turkish|


### Creating a New Member
Send a PUT request to ``https://api.virtuagym.com/api/v1/club/377/member?api_key=<api_key>&club_secret=<club_secret>`` with the following body

```json
{
 "firstname":"John",
 "lastname":"Doe",
 "email":"john@example.com",
 "level_id": 2,
 "goal_id": 4,
 "filled_intake_questionnaire": 1
}
```
which would return a response as follows
```json
{
  "status": {
    "statuscode": 200,
    "statusmessage": "Everything OK",
    "result_count": 9,
    "timestamp": 1478252652810
  },
  "result": {
    "member_id": 77338,
    "firstname": "John",
    "lastname": "Doe",
    "email": "john@example.com",
    "active": true,
    "is_pro": false,
    "gender": "m",
    "member_since": 1478127600000,
    "timestamp_edit": 1478252652,
    "filled_mandatory_intake_questionnaire": 1
  }
}
```
### Note 
* The default values of ``active``, ``is_pro`` and ``gender`` set when creating a member. Remember to store the ``member_id`` if you wish to use it for later.
* ``filled_mandatory_intake_questionnaire`` is only returned in the response if the ``filled_intake_questionnaire`` is sent in the request.

### Updating a Member
Send a PUT request to `https://api.virtuagym.com/api/v1/club/<club_id>/member/<member_id>?api_key=<api_key>&club_secret=<club_key>` with the following body.

```json
{
"firstname": "Jane",
"lastname": "Doe",
"gender": "f",
"birthday": "1984-11-28",
"country": "NL",
"level_id": 2,
"goal_id": 4,
"filled_intake_questionnaire": 1
}
```

And corresponding, the fields would now be updated while returning a response as follows

```json
{
  "status": {
    "statuscode": 200,
    "statusmessage": "Everything OK",
    "result_count": 10,
    "timestamp": 1439303936123
  },
  "result": {
    "member_id": 77338,
    "firstname": "Jane",
    "lastname": "Doe",
    "active": 1,
    "email": "john@example.com",
    "gender": "f",
    "birthday": "1984-11-28",
    "country": "NL",
    "member_since": "2015-01-14",
    "filled_mandatory_intake_questionnaire": 1
  }
}
```

*Note* If the member does not belong to the club the below response is expected 

<pre>
<code class="json">
{
  "statuscode": 420,
  "statusmessage": "No member found.",
  "result_count": 0,
  "timestamp": 1439302743
}
</code>
</pre>

## Create or update based on external id example

Send a PUT request to ``https://virtuagym.com/api/v1/club/<club_id>/member/create_or_update?api_key=<api_key>&club_secret=<club_secret>`` with the following body

```json
{
 "firstname":"John",
 "lastname":"Doe",
 "email":"john@example.com",
 "external_id": "1ABC234567",
 "level_id": 2,
 "goal_id": 4,
 "filled_intake_questionnaire": 0
}
```
which would return a response as follows
```json
{
  "status": {
    "statuscode": 201,
    "statusmessage": "Everything OK",
    "result_count": 10,
    "timestamp": 1478252652810
  },
  "result": {
    "member_id": 77338,
    "firstname": "John",
    "lastname": "Doe",
    "email": "john@example.com",
    "external_id": "1ABC234567",
    "active": true,
    "is_pro": false,
    "gender": "m",
    "member_since": 1478127600000,
    "timestamp_edit": 1478252652,
    "filled_mandatory_intake_questionnaire": 0
  }
}
```
*Note* When you **update an existing member** with an external_id **statuscode 200** should be expected. In case there are more members with the same external_id within the club the API return the error 420 (More members with external Id).
 
## Possible error codes and messages


|Statuscode|Message|Description|
|---|---|---|
|200|Everything OK|Everything proceeded according to the specifications|
|420|No member found|Member does not belong to the club or member does not exist|
|420|Member firstname and lastname are required|The JSON data in the PUT request does not have firstname and/or lastname specified|
|420|Error in updating the member state|Error in updating of the member with the active status|
|420|member with member_id was not found in any sub club|Occurs when trying to get an invalid member by passing the `any_sub_club=1` field|
|420|members are not allowed to switch to other sub clubs|Occurs when trying to get a member by passing the `rfid_tag` and `any_sub_club=1` fields when the superclub does not allow switching|
|420|passed language is not supported|-|
|420|More members with external Id|Occurs when trying to update an member based on external_id while there are more members with the same external_id|
|420|Invalid level|Occurs when you pass an invalid level_id|
|420|Invalid goal|Occurs when you pass an invalid goal_id|
|420|Invalid filled_mandatory_intake_questionnaire|Occurs when you pass an invalid filled_intake_questionnaire|
|420|Invalid unsubscribe_date format values.|Occurs when you pass an invalid unsubscribe date format (YYYY-MM-DD)|
|420|Invalid unsubscribed_date cannot be in the past|Occurs when you pass an unsubscribe date in the past|
|423|This member is currently being updated.|Occurs when updating/creating a member with an external_id at exactly the same time|

## Activate user account for member
### POST Example
* POST ``/api/v1/club/<club_id>/member/activate_user`` This endpoint will activate the user profile for a club’s member or allow that member to connect to an existing profile through the API.

Note: The endpoint is not restricted to member_id to find the member; it is very flexible in it search criteria for a member and so can perform activation on external identifiers such as external_id, email, rfid tag or club member id or any combination of them (as an AND search. OR it's not supported).

The only restrictions are that only one member is found at the end, and that the member belongs to the club specified by the club id in the url (or club chain when the club specified is a superclub).

## Request body
|Field|Type|Optional|Information|
|---|---|---|---|
|email|string|no|The first name of the member. The email for the user account. Completely independent of the member’s email.If a user with this email exists, an error will be thrown unless “connect_to_existing” is true (in which case, the member will be connected to the existing account).Connecting is block completely if the user already has a member in the same club as the member found by the search criteria.|
|password|string|no|The password for a new user. It is not used when “connect_to_existing” is true.|
|member_identifier|string or int|no|This is the search criteria for finding the member. It can be either a json-object containing a “type” and “value” (if only one criteria), or an array of such objects (if multiple criteria are desired)Supported types (map directly to the member field) See the example below |
|connect_to_existing|bool or int|yes|Connecting to an existing account (by email) is only allowed if this is true, otherwise an error is returned.Must be a bool, or a representation of 0 or 1, or “true” or “false”.|
|ip_address|string|yes|Defaults to empty. This will not thrown a validation error if incorrect, it will simply use an empty value.|
|timezone|string|yes|One of https://www.php.net/manual/en/timezones.php. Defaults to “Europe/Amsterdam”.|

`member_identifier`
* “member_id” - must be an int

* “external_id” - string

* “club_member_id” - string

* “rfid_tag” - string, max 47 chars and not 00-00-00-00-00-00-00-00-00-00-00-00-00-00-00-00. All other 0 values are valid.

* “email” - email address

* “birthday” - must be in the format ‘yyyy-mm-dd’

### Examples
1. Minimum for a new account
```json
{
  "email": "user@digifit.eu",
  "password": "password",
  "member_identifier": {
    "type": "member_id",
    "value": 101
  }
}
```
2. Full new account
```json
{
  "email": "user@digifit.eu",
  "password": "password",
  "connect_to_existing": false,
  "member_identifier": {
    "type": "member_id",
    "value": 101
  },
  "ip_address": "127.0.0.1",
  "timezone": "America/Los_Angeles"
}
```
3. Connect account
```json
{
  "email": "user@digifit.eu",
  "connect_to_existing": true,
  "member_identifier": {
    "type": "member_id",
    "value": 172366
  }
}
```
4. Multi search
```json
{
  "email": "user@digifit.eu",
  "password": "password",
  "member_identifier": [{
    "type": "external_id",
    "value": 101
  }, {
    "type": "birthday",
    "value": "Y-m-d"
  }]
}
```

* Note  Multi search can be used with only one identifier in the array.

## Responses
### Success
A successful activation or connection will return a 200, and the “user_id”, “member_id” and “club_id” in the “result” of the response body.
```json
{
    "status": {
        "statuscode": 200,
        "statusmessage": "Everything OK",
        "result_count": 1,
        "timestamp": 1576579244371
    },
    "result": {
        "member_id": 1001,
        "user_id": 101,
        "club_id": 104
    }
}
```

## Errors
The possible errors are as follows: (code - error key (when no club_secret) - error message (with club_secret))

|Statuscode|Message|Description|
|---|---|---|
|406|Request invalid|The validation error. More information about the exact validation failures are passed in the response body (see below).|
|403|Too many API requests|Rate limit reached|
|404|Member not found|Member not found|
|400|Multiple members found|Multiple members found|
|420|Member already has a user profile|Member already has a user profile|
|420|User not found for the email|Thrown if connect_to_existing is true but a user with the given email was not found.|
|420|This user email is already in use please connect instead|A user already exists with the input email. Explicit instructions (passing “connect_to_existing”: true in the request body) to connect to that account are needed.The name of a club that the user is already a member of is returned in the body (see below).|
|420| This user email is already connected to the same club as the member|A user already exists with the input email, and that user already has a member in this club. The end client will need to provide a different email.|
|500|Unexpected error|Something unexpected went wrong trying to create the user account.|

Example response body:
```json
{
    "status": {
        "statuscode": 500,
        "statusmessage": "unexpected_error",
        "result_count": 0,
        "timestamp": 1575366533123
    }
}
```

### Validation errors

* email_required - Email is required

* password_required - Password is required

* member_identifier_required - Member identifier is required

* invalid_connect_to_existing - Connect to existing must be a bool

* too_short_email - Email too short

* too_long_email - Email too long

* email_invalid_email - Email invalid

* too_short_password - Password too short

* too_long_password - Password too long

* invalid_chars_password - Password contains invalid characters

* invalid_member_identifiers - No member identifier could be found

* member_id_must_be_int - member_id must be in

* club_member_id_must_be_string - club_member_id must be string

* external_id_must_be_string - external_id must be string

* invalid_timezone - Invalid timezone

* invalid_rfid_tag - Invalid rfid tag

* invalid_birthday - birthday must be Y-m-d
  
* Invalid unsubscribe_date format values.

* Invalid unsubscribed_date cannot be in the past

* Invalid pro_start date. Cannot be in the past.

* Invalid pro_end date

* Invalid pro_end parameter: (pro_start <= pro_end)

*  Invalid rfid_tag

* Invalid filled_mandatory_intake_questionnaire

Example body:
```json
{
    "status": {
        "statuscode": 406,
        "statusmessage": "Invalid request",
        "result_count": 0,
        "timestamp": 1575366533123
    },
    "errors": [
        {
            "type": "Password too short"
        },
        {
            "type": "No member identifier could be found"
        }
    ]
}
```

### Email in use, connect instead
In the case that the provided email is already in use, we also provide the name of a club that the user belongs to:
```json
{
    "status": {
        "statuscode": 420,
        "statusmessage": "email_in_use_connect_allowed",
        "result_count": 0,
        "timestamp": 1575366533123
    },
    "errors": [{
        "type": "email_in_use_connect_allowed",
        "information": [{
            "type": "club_name",
            "value": "Virtuagym Food and Fitness App"
        }]
    }]
}
```