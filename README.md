# BlastDoctrinePgsqlBundle
This bundle extends the Postgresql functionalities of Doctrine and Sonata projects

Features
========

For the moment, the only feature of this bundle is:

- replacing LIKE keyword by ILIKE (Postgresql specific) in sql queries in order to have case insensitive comparisons
- Substring function (regular expressions): "substring(field, regexp)" outputs "substring(field from regexp)". Postgresql specific
