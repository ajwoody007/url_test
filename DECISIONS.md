>
> Decisions file for the TFLI technical test   
> Written by Andy Wood Thursday 7th May        
> 

# Environment Rationale


    The app is MVC and in some cases OOP. Rather than split in into various folders as usual, I kept everything in one folder (except the DB)
    The main pages all start with the prefix "tfli". Pages that don't are instrumental or "background" pages.

    **VIEW**        **CONTROLLERS**     **MODELS**      **DATABASE**
    tfli_main       tfli.js
                    tfli_ajax
                    tfli_ctl            tfli_mdl        /database/tfli.db

    check_url is used as a view to get the short code from the url and check it. Although it is a view file, it redirects before the user sees it.
    404.php is the pretty "page not found" view page.
    

# Design Rationale


    I decided on a simple, two colour design which should be easy on the eye.


# Assistant Sources


    I'm a little rusty on Tailwind, so I used the official Tailwind document pages https://tailwindcss.com/docs/ to remind myself of certain aspects (centering, mainly)
    I used the PHP document pages to get the exact syntax for date conversion (https://www.php.net/docs.php)


# Alternative Approaches


    Given more time I would:
        - create a .env file to contain the databse settings
        - installed tailwind and used without a CDN
        - enhance the data validation in JS, for example added pattern matching for the give long url
        - styled the messages presented to the user rather than used "alert"
        - made the list of prevously created short codes a bit prettier and removed the long url (I only displayed it for checking purposes)
        - performed the long url check before inserting into the db, so it doesn't store an invalid web address
        - performed a check to see if a short code already exists for a url in the db, then either:
            - informed the user for them to decide whether to create a new one or update/overwrite the existing one
        - involved "private" classes in the db to enhance security
        - created a login page and stored the user id with the record, so each user has their own set of url short codes
        - for the creation of the short url, I used an inbuilt php function, but would probably do this a different way
        - on app launch, check (and maybe set) the permissions of the database folder

        
