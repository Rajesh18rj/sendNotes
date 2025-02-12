## What this application do ? 

- Users login and create accounts
- Users can type up notes and sav them 
  - Created the models and migrations 
  - Get started on views 
- Notes will be sent publicly via email to view 
- The Receiver can Heart a note that sent 


## What should keep in mind ? 

- Users cant view other peoples notes
- Notes Should only be public 
- Notes should be as secured as possible for public-facing notes.
    - Use UUIDs
- Notes only people who have access

## what are things we are learning ? 

- Learn Breeze 
- Models
- Migrations 
- Emails
- Jobs, queues and cron
- Routing
- Policies
- Livewire Volt


# 

Notes nu oru migration create pannikirom nd model create panni, athuku values laam kuduthurukom .. 

- ipo namaku migration table la yethavathu changes pannanum nu nenacha , > php artisan migrate:rollback kuduthuttu , again changes laam mudinja aprom migrate pannikalam .. 

Note Model la itha yelutha porom.. 

public function user() {
    return $this->belongsTo(User::class);
}

then user Model la poi notes ku yelutha porom (Relationship).. 

public function notes(){
    return $this->hasMany(Note::class);


## Benefits of Writing This Relationship

### 1. Easy Querying
   Instead of manually writing a query like:
```php
$notes = Note::where('user_id', $user->id)->get();
```
You can simply use:
```php
$notes = $user->notes;
```
## This makes your code cleaner and more readable.

### 2. Eloquent Relationship Methods
   You can do powerful operations with relationships, such as:

- (a) Retrieve All Notes of a User
```php
$user = User::find(1);
$notes = $user->notes;  // Gets all notes of user with ID 1
```
- (b) Create a New Note for a User
```php
$user->notes()->create([
'content' => 'This is a new note!',
]);
Laravel automatically fills the user_id field in the notes table for you.
```
- (c) Get a User's Notes with Eager Loading (Performance Boost)
```php
$users = User::with('notes')->get();
```
This prevents the N+1 query problem by loading all related notes in a single query.

### 3. Automatic Relationship Handling
   If you delete a user, all their notes will also be deleted (if cascadeOnDelete is enabled).
   You don’t need to manually write queries to manage relations.
}

# Get started on views 

```bash
composer require wireui/wireui 
```
install this .. 

then add this tag in header file
<wireui:scripts />  (add this in layout file)

```css
"./vendor/wireui/wireui/src/*.php",
"./vendor/wireui/wireui/ts/**/*.ts",
"./vendor/wireui/wireui/src/WireUi/**/*.php",
"./vendor/wireui/wireui/src/Components/**/*.php",
```
then add this tailwindcss content .. 

then add this preset also in tailwind.config
```css
presets: [
...
require("./vendor/wireui/wireui/tailwind.config.js")
],
```
then we need to publish this . 


then we can use like this  
```html
<x-button primary>Hi there</x-button>
```
refer those colors in wire ui docs page ... 

if we want to modify the color we can do it..
```css
primary: colors.indigo,
secondary: colors.gray,
positive: colors.emerald,
negative: colors.red,
warning: colors.amber,
info: colors.blue
```
these are custom color if we want we can change it in tailwind.config ..

for example we change the primary color to rose 

go to tailwind.config

```css
extend: {
    colors: {
        primary: colors.rose,
},
```
then make sure import this in tailwindcss upper

const colors = require('tailwindcss/colors')

now its working perfectly.. 

then go to navigation page and copy dashboard nav link and paste it and change the name into notes .. 

then create a route for notes .. 

then create a notes.index in view 

notes ellathaiyum list panni inga than kaata porom..

then we need a livewire component for notes

if we want to create a new column in previously existsing notes table
>  php artisan make:migration add_recipient_to_notes_table --table=notes

then this comment create a new table 
you can add this in that table             - $table->string('recipient');

then do 
 > php artisan migrate:rollback
 
now recipient column add to the notes table .. 


# next we can do is 

only auth users can only delete posts 
that's why we are going to policy

>  php artisan make:policy NotePolicy --model=Note

then first go to show-notes page 

$this->authorize('delete',$note);  #add this line before delete 

then go to policy , write like this

public function delete(User $user, Note $note): bool
    {
        return $user->id === $note->user_id;
    }

Now that authenticated user only can delete that note.. 

then we are going to create edit page
>  php artisan make:volt notes/edit-note --class

then create the route for this 


we can also do Policy for edit too.. 
