

## How To Run 

This is a task I solved the other day and it's pretty concise. This application detects the user browser and also gives the user the ability to choose between various user. 
 After getting the vote, it sends an acknowledgement email. Also, there is a javascript validation for the client side. If you want to make this work, you need to include <code> brows_cap.ini</code> in your <code>ini folder</code>.
 Also, it presents statistics of the browsers chooser by users. I used bootstrap to make it mobile friendly and responsive.  

To run this application, you need to have <code>composer</code> and <code>git</code> installe on your machine. If you already have, then follow these steps to run this web aplication: 
 
 1) <code> git clone https://github.com/elhamkiumarsian/poll_browser.git</code>
 
 2) <code> cd poll_browser </code> 
 
 3) <code> composer install </code> 
 
 4) <code> php artisan key:generate</code> 
 
 5) rename the file "<code>.env.example</code>" to "<code>.env</code>" and enter your database credentials along with the database you are going to save the records in them. 
 
 6) <code> php artisan migrate</code> 
 
 7) <code> php artisan serve</code> 
 
 8) open your browser and enter<code>localhost:8000</code>

 If you do everything correctly, you'll be able to see the page. For other route, view <code>routes.php</code>
Note that I have used Laravel 5.1 which is an LTS version and has a long term support.  