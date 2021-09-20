# Laravel Challenge: Many-to-Many Relationships - Olympics

This is a form to save the medal winners in the olympics, by sport. The result of the form submission, should be a redirect to the medals table, ordered by best countries: most gold medals, then if equal - ordered by most silver medals, if still equal - by bronze medals.

So the form is created for you, the challenge is to actually save the form data and calculate/show the result table.

![Form](https://laraveldaily.com/wp-content/uploads/2021/08/130041250-0d025c08-96c0-4a76-9a38-cd538b1b4151.png)

![Result table](https://laraveldaily.com/wp-content/uploads/2021/08/130041490-06a87b1b-37e8-4eab-9ad9-ac2f75f75da3.png)

The task details:

- You need to fill in two methods in `SportsController` and fill in the data in `show.blade.php` file;
- You also need to create the correct many-to-many relationship to save that data, potentially with additional fields in the pivot table.
- __Bonus points__: you may create the front-end and/or back-end validation, so that you couldn't select the same country for 1st/2nd/3rd place. Use whichever framework you prefer - Vue, Livewire, jQuery, etc.


---

## Rules: How to perform the task

I will be expecting a Pull Request to the `main` branch, containing **all** code for completely working project.

If you don't know how to contribute a PR, here's [my video with instructions](https://www.youtube.com/watch?v=vEcT6JIFji0).

**Important**: I will NOT merge the Pull Request, only comment on it, whether it's correct or not.

With my limited time, I will probably personally review random 10-20 Pull Requests, all the others will still get "karma points" for doing a good job and improving their skills.

If you have any questions, or suggestions for the future challenges, please open an Issue.

Good luck!

## How to install 

- Clone the repository with __git clone__
- Copy __.env.example__ file to __.env__ and edit database credentials there
- Run __composer install__ (if anyone got problems with composer on windows, try running it like this:  __composer install --ignore-platform-reqs__)
- Run __php artisan key:generate__
- Run __php artisan migrate --seed__ (it has some seeded data for your testing)
- That's it: launch the main URL.
