Table: Users
Fields: Id, Name, Email Address, City

===

**Bold**
*Italics*

C = Create / Add
R = Read
U = Update / Edit
D = Delete / Soft Delete

CREATE TABLE users (
  id int auto_increment primary key,
  name varchar(200),
  email varchar(500),
  city varchar(200)
);
