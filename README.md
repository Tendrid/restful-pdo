RESTful-PDO
===========

Simple RESTful interface for working with models with PDO in PHP


GOAL
===========
To create a simple way to get, create, update, and delete objects in a database.  This library should require no external libraries or frameworks.

ABSTRACT
===========
Using the PDO library (and parameter binding) in PHP, I would write a simple model based system that allows the user to create data views of objects based on fields in a database.  The user would define each model, and callback functions to customize the read/write process (for security, or data manipulation).  The user could then simply include the library anywhere in their code stack, and use the HTTP Verbs GET, POST, PUT, or DELETE to manipulate their defined objects in a RESTful manner.

FEATURES
===========
- simply include the library, initialize it, and navigate to it directly to access the rest interface
- create models/interfaces that define objects to be accessed via restful interface
- objects can be read, created, deleted, or altered
- overridable callbacks allow users to define access permissions or getter/setter filters per object
- data accessible in multiple formats (csv, json, xml)
