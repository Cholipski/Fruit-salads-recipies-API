# Fruit salads recipes API

## Instalacja

1. Skopiować plik `.env.example` oraz usunąć `.example`
2. Uzupełnić plik `.env` o wymagane dane
3. Uruchomić polecenie `docker-compose up --build`

### Uruchomienie powyższego polecenia, skonfiguruje aplikację poprzez zainstalowanie zależności `composer` oraz uruchomi migrację wraz z importem podstawowych danych z pliku json

## Lista endpointów


### Metoda: ` GET `
**URL** : `/api/v1/fruits`

#### Odpowiedź pozytywna:

**Status** : `200 OK`

**Zawartość** :
```json
[
    {
        "id": 1,
        "name": "Apple",
        "nutrients": {
            "carbohydrates": 11.4,
            "protein": 0.3,
            "fat": 0.4,
            "calories": 52,
            "sugar": 10.3
        }
    },
    {
        "id": 2,
        "name": "Apricot",
        "nutrients": {
            "carbohydrates": 3.9,
            "protein": 0.5,
            "fat": 0.1,
            "calories": 15,
            "sugar": 3.2
        }
    },
]

```
---

### Metoda: ` POST `
**URL** : `/api/v1/salad_recipes`

**Wymagane dane**:
```json
{
    "name": "[name]",
    "description": "[description]",
    "fruits": [
        {
            "fruit_id": "[id]",
            "weight": "[weight]"
        },
        ...
    ]
}
```

### Pola wymagane:
- name
- description
- fruits (array minimum 2 elementy)
- fruits.fruit_id
- fruits.weight

#### Odpowiedź pozytywna:

**Warunek wystąpienia** : Przepis został pomyślnie utworzony

**Status** : `201 Created`

**Zawartość** :
```json
{
    "message": "Salad recipe was added successfully"
}

```

---

### Metoda: ` GET `
**URL**: `/api/v1/salad_recipes`

#### Odpowiedź pozytywna:

**Status** : `200 OK`

**Zawartość**:
```json
{
    {
      "id": 1,
      "name": "FIRST",
      "fruits": [
        "Apricot",
        "Banana"
      ],
      "total_weight": 35,
      "total_calories": 111
    },
    {
        "id": 1,
        "name": "SECOND",
        "fruits": [
            "Apricot",
            "Banana"
        ],
        "total_weight": 35,
        "total_calories": 111
    },
    ...
}

```
---

### Metoda: ` GET `
**URL**: `/api/v1/salad_recipes/{id}`

#### Odpowiedź pozytywna:

**Status** : `200 OK`

**Zawartość**:
```json
{
    "id": 3,
    "name": "NAME",
    "description": "DESCRIPTION",
    "total_nutrients": {
        "carbohydrates": 6.8,
        "protein": 0.32,
        "fat": 0.06,
        "calories": 29.55,
        "sugar": 5.32
    },
    "total_weight": 35,
    "ingredients": [
        {
            "name": "Apricot",
            "weight": 5,
            "nutrients": {
                "carbohydrates": 3.9,
                "protein": 0.5,
                "fat": 0.1,
                "calories": 15,
                "sugar": 3.2
            }
        },
        {
            "name": "Banana",
            "weight": 30,
            "nutrients": {
                "carbohydrates": 22,
                "protein": 1,
                "fat": 0.2,
                "calories": 96,
                "sugar": 17.2
            }
        }
    ]
}

```
---

### Metoda: ` DELETE `
**URL**: `/api/v1/salad_recipes/{id}`

#### Odpowiedź pozytywna:

**Status**: `200 OK`

**Zawartość**:
```json
{
    "message": "Salad recipe {id} was deleted successfully"
}

```

---

### Metoda: ` PUT `
**URL**: `/api/v1/salad_recipes/{id}`

**Wymagane dane**:
```json
{
    "name": "[name]",
    "description": "[description]",
    "fruits": [
        {
            "fruit_id": "[id]",
            "weight": "[weight]"
        },
        ...
    ]
}
```
### Pola wymagane:
- name
- description
- fruits (array minimum 2 elementy)
- fruits.fruit_id
- fruits.weight
#### Odpowiedź pozytywna:

**Warunek wystąpienia**: Przepis został pomyślnie zaktualizowany

**Status**: `200 OK`

**Zawartość**:
```json
{
    "message": "Salad recipe was updated successfully"
}

```

---
