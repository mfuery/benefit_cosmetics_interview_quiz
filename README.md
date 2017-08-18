# Benefit Cosmetics Interview Quiz

## Q1

_Say we have products stored in multiple data sources (MySQL, Redis, etc.).
Using OOP concepts, how would you write your classes and functions so that products can easily be loaded from any data source,
and also, new ways of loading products can easily be implemented should they become available?
Please provide PHP code with comments if necessary. Classes and function names would suffice; no need for details of each function._

#### Solution

1. `cd q1` and run `composer install`

#### Testing

1. Simply run `phpunit`. Note this is not fully implemented yet.

#### Notes

It appears this prompt was designed to test my code structure design kills and my design patterns knowledge.
I decided to use the Adapter pattern for each db type, and their contracts are strongly enforced using an 
AdapterInterface.



### Q2

_Say we track Pokemon playing with three MySQL tables below..._

<pre>
- pokemon: id, name
- player:  id, name
- stats:   id, player_id, pokemon_id, count
</pre>

_Please provide a query that returns all groups of three players who have caught a same pokemon._

#### Solution

Simply located at root dir, named `q2.sql`

#### Testing

1. Create a new mysql database.
2. Import mysqldump `fixture.sql` into that new db.
3. Execute first, second, or both queries in `q2.sql`.

#### Notes

This was slightly tricky, but a lot of fun to figure out and test!

### Q3

_Using JavaScript/ES6/HTML/CSS, create a working image lightbox to display a Flickr public feed. Functional UI is fine._
 
   - _Flickr feed https://api.flickr.com/services/feeds/photos_public.gne?tags=puppies&format=json._
   - _Native JavaScript only. No jQuery, etc._
   - _Page should show a grid of photo thumbnails. When a thumbnail is clicked, the photo should be displayed in a lightbox view._
   - _Should run in one of the major browsers (please indicate which one)._
   - _Update the UI of a page without refreshing._

### Comments

Tested in Chrome 56.

I added a little additional functionality: added a input where you can type one or more tags and pull down
other photos via Flickr's API. I think Flickr hides the URLs of the high-res photos, so unfortunately I just had
to stretch the thumbnails for the lightbox. ¯\_(ツ)_/¯
 
I didn't have a lot of time for this (attending DjangoCon US 2017 this week) so the code isn't too clean and the CSS 
is rudimentary. It does the job though. Consider this is just POC and v1, with code refactoring yet to come.
