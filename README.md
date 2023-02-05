
# Project Title

Phonebook for storing user emails and phone numbers



## Installation

Clone repository to your local machine

```bash
  git clone https://github.com/Bvseer/phonebook.git
```
Install dependencies
```bash
  composer install
``` 
Migrate database tables
```bash
  php artisan migrate
``` 
Seed database with fake data (if you want)
```bash
  php artisan db:seed
``` 

## API Reference

### Authorization

#### Registration

```http
  POST /api/register
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `name`       | `string` | **Required**. Your name |
| `surname`    | `string` | **Required**. Your surname |
| `patronymic` | `string` | **Required**. Your patronymic |
| `birthdate`  | `date` | **Required**. Your birthdate |
| `email`      | `string` | **Required**. Your email |
| `password`   | `string` | **Required**. Your password |
| `c_password` | `string` | **Required**. Your confirm your password |

#### Log in

```http
  GET /api/login
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `email`      | `string` | **Required**. Your email |
| `password`   | `string` | **Required**. Your password |

### Contacts

#### Get all user contacts

```http
  GET /api/contacts/get-contacts
```

| Auth      | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `Bearer Token` | `string` | **Required**. Your Bearer Token |

#### Get all user contacts by user_id

```http
  GET /api/contacts/get-contacts-by-user-id
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `user_id` | `integer` | **Required**. user_id of contacts you want to fetch |

#### Get contact by id

```http
  GET /api/contacts/get-contact-by-id
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `integer` | **Required**. id of contact you want to fetch |

#### Search contacts by | surname or/and name or/and patronymic | email | phone number

```http
  GET /api/contacts/search
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `search_value`      | `string` | **Required**. surname or/and name or/and patronymic or email or phone number of user |

#### Delete contact by id

```http
  DELETE /api/contacts/delete
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `contact_id` | `integer` | **Required**. contact id |
| `user_id`    | `integer` | **Required**. user id of contact owner |

#### Bulk-create user contacts

```http
  POST /api/contacts/bulk-create
```

| Body Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `contacts[0]['phone_number']`| `string` | **Required**. phone number |
| `contacts[0]['email']`       | `string` | **Required**. email |
| `contacts[1]['phone_number']`| `string` | **Optional**. phone number |
| `contacts[1]['email']`       | `string` | **Optional**. email |
| `contacts[2]['phone_number']`| `string` | **Optional**. phone number |
| `contacts[2]['email']`       | `string` | **Optional**. email |

#### Bulk-update user contacts

```http
  POST /api/contacts/bulk-update
```

| Body Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `contacts[0]['id']`            | `integer` | **Required**. id of contact you want to update |
| `contacts[0]['phone_number']`  | `string` | **Required**. new phone number |
| `contacts[0]['email']`         | `string` | **Required**. new email |
| `contacts[1]['id']`            | `integer` | **Optional**. id of contact you want to update |
| `contacts[1]['phone_number']`  | `string` | **Optional**. new phone number |
| `contacts[1]['email']`         | `string` | **Optional**. new email |
| `contacts[2]['id']`            | `integer` | **Optional**. id of contact you want to update |
| `contacts[2]['phone_number']`  | `string` | **Optional**. new phone number |
| `contacts[2]['email']`         | `string` | **Optional**. new email |

### Users

#### Delete user (all user contacts would be deleted as well)

```http
  DELETE /api/users/delete
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `integer` | **Required**. id of user you want to delete |


