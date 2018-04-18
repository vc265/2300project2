# Project 2, Milestone 1 - Design & Plan

Your Name: Vicky Chou

## 1. Persona

I have selected Abby as my persona because while Abby enjoys listening to a wide variety of music, my website intends to showcase a catalog of dramas produced in different East Asian countries. Though not directly correlated, I think Abby will be a more suitable persona than Patricia, Patrick, or Tim because she appears to be open to learning about and engaging with the different pop cultures from around the world.

## 2.Describe your Catalog

My catalog will list a collection of East Asian dramas that I have watched over the years and detail the titles of the dramas, the genres of the dramas, the years that the dramas were released/aired, the countries that the dramas were produced in, and the brief synopses of the dramas.

<b>UPDATE:</b>
I chose this catalog because I wanted to share some of the most memorable dramas I have watched throughout the years.

## 3. Sketch & Wireframe

![](sketch.png)

![](wireframe.png)

My sketches meet the needs of my persona because they are easy to navigate and to-the-point. They depict a visible navigation bar at the top of every screen that informs the user of the two possible actions he/she can do – search the table or add to the table – as well as organize all of the relevant information in a structured manner.

## 4. Database Schema Design

table: dramas
* <u>field 1: id</u>  
&nbsp;&nbsp;&nbsp; type: INTEGER  
&nbsp;&nbsp;&nbsp; constraints: PK, U, NOT, AI
* <u>field 2: title</u>  
&nbsp;&nbsp;&nbsp; type: TEXT  
&nbsp;&nbsp;&nbsp; constraints: U, NOT
* <u>field 3: year(s) released</u>  
&nbsp;&nbsp;&nbsp; type: INTEGER  
&nbsp;&nbsp;&nbsp; constraints: NOT
* <u>field 4: genre(s)</u>  
&nbsp;&nbsp;&nbsp; type: TEXT  
&nbsp;&nbsp;&nbsp; constraints: NOT
* <u>field 5: country produced</u>  
&nbsp;&nbsp;&nbsp; type: TEXT  
&nbsp;&nbsp;&nbsp; constraints: NOT
* <u>field 6: synopsis</u>  
&nbsp;&nbsp;&nbsp; type: TEXT  
&nbsp;&nbsp;&nbsp; constraints: U, NOT

<b>UPDATE:</b>
I removed the U constraint for the title field because I remembered that some dramas have remakes with the same name.

## 5. Database Query Plan

<u>retrieve all records:</u>  
SELECT \* FROM dramas;

<u>search records by a user selected field:</u>  
SELECT \* FROM dramas WHERE title='';  
SELECT \* FROM dramas WHERE genre='';  
SELECT \* FROM dramas WHERE country='';

<u>insert records:</u>  
INSERT INTO dramas (title, year, genre, country, synopsis)  
VALUES (title, year, genre, country, synopsis);  
*note: I used this method because I didn't want the users to input values for the id column themselves.*

*note: All information is taken from mydramalist.com*

## 6. *Filter Input, Escape Output* Plan

[Describe your plan for filtering the input from your HTML forms. Describe your plan for escaping any values that you use in HTML or SQL. You may use natural language and/or pseudocode.]


* <u>field 2: title</u>  
&nbsp;&nbsp;&nbsp; filter input: post, sanitize string  
&nbsp;&nbsp;&nbsp; escape output: sanitize full special chars
* <u>field 3: year(s) released</u>  
&nbsp;&nbsp;&nbsp; drop-down menu for years 2000-2018
* <u>field 4: genre(s)</u>  
&nbsp;&nbsp;&nbsp; drop-down menu for genres
* <u>field 5: country produced</u>  
&nbsp;&nbsp;&nbsp; drop-down menu for countries China, Taiwan, Korea, Japan
* <u>field 6: synopsis</u>  
&nbsp;&nbsp;&nbsp; filter input: post, sanitize string  
&nbsp;&nbsp;&nbsp; escape output: sanitize full special chars

## 7. Additional Code Planning

I might create a function that displays error messages that more explicitly explain to the user why his/her inputs are invalid.
