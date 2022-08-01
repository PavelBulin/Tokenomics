@echo.
for /f "delims=; tokens=1-1" %%a in ("sum") do @echo INSERT INTO base_sum (%%a)> query.txt
for /f "delims=; tokens=1-1" %%a in ("500") do @echo VALUES ('%%a'),>> query.txt
for /f "skip=2 delims=; tokens=1-1" %%a in (base_sum.csv) do @echo ('%%a'),>> query.txt
@del #
@echo on
