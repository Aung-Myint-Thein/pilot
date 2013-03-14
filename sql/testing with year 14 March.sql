select * from (Select country.Country, atmmachines.* from country 
				left outer join atmmachines 
				on country.ISO3 = atmmachines.ISO3) as a
left outer join shadoweconomies on a.ISO3 = shadoweconomies.ISO3 and a.year = shadoweconomies.year;

select * from country left outer join atmmachines on country.ISO3 = atmmachines.ISO3 left outer join shadoweconomies on country.ISO3 = shadoweconomies.ISO3;

SELECT @row := @row + 1 as row from (SELECT @row := 0) r ;

select * from Country join year;

select * from Country join year where year > 2000 and year <= 2010;

/* getting the country with range of year with data and empty row*/

select Country.Country, Country.ISO3, Country.year, atmmachines.atmmachines from 
(SELECT * FROM Country JOIN year where year >= 2000 and year <=2010) Country
left outer join atmmachines on Country.ISO3 = atmmachines.ISO3 and Country.year = atmmachines.year;


/* getting the country from 2 data tables with range of year with data and empty row*/
select Country.Country, Country.ISO3, Country.year, atmmachines.atmmachines, internet.percentinternetuser from 
(SELECT * FROM Country JOIN year where year >= 2000 and year <=2010) Country
left outer join atmmachines on Country.ISO3 = atmmachines.ISO3 and Country.year = atmmachines.year
left outer join internet on Country.ISO3 = internet.ISO3 and Country.year = internet.year
;

/* getting the country from 3 data tables with range of year with data and empty row*/
select Country.Country, Country.ISO3, Country.year, atmmachines.atmmachines, internet.percentinternetuser, shadoweconomies.shadoweconomies from 
(SELECT * FROM Country JOIN year where year >= 2000 and year <=2010) Country
left outer join atmmachines on Country.ISO3 = atmmachines.ISO3 and Country.year = atmmachines.year
left outer join internet on Country.ISO3 = internet.ISO3 and Country.year = internet.year
left outer join shadoweconomies on Country.ISO3 = shadoweconomies.ISO3 and Country.year = shadoweconomies.year
;

/* testing with variables */
SELECT
  Country.Country,
  Country.ISO3,
  Country.year,
  table1.table1,
  table2.table2,
  table3.table3
FROM 
(SELECT * FROM Country JOIN year WHERE year >= 2000 AND year <=2010) Country
LEFT OUTER JOIN atmmachines
  ON Country.ISO3 = atmmachines.ISO3 AND Country.year = atmmachines.year
LEFT OUTER JOIN internet
  ON Country.ISO3 = internet.ISO3 AND Country.year = internet.year
LEFT OUTER JOIN shadoweconomies
  ON Country.ISO3 = shadoweconomies.ISO3 AND Country.year = shadoweconomies.year
;