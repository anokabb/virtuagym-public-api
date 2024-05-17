# Employee

------

*Please note https is required for ALL API requests.* 

------

**Please note, in API endpoints we pass the "Club Key" as "club_secret"**

*(Club Key can be found in business settings->Business Info->Advanced)*

------


## METHODS

|Method|URL|Info|URL-params|
|---|---|---|---|
|GET|/api/v1/club/12345/employee|Returns all employees of the club that have been edited since `<sync_from>` (See *STRUCTURE*)|sync_from (in milliseconds), from_id, api_key, club_secret, club_member_id (optional), with (optional), any_sub_club (optional), rfid_tag (optional)|
|GET|/api/v1/club/12345/employee/12345|Returns the specific employee of the club|api_key, club_secret, with (optional), any_sub_club (optional)|
|PUT|/api/v1/club/12345/employee/12345|Update and returns the employee updated (See *STRUCTURE*)|api_key, club_secret|
|PUT|/api/v1/club/12345/employee|Creates and returns a new employee(See *STRUCTURE*)|api_key, club_secret|
|PUT|/api/v1/club/12345/employee/create_or_update|Create or update an employee based on external_id (See STRUCTURE)|api_key, club_secret|

## GET Example

## STRUCTURE

|Field|Type|Optional|Values|Information|
|---|---|---|---|---|
|member_id|int|no| | The ID for the employee("Member ID" in Virtuagym)|
|club_id|int|no| |The ID of the club the user belongs to in Virtuagym (in case of a chain this is a sub-club)|
|club_member_id|string|yes| |Custom ID from the external system ("Own member ID" in Virtuagym)|
|external_id|string|yes| |ID from the external system|
|firstname|string|no| |The first name of the employee|
|lastname|string|no| |Last name of the employee|
|email|string|no| |The email address of the employee, an invitation will be sent to this address when the employee will be created|
|active|boolean|no| |If the employeeis active or inactive|
|is_pro|boolean|no| |If the employeeis pro|
|gender|string|yes|"m"/"f"|The gender of the editted employee|
|member_since|int|no| |The timestamp (in milliseconds) the employeemade an account (yyyy-mm-dd)|
|timestamp_edit|int|no| |The timestamp (in milliseconds) the employee' information changed|
|birthday|string|yes| |The birthday of the employee(YYYY-MM-DD)|
|lang|string|yes| |The language the employee uses in the portal|
|zip|string|yes| |The zip code of the employee|
|street|string|yes| |The street address of the employee|
|street_extra|string|yes| |Extra street information of the employee|
|place|string|yes| |The place where the employee lives|
|country|string|yes| |The country code where the employee lives|
|formatted_address|string|yes| |A nicely formatted string of the street address of the employee|
|phone|string|yes| |The phone number of the employee|
|mobile|string|yes| |The mobile phone number of the employee|
|rfid_tag|string|yes| | Rf-ID tag that is tied to the employee|



Send a GET request to `https://api.virtuagym.com/api/v1/club/<club_id>/employee?api_key=<api_key>&club_secret=<club_key>&sync_from=<sync_from>` OR `https://api.virtuagym.com/api/v1/club/<club_id>/employee?api_key=<api_key>&club_secret=<club_key>&from_id=<from_id>`

In some cases the it is better to use `from_id` as multiple rows might have the same `sync_from` thereby not allowing for pagination. For the first call when using `from_id` it is allowed to pass 0 and it would allow for pagination.

```json
{
    "statuscode": 200,
    "statusmessage": "Everything OK",
    "result_count": 2,
    "timestamp": 1429522483,
    "result": [
      {
            "member_id": 7302399,
            "firstname": "Claudiu2",
            "lastname": "Dorado",
            "email": "radu+wtfs9925@digifit.eu",
            "active": true,
            "gender": "m",
            "member_since": 1526508000000,
            "timestamp_edit": 1526549160788,
            "lang": "en",
            "club_id": 377,
            "priviliges": "default,club_manager"
        }
    ]
}
```

It is also possible to retrieve the employee from any of the other sub-clubs as well by passing `any_sub_club=1` in the URL parameter. For this case, remember to use the `club_secret` of the super club.

Therefore, for this call it should be something similar to :

`/api/v1/club/<other-club-id>/employee/<member_id>?api_key=<api_key>&club_secret=<super_club_key>&any_sub_club=1`

And would return the response of the employee details from the original club where his profile was first created.


## PUT Example

The PUT request allows to both update an existing employee and create a new employee.

When using this request to create a new employee, they will automatically get e-mail invites based upon the club setting.

* PUT ``/api/v1/club/<club_id>/employee/`` would create a new employee returning a ``member_id`` in the process.

* PUT ``/api/v1/club/<club_id>/employee/<member_id>`` would update an existing employee with the given ``member_id``.

|Field|Type|Optional|Values|Information|
|---|---|---|---|---|
|firstname|string|yes/no| |The first name of the employee.  Field **NOT** optional for the creation of a new employee|
|lastname|string|yes/no| |Last name of the employee.  Field **NOT** optional for the creation of a new employee|
|email|string|yes| |The email address of the employee, an invitation will be sent to this address when the employee will be created|
|external_id|string|yes| |ID from the external system|
|active|boolean|yes| |If the employee is active or inactive|
|gender|string|yes|"m"/"f"|The gender of the edited employee|
|birthday|string|yes| |The birthday of the employee (YYYY-MM-DD)|
|lang|string|yes| |The language the employee uses in the portal|
|zip|string|yes| |The zip code of the employee|
|street|string|yes| |The street address of the employee|
|street_extra|string|yes| |Extra street information of the employee|
|place|string|yes| |The place where the employee lives|
|country|string|yes| |The country code where the employee lives|
|formatted_address|string|yes| |A nicely formatted string of the street address of the employee|
|phone|string|yes| |The phone number of the employee|
|mobile|string|yes| |The mobile phone number of the employee|
|ba_owner|string|yes| |The bank account holder name|
|ba_number|string|yes| |The bank account number|
|ba_bic_code|string|yes| |The BIC code of the bank account|
|is_pro|boolean|yes| |Sets if a employee is pro|
|pro_start|int|yes/no| |Timestamp of pro activation (mandatory when is_pro is true)|
|pro_end|int|yes/no| |Timestamp of pro deactivation (mandatory when is_pro is false)|
|unsubscribe_date|string|yes| |The future inactive date of the employee (YYYY-MM-DD)
|add_priviliges|array|no| |The priviliges the new employee will have
|remove_priviliges|array|no| |The priviliges that will be removed from the employee (only possible when updating

#### Supported Priviliges

|API Value|Virtuagym role|
|---|---|
|'club_manager' | Club manager|
|'assistent_manager' | Assistant manager|
|'marketing_manager' | Marketing manager|
|'coach' | Coach|
|'financial' | Financial|
|'employee' | Employee|
|'scheduling' | Scheduling|
|'default' | Default, added for each employee|

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


### Creating a New Employee
Send a PUT request to ``https://api.virtuagym.com/api/v1/club/377/employee?api_key=<api_key>&club_secret=<club_secret>`` with the following body

```json
{
 "firstname":"John",
 "lastname":"Doe",
 "email":"john@example.com",
 "add_priviliges": ["coach"]
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
    "priviliges": "default, coach"
  }
}
```
Note the default values of ``active``, ``is_pro`` and ``gender`` set when creating an employee. Remember to store the ``member_id`` if you wish to use it for later.

### Updating an Employee
Send a PUT request to `https://api.virtuagym.com/api/v1/club/<club_id>/employee/<member_id>?api_key=<api_key>&club_secret=<club_key>` with the following body.

```json
{
"firstname": "Jane",
"lastname": "Doe",
"gender": "f",
"birthday": "1984-11-28",
"country": "NL"
"add_priviliges": ["club_manager"],
"remove_priviliges": ["coach"],
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
    "member_since": "2015-01-14"
    "priviliges": "default, club_manager"
  }
}
```

*Note* If the employee does not belong to the club the below response is expected 
<pre>
<code class="json">
{
  "statuscode": 420,
  "statusmessage": "Not found.",
  "result_count": 0,
  "timestamp": 1439302743
}
</code>
</pre>

## Possible error codes and messages


|Statuscode|Message|Description|
|---|---|---|
|200|Everything OK|Everything proceeded according to the specifications|
|420|Not found|Employee does not belong to the club or employee does not exist|
|420|Employee firstname and lastname are required|The JSON data in the PUT request does not have firstname and/or lastname specified|
|420|Error in updating the employee state|Error in updating of the employee with the active status|
|420|Employee with member_id was not found in any sub club|Occurs when trying to get an invalid emplyee by passing the `any_sub_club=1` field|
|420|Employee are not allowed to switch to other sub clubs|Occurs when trying to get a employee by passing the `rfid_tag` and `any_sub_club=1` fields when the superclub does not allow switching|
|420|passed language is not supported|-|
|420|Invalid unsubscribe_date format values.|Occurs when you pass an invalid unsubscribe date format (YYYY-MM-DD)|
|420|Invalid unsubscribed_date cannot be in the past|Occurs when you pass an unsubscribe date in the past|


