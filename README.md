>
> Read me file for the TFLI technical test
> Written by Andy Wood Thursday 7th May
>

# To install and run:
    
1. Pull/download from github (https://github.com/ajwoody007/url_test/)
2. Place into the localhost environment of php as a subfolder of htdocs
3. Make sure the *database* subfolder has full 'rw' permissions
4. Load /tfli/index.html - this will call index.php which will launch the app

# How the app works:

## Creating a short code
    
tfli_main.php is the main launcher and this :
- creates a db if there isn't one and then creates the main table
- retrieves all values from the table if there are any (displayed at the bottom if there are)
- loads the input page to allow the user to enter the data 
    (a title, a valid url and an expiry time which is defaulted to now plus 10 minutes but can be changed or removed )
- once the data is entered and CREATE clicked the app then :
    - checks for missing data and if there is any, message to the user and cease
    - if data found, pass it to a model file (via a controller)
    - creates a short code using a mix of letters and numbers
    - adds all the data to the database 
- reloads the main page, now showing all the short_urls created (reverse order by expiry date, latest first)

## Using a short code

- From the list of shorts codes at the bottom of the tfli_main.php page, copy a short code (or make a note of it)
- in the URL, if index.php is shown, remove it and replace it with the short code (e.g ... /tfli/fhd57e4) and press enter
- the system will retrieve the full url from the database, check it is a real website and then display it
- the above will fail if:
    - the short code doesn't exist in the database
    - the short code does exist but the website to which it points is not a valid website
    - the expiry date for the short code is set and has expired
- the above will work if:
    - the short code is found in the database
    - the website to which it points is a valid website
    - the expiry date is either not set or is set and has not yet been reached

### Diagnosing problems

I have thoroughly tested the app in both a local environment and also on the internet and while I am confident it works, the following problems may prevent smooth running:

- I found the .htaccess file to be extremely "sticky". I made a change and it wasn't picked up immediately (CTRL-F5 seemed to have no effect).
- When the DB is created, at the early stages it was created readonly so the 'create table' instruction then failed. I resolved this by creating it's own folder
- PHP is "flexible" when it comes to the locale and the date/time should be in the UK format. Global settings may override this and so the date may not be formatted correctly. I got round this by specifying Europe/London each time I calculated/used/converted dates.

 