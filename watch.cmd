@ECHO OFF
REM Builds css files by sassc and generates static html site.
REM
REM Created by Alexander Zolotarev <me@alex.bio> from Minsk, Belarus.

SETLOCAL

REM Use PHP binary from the PATH.
SET php=php.exe
for %%f in (bin\sassc*%PROCESSOR_ARCHITECTURE%.exe) do SET sassc=%%f
for %%f in (bin\*fswatch*%PROCESSOR_ARCHITECTURE%.exe) do SET fswatch=%%f

SET sassc_input=scss/style.scss
SET sassc_output=www/css/style.css
REM One of: nested, expanded, compact, compressed
SET sassc_style=nested

SET watch_directory=scss

REM Launch local php web server in background.
START "" /B %php% -S localhost:8888 -t www || ECHO ERROR while launching %php% web server. && EXIT /B 1

REM Rebuild scss on the launch once and watch for any scss directory changes indefinitely.
:loop
ECHO Rebuilding %sassc_output%
REM Do not stop after sassc returned error, because it can be caused by invalid scss syntax.
%sassc% --style %sassc_style% %sassc_input% %sassc_output%
%fswatch% --one-event %watch_directory% || ECHO ERROR while launching %fswatch%. && EXIT /B 1
GOTO loop
