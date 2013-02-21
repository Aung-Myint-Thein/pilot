select * from atmmachines a right join internet i on a.ISO3 = i.ISO3 and a.year = i.year
UNION
select * from atmmachines a left join internet i on a.ISO3 = i.ISO3 and a.year = i.year;


select * from (select a.ISO3, a.year, atmmachines, percentinternetuser from atmmachines a left join internet i on a.ISO3 = i.ISO3 and a.year = i.year
UNION
select i.ISO3, i.year, atmmachines, percentinternetuser from atmmachines a right join internet i on a.ISO3 = i.ISO3 and a.year = i.year) table1 order by ISO3, year;


select * from atmmachines a join internet i where a.ISO3 = i.ISO3 and a.year = i.year;