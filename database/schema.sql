/*
=========================================================
SingThyGlory CMS
Master Schema
=========================================================
*/

CREATE DATABASE IF NOT EXISTS singthyglory_cms;

USE singthyglory_cms;

SOURCE /docker-entrypoint-initdb.d/tables/01_roles.sql;
SOURCE /docker-entrypoint-initdb.d/tables/02_users.sql;