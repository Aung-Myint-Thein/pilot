select * from atmmachines a right join internet i on a.ISO3 = i.ISO3 and a.year = i.year
UNION
select * from atmmachines a left join internet i on a.ISO3 = i.ISO3 and a.year = i.year;


select * from (select a.ISO3, a.year, atmmachines, percentinternetuser from atmmachines a left join internet i on a.ISO3 = i.ISO3 and a.year = i.year
UNION
select i.ISO3, i.year, atmmachines, percentinternetuser from atmmachines a right join internet i on a.ISO3 = i.ISO3 and a.year = i.year) table1 order by ISO3, year;


select * from atmmachines a join internet i where a.ISO3 = i.ISO3 and a.year = i.year;

http://en.wikipedia.org/wiki/Join_%28SQL%29#Full_outer_join

SELECT employee.LastName, employee.DepartmentID,
       department.DepartmentName, department.DepartmentID
FROM employee
INNER JOIN department ON employee.DepartmentID = department.DepartmentID
 
UNION ALL
 
SELECT employee.LastName, employee.DepartmentID,
       CAST(NULL AS VARCHAR(20)), CAST(NULL AS INTEGER)
FROM employee
WHERE NOT EXISTS (
    SELECT * FROM department
             WHERE employee.DepartmentID = department.DepartmentID)
 
UNION ALL
 
SELECT CAST(NULL AS VARCHAR(20)), CAST(NULL AS INTEGER),
       department.DepartmentName, department.DepartmentID
FROM department
WHERE NOT EXISTS (
    SELECT * FROM employee
             WHERE employee.DepartmentID = department.DepartmentID)
			 
			 
select * from atmmachines a right join internet i on a.ISO3 = i.ISO3 and a.year = i.year
UNION
select * from atmmachines a left join internet i on a.ISO3 = i.ISO3 and a.year = i.year;

select * from atmmachines a join internet i where a.ISO3 = i.ISO3;

select a.ISO3, 2004, atmmachines, percentinternetuser from atmmachines a join internet i where a.ISO3 = i.ISO3 and a.year=i.year and a.year = 2004;

select * from atmmachines where year = 2004 and ISO3 = "CHN";

select * from shadoweconomies where year = 2004;

select * from atmmachines full join internet on atmmachines.ISO3=internet.ISO3 and atmmachines.year=internet.year;

SELECT atmmachines.ISO3, atmmachines.year, atmmachines.ATMMachines, internet.percentinternetuser
FROM atmmachines
FULL JOIN internet
ON atmmachines.ISO3=internet.ISO3;

select * from internet JOIN shadoweconomies on internet.year = shadoweconomies.year;

select * from country left outer join atmmachines on country.ISO3 = atmmachines.ISO3 left outer join shadoweconomies on country.ISO3 = shadoweconomies.ISO3;


select * from (Select * from country 
				left outer join atmmachines 
				on country.ISO3 = atmmachines.ISO3) as 2
left outer join shadoweconomies on 2.ISO3 = shadoweconomies.ISO3 ;