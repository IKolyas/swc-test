# Тестовое задание SWC

## Развёртывание 
```composer install```

```docker-compose up -d``` 


### в контейнере

```php artisan:migrate --seed```

```npm install``` 

```npm run dev``` 


login: admin 

password: adminadmin

Laravel is accessible, powerful, and provides tools required for large, robust applications.

# API examples

------------------------------------------
## 1. Register

**route**: localhost/api/register 

**method**: POST

**request:** 

```
{
    "name": "Василий",
    "surname": "Петров",
    "login": "login",
    "birthday": "11.11.1990",
    "password": "password",
    "password_confirmation": "password"
}
```

**response:** 
```
{
    "error":null,
    "result": {
        "token":"4|KAkOX34dWkve96fSwycpNIe6vGqBm1DVHzUl7V6D0fa2377a"
    }
}
```

## 2. Login

**route:** localhost/api/login

**method:** POST

**body:**
```
{
    "login": "vasyavasya",
    "password": "vasyavasya",
}
```

**response:** 
```
{
    "error":null,
    "result": {
        "token":"4|KAkOX34dWkve96fSwycpNIe6vGqBm1DVHzUl7V6D0fa2377a"
    }
}
```


## 3. Logout

**route:** localhost/api/logout

**method:** POST

**request:**
```{}```

**response:** 
```
{
    "error":null,
    "result": {
        "message":"Successfully logged out"
    }
}
```


## 4. Event list

**route:** localhost/api/events

**method:** GET

**params:** page?

**response:**
```
{
    "error": null,
    "result": {
        "events": [
            {
                "id": 1,
                "title": "Событие 1",
                "description": "Описание",
                "created_at": "19-10-2000",
                "creator_name": "Николай Петров",
                "creator_id": 2,
                "participants": []
            },
            {
                "id": 2,
                "title": "Событие 2",
                "description": "Описание",
                "created_at": "11-12-1990",
                "creator_name": "Василий Иавнов",
                "creator_id": 2,
                "participants": [
                    {
                        "id": 4,
                        "fullName": "Василий Иавнов"
                    }
                ]
            }
        ],
        "pagination": {
            "total": 4,
            "count": 2,
            "per_page": 2,
            "current_page": 1
        }
    }
}
```

## 5. Create event

**route:** localhost/api/events/

**method:** POST

**request:**
```
{
    "title": "Event name",
    "description": "Event description"
}

```

**response:**
```
{
    "error": null,
    "result": {
        "event": {
        "id": 7,
        "title": "Event name"
        }
    }
}

```

## 6. Attach/Detach user to event

**route:** localhost/api/events/{eventId}
**method:** PUT

**request:**
```
{
    "user_id": 2    
}

```

**response:**
```
{
    "error": null,
    "result": {
        "event": [
            {
                "id": 4,
                "fullName": "Василий Иванов"
            },
            {
                "id": 2,
                "fullName": "Николай Петров"
            }
        ]
    }
}

```
-----------------------------------------
## 7. Delete event

**route:** localhost/api/events/{eventId}
**method:** POST
