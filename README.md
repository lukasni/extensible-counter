M307 - Counter
==============

A simple, extensible counter created as a school project for Module 307 at GIBM

Features:
---------

1. Count page visits if enabled
2. Keep separate counters for different files
3. Don't count up on refresh
4. Amin pages:
    1. Reset counters
    2. Statistics per page/date (nice-to-have)


Concept:
--------

1. Count page visits if enabled

    Page visits will be saved to a file

2. Keep separate counters for different files

    File driver will save to XML-File. Structure see example.xml
    SimpleXML will be used to read/write the data

3. Dount count up on refresh

    Session driver: Save visited pages in session, 
    only count up once per session.
    IP Driver: Save visitor IP and visited pages to XML. 
    Only count once per IP

4. Admin pages

    1. Reset counters
       Either delete relevant nodes in XML or set value to 0

    2. Would require a restructure of the XML to save the date.
       Currently shelved for another driver.