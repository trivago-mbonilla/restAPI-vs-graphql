hotel
=====
**Description:** Test project to compare ResAPI vs GraphQL

**Status**: Work in Progress

**Goal**: create a time table to compare RestAPI vs GraphQL (php-symfony project)

**Library:** https://github.com/Youshido/GraphQLBundle

# Start

* run server
```php
php bin/console server:run
```

# Test

* Rest API doc: http://127.0.0.1:8000/api/doc
* GraphQL test: http://127.0.0.1:8000/graphql/explorer

###getHotels
```graphql
query {
 hotels {
    id,
    name
 } 
}
```

###getHotel
```graphql
query {
 hotel(id: ID) {
    id,
    name
 } 
}
```

###createtHotel
```graphql
mutation {
  addHotel(name: "my new hotel") {
    id,
    name
  }
}
```